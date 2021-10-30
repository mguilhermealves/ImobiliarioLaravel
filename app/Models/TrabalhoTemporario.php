<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrabalhoTemporario extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Trabalho Temporário';
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
      'titulo_funciona' => [
        'title' => 'Titulo Funciona',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto_funciona' => [
        'title' => 'Texto Funciona',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],

    ];
}