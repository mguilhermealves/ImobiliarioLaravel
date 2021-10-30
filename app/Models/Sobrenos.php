<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sobrenos extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Sobre Nós';
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
      'imagem_interna' => [
        'title' => 'Imagem Interna',
        'type' => 'image',
        'width' => 6
      ],
      'missao' => [
        'title' => 'Missão',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'nullable|string|min:2',
      ],
      'visao' => [
        'title' => 'Visão',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'nullable|string|min:2',
      ],
      'valores' => [
        'title' => 'Valores',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'nullable|string|min:2',
      ],    
    ];
}
