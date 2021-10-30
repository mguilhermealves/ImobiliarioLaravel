<?php

namespace App\Http\Controllers\Sistema;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Cotacoes\CotacaoRepository;
use App\Repositories\Mensagens\MensagemRepository;
use App\Http\Requests\Sistema\Produtos\CotacaoRequest;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;
use App\Repositories\Produtos\ProdutosRepository;

class ProdutosController extends Controller
{
    public function index(Produto $produto)
    {
        ProdutosRepository::updateVisitas($produto);

        return view('sistema.produtos.index', [
          'produto' => $produto,
          'title' => $produto->nome
        ]);
    }

    public function cotacao(Produto $produto)
    {
        return view('sistema.produtos.cotacao', [
          'produto' => $produto,
          'title' => $produto->nome . '/ Cotação'
        ]);
    }

    public function enviaCotacao(Produto $produto, CotacaoRequest $request)
    {
        $cotacao = CotacaoRepository::direta($this->usuario->empresa, $produto, $request);
        $msg = MensagemRepository::criaMensagem($this->usuario, $produto->empresa->usuario, $cotacao);
        $mRequest = new MensagemRequest();
        $mRequest->mensagem = $cotacao->detalhes;
        MensagemRepository::criaMensagemItem($msg, $produto->empresa->usuario, $mRequest);
        ProdutosRepository::delFavorito($this->usuario, $produto);

        return SistemaService::jsonR(200, 1, 'Cotação enviada com sucesso! Aguarde a resposta do vendedor.', route('sistema.produto', $produto->slug));
    }

    public function addFavorito(Produto $produto)
    {
        ProdutosRepository::addFavorito($this->usuario, $produto);

        return view('sistema.parts.produtos.del-favorito', [
            'produto' => $produto,
          ])->render();
    }

    public function delFavorito(Produto $produto)
    {
        ProdutosRepository::delFavorito($this->usuario, $produto);

        return view('sistema.parts.produtos.add-favorito', [
          'produto' => $produto,
        ])->render();
    }
}
