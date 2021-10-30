<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laracodes\Presenter\Traits\Presentable;

class CursosPalestra extends Model
{

  use Sluggable;
  use Presentable;

  public function sluggable()
  {
      return [
      'slug' => [
        'source' => ['titulo', 'titulo'],
      ],
    ];
  }

  protected $guarded = [
    'cursos_palestras_id'
  ];
  protected $appends = [
    'imageTag1',
    'imageTag2',
  ];
    
    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Cursos e Palestras';
    public $newButton = 'Novo Curso/Palestra';

  

    public $listagem = [
      'titulo',
      'resumo',
      'data',
      'local'
    ];

    public $formulario = [
    'tipo' => [
        'title' => 'Tipo',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Curso', 1 => 'Palestra'],
        'width' => 12,
        ],       
      'titulo' => [
        'title' => 'Titulo',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3',
      ],
      'resumo' => [
        'title' => 'Resumo',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'required|min:3',
      ],   
      'imagem1' => [
        'title' => 'Imagem',
        'type' => 'image',
        'width' =>12,      
      ],
      'data' => [
        'title' => 'Data',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'local' => [
        'title' => 'Local',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'valor' => [
        'title' => 'Valor',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'titulo_horas' => [
        'title' => 'Titulo Horas',
        'type' => 'text',
        'width' =>12,
        'validators' => 'required|string|min:3',
      ],
      'horas' => [
        'title' => 'Horas',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3',
      ],
      'descricao' => [
        'title' => 'Descricao',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'required|min:3',
      ],
      'programacao' => [
        'title' => 'Programação',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'required|min:3',
      ],
      'conteudo' => [
        'title' => 'Conteudo',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'required|min:3',
      ],
      'requisitos' => [
        'title' => 'Requisitos',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'required|min:3',
      ],
    ];


    public function getImageTag1Attribute()
    {
        return $this->attributes['imageTag1'] = '<img src="' . $this->imagem1 . '"/>';
    }

    public function getImageTag2Attribute()
    {
        return $this->attributes['imageTag2'] = '<img src="' . $this->imagem2 . '"/>';
    }

}
