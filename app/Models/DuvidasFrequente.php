<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuvidasFrequente extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Dúvidas Frequentes';
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
      'perguntas' => [
        'title' => 'Perguntas',
        'type' => 'repeater',
        'width' => 12,
        'button' => 'Nova Pergunta',
        'button_d' => 'Remover Pergunta',
        'validators' => 'nullable|array',
        'fields' => [
          'pergunta' => [
            'title' => 'Pergunta',
            'type' => 'text',
            'width' => 12,
            'validators' => 'nullable|string|min:10',
          ],
          'resposta' => [
            'title' => 'Resposta',
            'type' => 'textarea',
            'editor' => true,
            'width' => 12,
            'validators' => 'nullable|string|min:10',
          ]
        ],       
      ],
    ];
}
