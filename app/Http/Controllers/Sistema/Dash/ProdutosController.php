<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Sistema\BaseRepository;
use App\Repositories\Produtos\ProdutosRepository;
use App\Repositories\Categorias\CategoriasRepository;
use App\Http\Requests\Sistema\Dash\Vendedor\Produtos\ProdutoRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Produtos\ProdutoEditarRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Produtos\MensagemCategoriaRequest;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $produtos = ProdutosRepository::get($this->usuario->empresa);
        $limite = $this->usuario->empresa->plano->produtos;
        $count = $produtos->count();
        if ($limite == 0) {
            $add = true;
        } else {
            if ($count < $limite) {
                $add = true;
            } else {
                $add = false;
            }
        }

        return view('sistema.dash.vendedor.produtos.index', [
          'produtos' => $produtos,
          'add' => $add,
          'title' => 'Painel de Controle - Vendedor - Gerenciar Produtos'
        ]);
    }

    public function novo()
    {
        $limite = $this->usuario->empresa->plano->produtos;
        $count = $this->usuario->empresa->produtos->count();
        if ($limite == 0) {
            $categorias = CategoriasRepository::all()->sortBy('nome');

            return view('sistema.dash.vendedor.produtos.novo', [
              'categorias' => $categorias,
              'title' => 'Painel de Controle - Vendedor - Novo Produto'
            ]);
        }
        if ($count < $limite) {
            $categorias = CategoriasRepository::all()->sortBy('nome');

            return view('sistema.dash.vendedor.produtos.novo', [
              'categorias' => $categorias,
              'title' => 'Painel de Controle - Vendedor - Novo Produto'
            ]);
        }

        return view('sistema.dash.vendedor.produtos.limite',[
          'title' => 'Painel de Controle - Vendedor - Limite Atingido'
        ]);
    }

    public function pesquisaCategorias(Request $request)
    {
        return ProdutosRepository::buscaCategorias($request);
    }

    public function getSub(Request $request)
    {
        return CategoriasRepository::getSub($request);
    }

    public function getGrupo(Request $request)
    {
        return CategoriasRepository::getGrupo($request);
    }

    public function novoDados(Request $request)
    {
        return view('sistema.dash.vendedor.produtos.novo-dados', [
          'categorias' => BaseRepository::toSelect(CategoriasRepository::all()),
          'categoria' => $request->categoria,
          'subs' => BaseRepository::toSelect(CategoriasRepository::getSub($request)),
          'sub' => $request->sub,
          'grupos' => BaseRepository::toSelect(CategoriasRepository::getGrupo($request)),
          'grupo' => $request->grupo,
          'unidades' => BaseRepository::toSelect(ProdutosRepository::unidades()),
          'title' => 'Painel de Controle - Vendedor - Dados do Novo Produto'
        ]);
    }

    public function novoGravar(ProdutoRequest $request)
    {
        ProdutosRepository::gravar($request);

        return SistemaService::jsonR(200, 1, 'Produto cadastrado com sucesso! <br> Por favor, aguarde a aprovação do mesmo.', route('sistema.dash.vendedor.produtos'));
    }

    public function editar(Produto $produto, ProdutoEditarRequest $request)
    {
        return view('sistema.dash.vendedor.produtos.editar', [
          'produto' => $produto,
          'categorias' => BaseRepository::toSelect(CategoriasRepository::all()),
          'subs' => BaseRepository::toSelect(CategoriasRepository::allSubs()),
          'grupos' => BaseRepository::toSelect(CategoriasRepository::allGrupos()),
          'unidades' => BaseRepository::toSelect(ProdutosRepository::unidades()),
          'title' => 'Painel de Controle - Vendedor - Editar Produto'
        ]);
    }

    public function salvar(Produto $produto, ProdutoRequest $request)
    {
        ProdutosRepository::salvar($produto, $request);

        return SistemaService::jsonR(200, 1, 'Produto alterado com sucesso! <br> Por favor, aguarde a aprovação do mesmo.', route('sistema.dash.vendedor.produtos'));
    }

    public function apagar(Produto $produto, ProdutoEditarRequest $request)
    {
        $produto->delete();
    }

    public function clona(Produto $produto, ProdutoEditarRequest $request)
    {
        ProdutosRepository::clona($produto);
    }

    public function banco()
    {
        $tamanho = ProdutosRepository::getTamanhoBanco($this->usuario->empresa);
        $limite = $this->usuario->empresa->plano->banco;
        if ($tamanho < $limite) {
            $add = true;
        } else {
            $add = false;
        }

        return view('sistema.dash.vendedor.produtos.banco', [
          'imagens' => ProdutosRepository::getBanco($this->usuario->empresa),
          'tamanho' => $tamanho,
          'add' => $add,
          'title' => 'Painel de Controle - Vendedor - Banco de Fotos'
        ]);
    }

    public function bancoApagar(Request $request)
    {
        foreach ($request->data as $data) {
            ProdutosRepository::apagaImagem($data);
        }
    }

    public function mensagemCategoria()
    {
        return view('sistema.dash.vendedor.produtos.mensagem-categoria');
    }

    public function mensagemCategoriaEnviar(MensagemCategoriaRequest $request)
    {
        SistemaService::enviaEmail('sistema.emails.mensagem-categoria', 'davi@voxdigital.com.br', '88 Market - Solicitação de inclusão de categorias', (object) $request);

        return SistemaService::jsonR(200, 1, 'Mensagem enviada com sucesso! <br> Aguarde nosso contato', route('sistema.dash.vendedor'), 1);
    }
}
