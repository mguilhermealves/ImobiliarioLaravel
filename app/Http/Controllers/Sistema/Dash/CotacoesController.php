<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Cotacao;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Cotacoes\CotacaoRepository;
use App\Repositories\Contatos\ContatosRepository;
use App\Repositories\Usuarios\UsuariosRepository;
use App\Repositories\Mensagens\MensagemRepository;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Cotacoes\ResponderCotacaoRequest;

class CotacoesController extends Controller
{
    public function index()
    {
        return view('sistema.dash.vendedor.cotacoes.index', [
          'cotacoes' => CotacaoRepository::porProduto($this->usuario->empresa),
          'fechadas' => CotacaoRepository::porProdutoFechadas($this->usuario->empresa),
          'title' => 'Painel de Controle - Vendedor - Cotações'
        ]);
    }

    public function cotacao(Empresa $empresa, Cotacao $cotacao)
    {
        if (!CotacaoRepository::checkDonoVendedor($empresa, $cotacao)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        CotacaoRepository::leCotacao($cotacao);

        return view('sistema.parts.dash.cotacao-individual', [
          'cotacao' => $cotacao,
        ])->render();
    }

    public function todas(Empresa $empresa, Produto $produto)
    {
        return view('sistema.parts.dash.cotacoes-grupo', [
          'produto' => $produto,
          'cotacoes' => $empresa->cotacoes->where('produto_id', $produto->id)->where('valor', null),
        ])->render();
    }

    public function responderCotacao(Empresa $empresa, Cotacao $cotacao, ResponderCotacaoRequest $request)
    {
        if (!CotacaoRepository::checkDonoVendedor($empresa, $cotacao)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        CotacaoRepository::responder($cotacao, $request);
        if (! UsuariosRepository::contato($this->usuario, $cotacao->origem->usuario)) {
            ContatosRepository::adiciona($this->usuario, $cotacao->origem->usuario);
        }

        return SistemaService::jsonR(200, 1, 'Cotação respondida com sucesso!', route('sistema.dash.vendedor.cotacoes'));
    }

    public function indexComprador()
    {
        return view('sistema.dash.comprador.cotacoes.index', [
          'cotacoes' => CotacaoRepository::porProdutoComprador($this->usuario->empresa),
          'fechadas' => CotacaoRepository::porProdutoCompradorFechadas($this->usuario->empresa),
          'title' => 'Painel de Controle - Comprador - Cotações'
        ]);
    }

    public function cotacaoComprador(Empresa $empresa, Cotacao $cotacao)
    {
        if (!CotacaoRepository::checkDonoComprador($empresa, $cotacao)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.comprador.cotacoes'));
        }
        CotacaoRepository::leCotacao($cotacao);

        return view('sistema.parts.dash.cotacao-individual-comprador', [
          'cotacao' => $cotacao,
        ])->render();
    }

    public function responderTodas(Empresa $empresa, Produto $produto, Request $request)
    {
        CotacaoRepository::respondeTodas($empresa, $produto, $request);

        return SistemaService::jsonR(200, 1, 'Cotações respondidas com sucesso!', route('sistema.dash.vendedor.cotacoes'));
    }

    public function mensagens(Mensagem $mensagem)
    {
        if (!MensagemRepository::checkDono($mensagem, $this->usuario)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        MensagemRepository::updateStatus($mensagem, $this->usuario);

        return view('sistema.parts.dash.mensagem-cotacao', [
          'mensagem' => $mensagem,
        ])->render();
    }

    public function responder(Mensagem $mensagem, MensagemRequest $request)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDono($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }
            //CotacaoRepository::respondePorMensagem($mensagem);
            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioOrigem, $request);

            if($mensagem->rfqresposta_id != null){
                MensagemRepository::updateRfqRespostaNaoLida($mensagem->rfqresposta_id);
            }

            return SistemaService::jsonR(200, 1, $mensagem->id, 0);
        }
    }

    public function mensagensComprador(Mensagem $mensagem)
    {
        if (!MensagemRepository::checkDonoComprador($mensagem, $this->usuario)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        MensagemRepository::updateStatus($mensagem, $this->usuario);

        return view('sistema.parts.dash.mensagem-cotacao', [
          'mensagem' => $mensagem,
        ])->render();
    }

    public function responderComprador(Mensagem $mensagem, MensagemRequest $request)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDonoComprador($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }

            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioDestino, $request);

            if($mensagem->rfqresposta_id != null){
                MensagemRepository::updateRfqRespostaNaoLida($mensagem->rfqresposta_id);
            }

            return SistemaService::jsonR(200, 1, $mensagem->id, 0);
        }
    }

    public function avaliar(Cotacao $cotacao, Request $request)
    {
        if (!CotacaoRepository::checkDonoComprador($this->usuario->empresa, $cotacao)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.comprador.cotacoes'));
        }

        CotacaoRepository::avalia($cotacao, $this->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Cotação encerrada com sucesso!', 0);
    }

    public function finalizar(Cotacao $cotacao)
    {
        if (!CotacaoRepository::checkDonoVendedor($this->usuario->empresa, $cotacao)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.comprador.cotacoes'));
        }

        CotacaoRepository::finaliza($cotacao);

        return SistemaService::jsonR(200, 1, 'Cotação encerrada com sucesso!', 0);
    }
}
