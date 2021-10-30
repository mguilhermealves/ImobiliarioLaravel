<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];
    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Videos';
    public $newButton = 'Novo Video';

    public $listagem = [
      'titulo',     
    ];

    public $formulario = [
        'titulo' => [
          'title' => 'Título',
          'type' => 'text',
          'width' => 6,
          'validators' => 'required|string|min:3',
        ],
        'iframe' => [
          'title' => 'Iframe',
          'type' => 'text',
          'width' => 6,
          'validators' => 'required|string|min:3',
        ],
    ];
}
