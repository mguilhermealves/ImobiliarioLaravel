<?php

namespace App\Http\Controllers\Sistema;

use App\Models\Empresa;
use App\Models\Empresagrupo;
use Illuminate\Http\Request;
use App\Models\Empresasubgrupo;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Mensagens\MensagemRepository;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;
use App\Repositories\Produtos\ProdutosRepository;

class FornecedorController extends Controller
{
    public function index(Empresa $empresa)
    {
        if ($empresa->plano->site == 1) {
            return view('sistema.fornecedores.index', [
              'empresa' => $empresa,
              'title' => $empresa->nome,
            ]);
        }

        return view('sistema.fornecedores.free', [
          'empresa' => $empresa,
          'title' => $empresa->nome,
        ]);
    }

    public function fornecedorPerfil(Empresa $empresa)
    {
        return view('sistema.fornecedores.perfil', [
        'empresa' => $empresa,
        'title' => $empresa->nome . ' / Perfil',
      ]);
    }

    public function fornecedorProdutos(Empresa $empresa, Request $request)
    {
        $produtos = ProdutosRepository::todosFornecedor($empresa, $request);

        return view('sistema.fornecedores.produtos', [
          'empresa' => $empresa,
          'title' => $empresa->nome . ' / Produtos',
          'produtos' => $produtos,
        ]);
    }

    public function fornecedorProdutosGrupo(Empresa $empresa, Empresagrupo $grupo, Empresasubgrupo $sub = null)
    {
        return view('sistema.fornecedores.produtos-grupo', [
        'empresa' => $empresa,
        'grupo' => $grupo,
        'sub' => $sub,
        'produtos' => $sub != null ? $sub->produtos : $grupo->produtos,
        'title' => $empresa->nome . ' / ' . $grupo->nome,
      ]);
    }

    public function mensagem(Empresa $empresa, MensagemRequest $request)
    {
        $msg = MensagemRepository::checkChatFront($this->usuario, $empresa->usuario);
        MensagemRepository::criaMensagemItem($msg, $empresa->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Mensagem enviada com sucesso!<br>Você poderá conferir esta conversa em seu Dashboard de comprador, na parte de "Mensagens".', url()->previous());
    }
}
