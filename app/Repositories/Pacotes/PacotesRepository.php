<?php 
  
namespace App\Repositories\Pacotes;

use App\Models\Pacotes\Pacote;
use App\Http\Requests\Pacotes\PacoteRequest;

class PacotesRepository{

  static function get(){
    $data['data'] = Pacote::all();
    foreach( $data['data'] as $d ){
      $d->preco = currencyToApp($d->preco);
      $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="'.route('backend.pacotes.pacote', $d->id).'" data-titulo="Edição de Pacote" data-toggle="tooltip" title="Ver / Editar Pacote"><i class="fa fa-pencil"></i></button>';
    }
    return response()->json($data);
  }

  static function Salvar(PacoteRequest $request){
    Pacote::find($request->id)->update($request->all());
  }

}