<?php

namespace App\Repositories\Cotacoes;

use App\Models\Cotacao;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Mensagem;
use App\Models\Mensagemitem;
use App\Models\Avaliacao;
use App\Models\Rfqresposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Empresas\EmpresasRepository;
use App\Http\Requests\Sistema\Produtos\CotacaoRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Cotacoes\ResponderCotacaoRequest;

class CotacaoRepository
{
    public static function direta(Empresa $origem, Produto $produto, CotacaoRequest $request):Cotacao
    {
        $cotacao = new Cotacao();
        $cotacao->empresa_origem = $origem->id;
        $cotacao->empresa_destino = $produto->empresa->id;
        $cotacao->tipo = 1;
        $cotacao->produto_id = $produto->id;
        $cotacao->quantidade = $request->quantidade;
        if (isset($request->detalhes)) {
            $cotacao->detalhes = $request->detalhes;
        } else {
            $cotacao->detalhes = 'Olá, gostaria de um orçamento para este item.';
        }
        $cotacao->save();
        if ($request->hasFile('anexo') && $request->file('anexo')->isValid()) {
            $anexo = self::geraAnexo($cotacao, $request);
            $cotacao->anexo = $anexo;
            $cotacao->save();
        }

        return $cotacao;
    }

    public static function geraAnexo(Cotacao $cotacao, CotacaoRequest $request)
    {
        $titulo = $request->anexo->getClientOriginalName();
        $nameFile = $cotacao->id . '/' . $titulo;
        $upload = Storage::disk('cotacoes')->put($nameFile, file_get_contents($request->anexo), 'public');
        if (!$upload) {
            return redirect()
          ->back()
          ->with('error', 'Falha ao fazer upload')
          ->withInput();
        }

        return  Storage::disk('cotacoes')->url($nameFile);
    }

    public static function porProduto(Empresa $empresa)
    {
        return $empresa->cotacoes->where('status', '!=', 2)->sortBy('status')->sortByDesc('created_at')->groupBy('produto_id');
    }

    public static function porProdutoFechadas(Empresa $empresa)
    {
        return $empresa->cotacoes->where('status', 2)->sortBy('status')->sortByDesc('created_at')->groupBy('produto_id');
    }

    public static function porProdutoComprador(Empresa $empresa)
    {
        return $empresa->cotacoesComprador->where('status', '!=', 2)->sortBy('status')->sortByDesc('created_at')->groupBy('produto_id');
    }

    public static function porProdutoCompradorFechadas(Empresa $empresa)
    {
        return $empresa->cotacoesComprador->where('status', 2)->sortBy('status')->sortByDesc('created_at')->groupBy('produto_id');
    }

    public static function ultimas(Empresa $empresa)
    {
        return $empresa->cotacoes->where('status', '<', 2);
    }

    public static function ultimasComprador(Empresa $empresa)
    {
        return $empresa->cotacoesComprador->where('status', '<', 2)->take(4);
    }

    public static function leCotacao(Cotacao $cotacao)
    {
        if ($cotacao->status == 0) {
            $cotacao->status = 4;
            $cotacao->save();
        }
    }

    public static function respondePorMensagem(Mensagem $mensagem)
    {
        $cotacao = Cotacao::find($mensagem->cotacao->id);
        if ($cotacao->status == 0 || $cotacao->status == 4) {
            $cotacao->status = 1;
            $cotacao->save();
        }
    }

    public static function responder(Cotacao $cotacao, ResponderCotacaoRequest $request)
    {
        $dados = self::preparaUpdate($request->all());
        $cotacao->update($dados);
    }

    public static function respondeTodas(Empresa $empresa, Produto $produto, Request $request)
    {
        $respostas = self::makeRespostas($request);
        $cotacoes = self::makeRespostasCollection($respostas);
        foreach ($cotacoes as $cotacao) {
            $cotacao->update(self::preparaUpdate($respostas[$cotacao->id], false));
        }
    }

    public static function globais(Empresa $empresa)
    {
        return $empresa->cotacoes->where('status', 0);
    }

    public static function todasGlobais()
    {
        return Cotacao::where('tipo', 0)->where('status', 0)->get();
    }

    public static function respondeGlocal(Cotacao $cotacao)
    {
        $cotacao->status = 1;
        $cotacao->save();
    }

    public static function checkDonoVendedor(Empresa $empresa, Cotacao $cotacao)
    {
        if ($empresa->id !== $cotacao->destino->id) {
            return false;
        }

        return true;
    }

    public static function checkDonoComprador(Empresa $empresa, Cotacao $cotacao)
    {
        if ($empresa->id !== $cotacao->origem->id) {
            return false;
        }

        return true;
    }

    public static function makeRespostas(Request $request)
    {
        $respostas = [];
        foreach ($request->all() as $k => $v) {
            foreach ($v as $c => $i) {
                $respostas[$c][$k] = $i;
            }
        }

        return $respostas;
    }

    public static function makeRespostasCollection(array $respostas)
    {
        $collection = new Collection();
        foreach ($respostas as $k => $v) {
            $collection->push(self::get($k));
        }

        return $collection;
    }

    public static function get(Int $id)
    {
        return Cotacao::find($id);
    }

    public static function preparaUpdate(array $dados, $single = true)
    {
        if (!$single) {
            $dados['valor'] = currencyToBd($dados['valor']);
        }
        $dados['pagamento'] = $dados['pagamento'];
        $dados['validade'] = dateAppToBd($dados['validade']);
        $dados['status'] = 1;

        return $dados;
    }

    public static function avalia(Cotacao $cotacao, Usuario $usuario, Request $request)
    {
        $avaliacao = new Avaliacao();
        $avaliacao->avaliador = $usuario->id;
        $avaliacao->avaliado = $cotacao->empresa_destino;
        $avaliacao->nota = $request->nota > 0 ? $request->nota : 1;
        $avaliacao->save();
        self::finaliza($cotacao);
        EmpresasRepository::atualizaNota($cotacao->destino);
    }

    public static function finaliza(Cotacao $cotacao)
    {
        $cotacao->status = 2;
        $cotacao->save();
    }

    public static function novasMensagensCotacao(Usuario $usuario)
    {
        return Mensagem::with('mensagens')->whereHas('mensagens', function ($q) use ($usuario) {
            return $q->where('status', 0)->where('destino', $usuario->id);
        })
      ->where('origem', $usuario->id)
      ->where('cotacao_id', '<>', null)
      ->where('rfqresposta_id', null)
      ->count();
    }

    public static function novaMsgRfqPanelVendedor(Usuario $usuario)
    {   
        $mensagemItem = Mensagemitem::where('status', 0)->where('destino', $usuario->id)->first();           
        if($mensagemItem != null){
            $mensagemOrigem = Mensagem::where('id', $mensagemItem->mensagem_id)->where('cotacao_id', null)->first();           
            if($mensagemOrigem != null && $mensagemOrigem->origem == $usuario->id){
            return true;
            }
        }   
    }

    public static function novaMsgRfqPanelComprador(Usuario $usuario)
    {           
        $mensagemItem = Mensagemitem::where('status', 0)->where('destino', $usuario->id)->first();           
        if($mensagemItem != null){
            $mensagemOrigem = Mensagem::where('id', $mensagemItem->mensagem_id)->where('cotacao_id', null)->first();           
            if($mensagemOrigem != null && $mensagemOrigem->origem != $usuario->id){
            return true;
            }
        }   
    }

    public static function novasVendedor(Usuario $usuario)
    {
        // return Cotacao::where('empresa_destino', $usuario->id)
        // ->where('status', 0)
        // ->count();
            return Mensagem::with('mensagens')->whereHas('mensagens', function ($q) use ($usuario) {
                return $q->where('status', 0)->where('destino', $usuario->id);
            })->with('cotacao')->whereHas('cotacao', function ($q) use ($usuario) {
                return $q->where('empresa_destino', $usuario->id);
            })        
        ->where('cotacao_id', '<>', null)
        ->where('rfqresposta_id', null)
        ->count();
    }
}
