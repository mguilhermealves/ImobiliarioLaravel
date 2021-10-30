<?php

namespace App\Repositories\Cotacoes;

use App\Models\Rfq;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Avaliacao;
use App\Models\Categoria;
use App\Models\Rfqresposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Sistema\Rfq\NovoRfqRequest;
use App\Repositories\Empresas\EmpresasRepository;
use App\Http\Requests\Sistema\Rfq\RfqRespostaRequest;
use App\Models\Comofunciona;
use App\Models\Mensagemitem;

class RfqRepository
{
    public static function get(Categoria $categoria = null, Request $request)
    {
        $user = Auth::guard('sistema')->user();

        return Rfq::where('count', '<', 10)
        ->when($categoria, function ($query) use ($categoria) {
            return $query->where('categoria_id', $categoria->id);
        })
        ->when($request->termo, function ($query) use ($request) {
            return $query->search($request->termo);
        })
        ->when($user != null, function ($query) use ($user) {
            return $query->whereDoesntHave('respostas', function (Builder $q) use ($user) {
                return $q->where('fornecedor_id', $user->empresa->id);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    }

    public static function salvar(Empresa $empresa, NovoRfqRequest $request)
    {
        $empresas = self::buscaProdutos($request);
        $ids = $empresas->unique('empresa_id');
        $request['empresa_id'] = $empresa->id;
        $rfq = Rfq::create($request->all());
    }

    public static function editar(Request $request)
    {
        $rfq = Rfq::find($request->id);
        $rfq->update($request->all());      
    }

    public static function buscaProdutos(Request $request)
    {
        $empresas = Produto::where('status', 1)
        ->where('categoria_id', $request->categoria_id)
        ->where('subcategoria_id', $request->subcategoria_id)
        ->when($request->grupo_id, function ($query) use ($request) {
            return $query->where('grupo_id', $request->grupo_id);
        })->distinct('id')->get();

        return $empresas;
    }

    public static function check(Rfq $item)
    {
        return $item->count < 10;
    }

    public static function checkResposta(Rfq $item, Empresa $empresa)
    {
        if ($empresa->respostas->where('rfq_id', $item->id)->first()) {
            return true;
        }

        return false;
    }

    public static function updateCount(Rfq $item)
    {
        $item->count++;
        $item->save();
    }

    public static function responder(Rfq $item, RfqRespostaRequest $request)
    {
        $request['rfq_id'] = $item->id;
        $resposta = Rfqresposta::create($request->all());
        self::updateCount($item);

        return $resposta;
    }

    public static function getVendedor(Empresa $empresa)
    {
        return $empresa->respostas->where('lida', '<', 2)->sortByDesc('created_at');
    }

    public static function getVendedorFechadas(Empresa $empresa)
    {
        return $empresa->respostas->where('lida', 2)->sortByDesc('created_at');
    }

    public static function getComprador(Empresa $empresa)
    {
        $respostas = Rfq::with('respostas')->whereHas('respostas', function ($q) {
            return $q->where('lida', '<', 2);
        })->where('empresa_id', $empresa->id)->get()->sortByDesc('respostas.created_at');
        $sem_respostas = Rfq::with('respostas')->whereDoesntHave('respostas')->where('empresa_id', $empresa->id)->get()->sortByDesc('respostas.created_at');

        return $respostas->merge($sem_respostas);
    }

    public static function getCompradorFechadas(Empresa $empresa)
    {
        $respostas = Rfq::with('respostas')->whereHas('respostas', function ($q) {
            return $q->where('lida', 2);
        })->where('empresa_id', $empresa->id)->get()->sortByDesc('respostas.created_at');

        return $respostas;
    }

    public static function checkVendedor(Empresa $empresa, Rfqresposta $item)
    {
        return $item->fornecedor_id === $empresa->id;
    }

    public static function checkComprador(Empresa $empresa, Rfqresposta $item)
    {
        return $item->rfq->empresa_id === $empresa->id;
    }

    public static function anexar(Rfq $item, Request $request)
    {
        $nameFile = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $titulo = $request->file->getClientOriginalName();
            // $nameFile = $item->id . '/' . $titulo;
            $nameFile = $titulo;
            $upload = Storage::disk('rfqs')->put($nameFile, file_get_contents($request->file), 'public');
            if (!$upload) {
                return redirect()
            ->back()
            ->with('error', 'Falha ao fazer upload')
            ->withInput();
            }
            $file = Storage::disk('rfqs')->url($nameFile);
            $data = ['link' => $file];

            return response()->json($data);
        }
    }

    public static function leResposta(Rfqresposta $item)
    {
        if ($item->lida != 2) {
            $item->lida = 1;
            $item->save();
        }
    }

    public static function avalia(Rfqresposta $item, Usuario $usuario, Request $request)
    {
        $item->lida = 2;
        $item->save();
        $avaliacao = new Avaliacao();
        $avaliacao->avaliador = $usuario->id;
        $avaliacao->avaliado = $item->fornecedor->id;
        $avaliacao->nota = $request->nota > 0 ? $request->nota : 1;
        $avaliacao->save();
        EmpresasRepository::atualizaNota($item->fornecedor);
    }

    public static function como()
    {
        return Comofunciona::find(1);
    }


    public static function novaVendedor(Empresa $empresa, Usuario $usuario)
    {
        return Mensagemitem::where('destino', $usuario->id)->orderBy('created_at', 'desc').first();
    }

}
