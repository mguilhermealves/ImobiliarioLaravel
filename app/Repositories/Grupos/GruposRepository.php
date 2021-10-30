<?php

namespace App\Repositories\Grupos;

use App\Models\Empresa;
use App\Models\Empresagrupo;
use Illuminate\Http\Request;
use App\Http\Requests\Sistema\Dash\Vendedor\Grupos\GrupoRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Grupos\SubgrupoRequest;
use App\Models\Empresasubgrupo;
use Illuminate\Database\Eloquent\Collection;

class GruposRepository
{
    private static $a = [];

    public static function find(Int $id)
    {
        return Empresagrupo::find($id);
    }

    public static function gruposAjax(Empresa $empresa)
    {
        return view('sistema.parts.dash.tabela-grupos', [
          'grupos' => $empresa->grupos,
        ])->render();
    }

    public static function novoGrupo(GrupoRequest $request)
    {
        Empresagrupo::create($request->all());
    }

    public static function salvaGrupo(Empresagrupo $grupo, GrupoRequest $request)
    {
        $grupo->update($request->except('id'));
    }

    public static function novoSubGrupo(SubgrupoRequest $request)
    {
        Empresasubgrupo::create($request->all());
    }

    public static function salvaSubGrupo(Empresasubgrupo $sub, SubgrupoRequest $request)
    {
        $sub->update($request->all());
    }

    public static function vinculados(Empresagrupo $grupo, Empresasubgrupo $sub = null)
    {
        if ($sub == null) {
            return $grupo->produtos;
        }

        return $sub->produtos;
    }

    public static function vinculadosTotal(Empresa $empresa)
    {
        $empresa->grupos->each(function ($g) {
            $g->produtos->each(function ($p) {
                self::$a[] = $p->id;
            });
        });

        return count(self::$a);
    }

    public static function semVinculo(Empresa $empresa)
    {
        return $empresa->produtos()->where('status', 1)->doesntHave('grupos')->doesntHave('subgrupos')->get();
    }

    public static function vincular(Empresagrupo $grupo, Empresasubgrupo $sub = null, Request $request)
    {
        if ($sub == null) {
            $vinculados = self::getVinculadosToArray($grupo->produtos);
            $grupo->produtos()->sync(array_merge($vinculados, $request->vincular));
        } else {
            $vinculados = self::getVinculadosToArray($sub->produtos);
            $sub->produtos()->sync(array_merge($vinculados, $request->vincular));
            $vinculadosG = self::getVinculadosToArray($sub->grupo->produtos);
            $grupo->produtos()->sync(array_merge($vinculadosG, $request->vincular));
        }
    }

    public static function desvincular(Empresagrupo $grupo, Empresasubgrupo $sub = null, Request $request)
    {
        if ($sub == null) {
            $vinculados = self::getVinculadosToArray($grupo->produtos);
            $grupo->produtos()->sync(array_diff($vinculados, $request->vincular));
        } else {
            $vinculados = self::getVinculadosToArray($sub->produtos);
            $sub->produtos()->sync(array_diff($vinculados, $request->vincular));
            $vinculadosG = self::getVinculadosToArray($sub->grupo->produtos);
            $grupo->produtos()->sync(array_diff($vinculadosG, $request->vincular));
        }
    }

    public static function getVinculadosToArray(Collection $lista)
    {
        $vinculados = [];
        foreach ($lista as $p) {
            $vinculados[] = $p->id;
        }

        return $vinculados;
    }

    public static function destacar(Empresagrupo $grupo, Request $request)
    {
        foreach ($request->vincular as $id) {
            $grupo->produtos()->updateExistingPivot($id, ['destaque' => 1]);
        }
    }

    public static function removeDestaque(Empresagrupo $grupo, Request $request)
    {
        foreach ($request->vincular as $id) {
            $grupo->produtos()->updateExistingPivot($id, ['destaque' => 0]);
        }
    }

    public static function exibe(Empresagrupo $grupo, Request $request)
    {
        if ($grupo) {
            $grupo->exibir = $request->f;
            $grupo->save();
        }
    }

    public static function checkDono(Empresa $empresa, Empresagrupo $grupo, Empresasubgrupo $sub = null)
    {
        if ($empresa->id !== $grupo->empresa_id) {
            return false;
        }
        if ($sub != null) {
            if ($empresa->id !== $sub->grupo->empresa_id) {
                return false;
            }
        }

        return true;
    }

    public static function apagar(Empresagrupo $grupo, Empresasubgrupo $sub = null, Request $request)
    {
        $request['vincular'] = [];
        if ($sub != null) {
            $sub->delete();
        } else {
            $grupo->delete();
        }

        self::desvincular($grupo, $sub, $request);
    }

    public static function getDestacados(Empresagrupo $grupo)
    {
        return $grupo->produtos->where('pivot.destaque', 1)->where('status', 1);
    }
}
