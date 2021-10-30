<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Ajudas de Comprador';
    public $newButton = 'Nova Ajuda de Comprador';

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
