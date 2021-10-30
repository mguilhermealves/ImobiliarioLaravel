<?php

namespace App\Repositories\Faqs;

use Illuminate\Http\Request;
use App\Models\Faqs\CategoriaFaq;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\Faqs\CategoriasFaqRequest;

class CategoriasFaqRepository
{

  static function all(Int $tipo){
    return CategoriaFaq::where('tipo', $tipo)->get();;
  }

  static function find(Int $id){
    return CategoriaFaq::find($id);
  }

  static function Cadastrar(CategoriasFaqRequest $request){
    return CategoriaFaq::create($request->all());
  }

  static function get(Int $tipo){
    $data['data'] = self::all($tipo);
    foreach( $data['data'] as $d ){
      $d->quantidade = $d->faqs->count();
      $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-titulo="Visualizar categoria: '.$d->nome.'" data-url="'.route('backend.faq.categoria', $d->id).'" data-toggle="tooltip" title="Ver / Editar CategoriaFaq"><i class="fa fa-pencil"></i></button>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route('backend.faq.categoria.apagar', $d->id).'" data-toggle="tooltip" title="Excluir CategoriaFaq"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  static function Salvar(CategoriaFaq $categoria, CategoriasFaqRequest $request){
    $categoria->update($request->all());
  }

  static function Apagar(CategoriaFaq $categoria){
    $categoria->delete();
  }

}
