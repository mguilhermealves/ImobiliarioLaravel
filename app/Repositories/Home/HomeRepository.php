<?php
  namespace App\Repositories\Home;

use Illuminate\Http\Request;
use App\Models\HomeConfig;
use App\Models\Parceiros;
use App\Models\ArquivosJuridicos;
use App\Models\Home\CategoriaHome;
use App\Models\Home\CategoriaDestaque;

class HomeRepository
{
    public static function getHomeConfig()
    {
        return HomeConfig::first();
    }

    public static function getParceiros()
    {
        return Parceiros::all();
    }

    public static function getArquivosJuridicos()
    {
        return ArquivosJuridicos::all();
    }

    public static function getArquivosJuridicosRestrita()
    {
        return ArquivosJuridicos::all();
    }

    public static function getCategorias()
    {
        return CategoriaHome::all()->pluck('categoria_id')->toArray();
    }

    public static function getDestaques()
    {
        return CategoriaDestaque::all()->pluck('categoria_id')->toArray();
    }

    public static function getCategoriasFront()
    {
        return CategoriaHome::all();
    }

    public static function getDestaquesFront()
    {
        return CategoriaDestaque::all();
    }

    public static function salvaDestaques(Request $request)
    {
        self::deletaDestaques();
        foreach ($request->destaques as $c) {
            CategoriaDestaque::create(['categoria_id' => $c]);
        }
    }

    public static function deletaCategorias()
    {
        foreach (CategoriaHome::all() as $c) {
            $c->delete();
        }
    }

    public static function salvaCategorias(Request $request)
    {
        self::deletaCategorias();
        foreach ($request->categoria_id as $c) {
            CategoriaHome::create(['categoria_id' => $c]);
        }
    }

    public static function deletaDestaques()
    {
        foreach (CategoriaDestaque::all() as $c) {
            $c->delete();
        }
    }
}
