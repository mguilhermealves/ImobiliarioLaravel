<?php

namespace App\Repositories\Vitrine;

use Illuminate\Http\Request;
use App\Models\Empresas\Empresa;


class VitrineRepository{

  static function gruposAjax(Empresa $empresa){
    $grupos = self::grupos($empresa);
    $html = view('frontend.panel.parts.tabela-grupos')->with('grupos', $grupos);
    return $html->render();
  }

  static function vinculados(Empresa $empresa){
    return $empresa->vitrine;
  }

  static function semVinculo(Empresa $empresa){
    return $empresa->produtos()->doesntHave('vitrine')->get();
  }

  static function vincular(Empresa $empresa, Request $request){
    $empresa->vitrine()->attach($request->vincular);
  }

  static function remover(Empresa $empresa, Request $request){
    $empresa->vitrine()->detach($request->id);
  }

}