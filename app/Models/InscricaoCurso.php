<?php

namespace App\Models;

use App\Models\CursosPalestra;
use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;


class InscricaoCurso extends Model
{

    use Presentable;


protected $appends = [
    'curso',   
    ];    

 protected $fillable = [
     'cursos_palestras_id',
     'nome',
     'email',
     'assunto',
     'telefone',
     'mensagem'     
    ];


public $hasOrder = false;
public $hasForm = true;
public $update = true;
public $title = 'Inscrições Curso';
public $newButton = 'Novo Inscrição';

public $listagem = [
    'nome',
    'email',
    'telefone',
    'curso'=>'curso'
    ];


public $formulario = [
'cursos_palestras_id' => [
    'title' => 'Curso de interesse',
    'type' => 'belongs',
    'model' => 'CursosPalestra',
    'show' => 'titulo',
    'width' => 12,
    'state' => false
    ],
'nome' => [
    'title' => 'Nome',
    'type' => 'text',
    'width' => 4,
    'validators' => 'required|string|min:3',
    ],  
'email' => [
    'title' => 'E-mail',
    'type' => 'text',
    'width' => 4,
    'validators' => 'required|string|email',
    ],  
'telefone' => [
    'title' => 'Telefone',
    'type' => 'text',
    'width' => 4,
    'validators' => 'required|string',
    ],
'assunto' => [
    'title' => 'Assunto',
    'type' => 'text',
    'width' => 6,
    'validators' => 'required|string',
    ],
'mensagem' => [
    'title' => 'Mensagem',
    'type' => 'textarea',
    'editor' => false,
    'width' => 6,    
    ],  
];

public function cursos_palestras()
{
    return $this->belongsTo(CursosPalestra::class);
}

public function getCursoAttribute()
{
    if ($this->cursos_palestras()->exists()) {
        return $this->attributes['curso'] = $this->cursos_palestras->titulo;
    }
}
  

}

