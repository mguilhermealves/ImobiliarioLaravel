<?php

namespace App\Repositories\Categorias;

use App\Models\Grupo;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
use App\Repositories\Sistema\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoriasRepository
{
    private static $lista;
    public static function all() : Collection
    {
        return Categoria::orderBy('order', 'asc')->get();
    }

    public static function destaques()
    {
        $lista = Categoria::all()->each(function ($c) {
            $c->produtosCount = $c->produtos->count();
        });

        return $lista->sortByDesc('produtosCount')->take(5);
    }

    public static function getHome()
    {
        return Categoria::whereHas('produtos')->inRandomOrder()->paginate(6);
    }

    public static function busca(Request $request)
    {
        return Categoria::search($request->termo)->get();
    }

    public static function getSub(Request $request)
    {
        if ($request->id) {
            $subs = Categoria::find($request->id)->subs;
        }
        if ($request->categoria) {
            $subs = Categoria::find($request->categoria)->subs;
        }
        if ($request->li == true) {
            return self::makeList($subs);
        }
        if ($request->select == true) {
            return self::makeSelect($subs, $request);
        }

        return $subs;
    }

    public static function getGrupo(Request $request)
    {
        if ($request->id) {
            $grupos = Subcategoria::find($request->id)->grupos;
        }
        if ($request->sub) {
            $grupos = Subcategoria::find($request->sub)->grupos;
        }
        if ($request->li == true) {
            return self::makeList($grupos);
        }
        if ($request->select == true) {
            return self::makeSelect($grupos, $request);
        }

        return $grupos;
    }

    public static function makeList(Collection $items)
    {
        $lista = '';
        foreach ($items as $item) {
            $lista .= '<li data-id="' . $item->id . '">' . $item->nome . '</li>';
        }

        return $lista;
    }

    public static function makeSelect(Collection $items, Request $request)
    {
        return Form::select($request->name, [null => 'Selecione uma opção'] + BaseRepository::toSelect($items), $request->default ?? null, ['data-url' => $request->url, 'class' => 'custom-select select2 ' . $request->name, 'id' => $request->name]);
    }

    public static function allSubs()
    {
        return Subcategoria::all();
    }

    public static function allGrupos()
    {
        return Grupo::all();
    }

    public static function maisVisitadas(Empresa $empresa)
    {
        if ($empresa->produtos()->exists()) {
            foreach ($empresa->produtos as $p) {
                $categorias[] = $p->categoria->id ?? null;
            }
            $cats = array_unique($categorias);
            foreach ($cats as $c) {
                $count[$c] = Produto::where('categoria_id', $c)->sum('visitas');
            }
            arsort($count);
            $ranking = collect($count)->slice(0, 5);
            $resposta = new Collection();
            foreach ($ranking as $k => $v) {
                $categoria = Categoria::find($k);
                $categoria->visitas = $v;
                $resposta->push($categoria);
            }
        } else {
            $resposta = [];
        }

        return $resposta;
    }

    public static function subsMaisVisitadas(Empresa $empresa, Request $request)
    {
        $categoria = Categoria::find($request->i);
        foreach ($categoria->subs as $sub) {
            $count[$sub->id] = $sub->produtos->where('empresa_id', $empresa->id)->sum('visitas');
        }
        arsort($count);
        $ranking = collect($count)->slice(0, 5);
        $resposta = new Collection();
        foreach ($ranking as $k => $v) {
            $sub = Subcategoria::find($k);
            $sub->visitas = $v;
            $resposta->push($sub);
        }

        return $resposta;
    }

    public static function populares(Categoria $categoria)
    {
        if ($categoria->produtos()->exists()) {
            foreach ($categoria->produtos as $p) {
                $categorias[] = $p->subcategoria->id ?? null;
            }
            $cats = array_unique($categorias);
            foreach ($cats as $c) {
                $count[$c] = Subcategoria::find($c)->produtos->sum('visitas');
            }
            arsort($count);
            $ranking = collect($count)->slice(0, 3);
            $resposta = new Collection();
            foreach ($ranking as $k => $v) {
                $subcategoria = Subcategoria::find($k);
                $subcategoria->visitas = $v;
                $resposta->push($subcategoria);
            }
        } else {
            $resposta = [];
        }

        return $resposta;
    }
}
