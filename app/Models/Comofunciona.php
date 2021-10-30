<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comofunciona extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Como Funciona';
    public $type = 'page';
    public $formulario = [
      'banner' => [
        'title' => 'Banner',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'titulo' => [
        'title' => 'Título',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'subtitulo' => [
        'title' => 'Subtítulo',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem_1' => [
        'title' => 'Bloco 1 - Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'titulo_1' => [
        'title' => 'Bloco 1 - Título',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto_1' => [
        'title' => 'Bloco 1 - Texto',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem_2' => [
        'title' => 'Bloco 2 - Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'titulo_2' => [
        'title' => 'Bloco 2 - Título',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto_2' => [
        'title' => 'Bloco 2 - Texto',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem_3' => [
        'title' => 'Bloco 3 - Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'titulo_3' => [
        'title' => 'Bloco 3 - Título',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto_3' => [
        'title' => 'Bloco 3 - Texto',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto' => [
        'title' => 'Texto - Como Funciona',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'passos' => [
        'title' => 'Passos',
        'type' => 'repeater',
        'width' => 12,
        'button' => 'Novo Passo',
        'button_d' => 'Remover Passo',
        'validators' => 'nullable|array',
        'fields' => [
          'titulo' => [
            'title' => 'Título',
            'type' => 'text',
            'width' => 12,
            'validators' => 'nullable|string|min:10',
          ],
          'texto' => [
            'title' => 'Conteúdo',
            'type' => 'textarea',
            'editor' => true,
            'width' => 12,
            'validators' => 'nullable|string|min:10',
          ],
        ],
      ],
    ];
}
