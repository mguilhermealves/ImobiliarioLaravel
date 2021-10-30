<?php

namespace App\Repositories\Faqs;

use App\Models\Faqs\Faq;
use Illuminate\Http\Request;
use App\Models\Faqs\Categoria;
use App\Models\Faqs\CategoriaFaq;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\Faqs\FaqsRequest;

class FaqsRepository
{

  static function all(Int $tipo){
    return Faq::where('tipo', $tipo)->get();
  }

  static function porCategoria(CategoriaFaq $categoria){
    return $categoria->faqs;
  }

  static function busca(Request $request){
    return Faq::where('titulo', 'like', '%'.$request->termos.'%')->orWhere('conteudo', 'like', '%'.$request->termos.'%')->get();
  }

  static function find(Int $id){
    return Faq::find($id);
  }

  static function Cadastrar(FaqsRequest $request){
    return Faq::create($request->all());
  }

  static function get(Int $tipo){
    $data['data'] = self::all($tipo);
    foreach( $data['data'] as $d ){
      $d->cat = $d->categoria->nome;
      $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-titulo="Visualizar faq: '.$d->nome.'" data-url="'.route('backend.faqs.faq', $d->id).'" data-toggle="tooltip" title="Ver / Editar Faq"><i class="fa fa-pencil"></i></button>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route('backend.faq.apagar', $d->id).'" data-toggle="tooltip" title="Excluir Faq"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  static function Salvar(Faq $faq, FaqsRequest $request){
    $faq->update($request->all());
  }

  static function Apagar(Faq $faq){
    $faq->delete();
  }

  static function getLabel(Int $tipo){
    switch( $tipo ){
      case 0:
        return 'Como Pesquisar';
        break;
      case 1:
        return 'Como Anunciar';
        break;
      case 2:
        return 'Dúvidas Frequentes';
        break;
      case 3:
        return 'Políticas e Regras';
        break;
    }
  }

}
