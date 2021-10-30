<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Empresa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Empresas\EmpresasRepository;
use App\Http\Requests\Sistema\Dash\Vendedor\Website\WebsiteRequest;

class WebsiteController extends Controller
{
    public function index()
    {
        $website = EmpresasRepository::checkSite($this->usuario->empresa);

        return view('sistema.dash.vendedor.website.index', [
          'website' => $website,
          'grupos' => $this->usuario->empresa->grupos->pluck('nome', 'id')->toArray(),
          'title' => 'Painel de Controle - Vendedor - Meu Website'
        ]);
    }

    public function salvar(WebsiteRequest $request)
    {
        EmpresasRepository::salvaSite($this->usuario->empresa, $request);

        return SistemaService::jsonR(200, 1, 'Website atualizado com sucesso!', route('sistema.dash.vendedor.website'));
    }

    public function vitrine()
    {
        if ($this->usuario->empresa->plano->vitrine == 0 ) {
          return view('sistema.dash.negado');
        }
        
        return view('sistema.dash.vendedor.website.vitrine', [
          'vitrine' => $this->usuario->empresa->produtos->where('vitrine', 1),
          'title' => 'Painel de Controle - Vendedor - Vitrine'
        ]);
    }

    public function vitrineProdutos(Empresa $empresa)
    {
        if ($this->usuario->empresa->id !== $empresa->id) {
            return view('sistema.dash.negado');
        }

        return view('sistema.dash.vendedor.website.vitrine-produtos', [
          'items' => $this->usuario->empresa->produtos->where('vitrine', 0)->where('status', 1),
        ]);
    }

    public function vitrineProdutosAdicionar(Empresa $empresa, Request $request)
    {
        if ($this->usuario->empresa->id !== $empresa->id) {
            return SistemaService::jsonR(401, 0, 'Acesso não permitido!', route('sistema.dash.vendedor.website'));
        }

        $limite = $empresa->plano->vitrine;
        $count = $this->usuario->empresa->produtos->where('vitrine', 1)->count();
        if ($count < $limite) {
            EmpresasRepository::adicionaVitrine($empresa, $request);

            return SistemaService::jsonR(200, 1, 'Produtos adicionados com sucesso!', route('sistema.dash.vendedor.vitrine.produtos', [$empresa->id]), 1);
        }

        return SistemaService::jsonR(200, 0, 'Você atingiu o limite de produtos na vitrine do seu plano atual!', route('sistema.dash.vendedor.vitrine.produtos', [$empresa->id]), 1);
    }

    public function vitrineProdutosRemover(Empresa $empresa, Produto $produto)
    {
        if ($this->usuario->empresa->id !== $empresa->id) {
            return SistemaService::jsonR(401, 0, 'Acesso não permitido!', route('sistema.dash.vendedor.website'));
        }

        EmpresasRepository::removeVitrine($produto);

        return SistemaService::jsonR(200, 1, 'Produto removido com sucesso!', route('sistema.dash.vendedor.vitrine.produtos', [$empresa->id]), 1);
    }
}
