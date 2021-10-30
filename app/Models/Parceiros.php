<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parceiros extends Model
{
    protected $guarded = [];
    protected $appends = [
      'imageTag',
    ];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Parceiros';
    public $newButton = 'Novo Parceiro';

    public $listagem = [
      'nome',
      'imagem' => 'imageTag',
      'link',
    ];

    
    public $formulario = [
        'nome' => [
          'title' => 'Nome',
          'type' => 'text',
          'width' => 6,
          'validators' => 'required|string|min:3',
        ],
        'link' => [
          'title' => 'Link',
          'type' => 'text',
          'width' => 6,
          'validators',
        ],
        'imagem' => [
          'title' => 'Imagem',
          'type' => 'image',
          'width' => 12,
          'validators' => 'required|string|min:10',
        ]
      ];
  
      public function getImageTagAttribute()
      {
          return $this->attributes['imageTag'] = '<img src="' . $this->imagem . '"/>';
      }

}
