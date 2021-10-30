<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'FAQ';
    public $newButton = 'Nova FAQ';

    public $listagem = [
      'titulo',
    ];

    public $formulario = [
      'titulo' => [
        'title' => 'Título',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3',
      ],
      'conteudo' => [
        'title' => 'Conteúdo',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'required|string|min:10',
      ],
    ];
}
