<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Empresa;
use App\Models\Empresagrupo;
use Illuminate\Http\Request;
use App\Models\Empresasubgrupo;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Grupos\GruposRepository;
use App\Http\Requests\Sistema\Dash\Vendedor\Grupos\GrupoRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Grupos\SubgrupoRequest;

class GruposController extends Controller
{
    public function grupos()
    {
        return view('sistema.dash.vendedor.grupos.index', [
        'totalVinculados' => GruposRepository::vinculadosTotal($this->usuario->empresa),
        'totalSemvinculo' => GruposRepository::semVinculo($this->usuario->empresa)->count(),
        'totalProdutos' => $this->usuario->empresa->produtos->count(),
        'grupos' => $this->usuario->empresa->grupos,
        'title' => 'Painel de Controle - Vendedor - Grupos'
      ]);
    }

    public function gruposGet()
    {
        return GruposRepository::gruposAjax($this->usuario->empresa);
    }

    public function grupoAdicionar(GrupoRequest $request)
    {
        GruposRepository::novoGrupo($request);
    }

    public function grupo(Empresagrupo $grupo)
    {
        return $grupo;
    }

    public function grupoSalvar(Empresa $empresa, GrupoRequest $request)
    {
        $grupo = GruposRepository::find($request->id);
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            return null;
        }
        GruposRepository::salvaGrupo($grupo, $request);
    }

    public function subgrupoAdicionar(SubgrupoRequest $request)
    {
        GruposRepository::novoSubGrupo($request);
    }

    public function grupoVinculados(Empresa $empresa, Empresagrupo $grupo, Empresasubgrupo $sub = null)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            return view('sistema.dash.negado');
        }

        return view('sistema.dash.vendedor.grupos.vinculados', [
          'empresa' => $empresa,
          'grupo' => $grupo,
          'sub' => $sub,
          'vinculados' => GruposRepository::vinculados($grupo, $sub),
          'vincular' => GruposRepository::semVinculo($empresa),
          'title' => 'Painel de Controle - Vendedor - Grupos Vinculados'
        ]);
    }

    public function grupoVincular(Empresa $empresa, Empresagrupo $grupo, EmpresaSubgrupo $sub = null, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            return view('sistema.dash.negado');
        }

        GruposRepository::vincular($grupo, $sub, $request);

        return SistemaService::jsonR(200, 1, 'Produtos vinculados com sucesso!', route('sistema.dash.vendedor.produtos.grupo.vinculados', [$empresa->id, $grupo->id, optional($sub)->id]), 1);
    }

    public function grupoDesvincular(Empresa $empresa, Empresagrupo $grupo, Empresasubgrupo $sub = null, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            return view('sistema.dash.negado');
        }

        GruposRepository::desvincular($grupo, $sub, $request);

        return SistemaService::jsonR(200, 1, 'Produtos vinculados com sucesso!', route('sistema.dash.vendedor.produtos.grupo.vinculados', [$empresa->id, $grupo->id, optional($sub)->id]), 1);
    }

    public function subgrupo(Empresa $empresa, Empresasubgrupo $sub)
    {
        if (!GruposRepository::checkDono($empresa, $sub->grupo)) {
            return null;
        }

        return $sub;
    }

    public function subgrupoSalvar(Empresa $empresa, Empresasubgrupo $sub, SubgrupoRequest $request)
    {
        if (!GruposRepository::checkDono($empresa, $sub->grupo)) {
            return null;
        }

        GruposRepository::salvaSubgrupo($sub, $request);
    }

    public function grupoApagar(Empresa $empresa, EmpresaGrupo $grupo, Empresasubgrupo $sub = null, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.produtos.grupos'));
        }
        GruposRepository::apagar($grupo, $sub, $request);
    }

    public function grupoExibir(Empresa $empresa, Empresagrupo $grupo, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.produtos.grupos'));
        }

        GruposRepository::exibe($grupo, $request);
    }

    public function grupoDestacados(Empresa $empresa, Empresagrupo $grupo)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            return view('sistema.dash.negado');
        }

        return view('sistema.dash.vendedor.grupos.destacados', [
          'empresa' => $empresa,
          'grupo' => $grupo,
          'destacados' => $grupo->produtos->where('pivot.destaque', 1),
          'destacar' => $grupo->produtos->where('pivot.destaque', 0),
          'title' => 'Painel de Controle - Vendedor - Grupos Destacados'
        ]);
    }

    public function grupoDestacar(Empresa $empresa, Empresagrupo $grupo, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.produtos.grupos'));
        }

        GruposRepository::destacar($grupo, $request);

        return SistemaService::jsonR(200, 1, 'Produtos destacados com sucesso!', route('sistema.dash.vendedor.produtos.grupo.destacados', [$empresa->id, $grupo->id]), 1);
    }

    public function grupoRemoverDestaque(Empresa $empresa, Empresagrupo $grupo, Request $request)
    {
        if (!GruposRepository::checkDono($empresa, $grupo)) {
            SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.produtos.grupos'));
        }

        GruposRepository::removeDestaque($grupo, $request);

        return SistemaService::jsonR(200, 1, 'Destaques removidos com sucesso!', route('sistema.dash.vendedor.produtos.grupo.destacados', [$empresa->id, $grupo->id]), 1);
    }
}
