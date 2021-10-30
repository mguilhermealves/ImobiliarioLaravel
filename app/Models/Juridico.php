<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juridico extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Jurídico';
    public $type = 'page';
    public $formulario = [
      'titulo' => [
        'title' => 'Título',
        'type' => 'text',
        'width' => 12,
        'validators' => 'nullable|string|min:2',
      ],
      'subtitulo' => [
        'title' => 'Subtítulo',
        'type' => 'text',
        'width' => 12,
        'validators' => 'nullable|string|min:2',
      ],
      'conteudo' => [
        'title' => 'Conteúdo',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'categoria' => [
        'title' => 'Categorias',
        'type' => 'repeater',
        'width' => 12,
        'button' => 'Nova Categoria',
        'button_d' => 'Remover Categoria',
        'validators' => 'nullable|array',
        'fields' => [
          'nome' => [
            'title' => 'Nome',
            'type' => 'text',
            'width' => 4,
            'validators' => 'nullable|string|min:10',
          ],
        ],
      ],
    ];
}
