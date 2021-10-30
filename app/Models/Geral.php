<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geral extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Geral';
    public $type = 'page';
    public $formulario = [
      'subtitulo_cursos_palestras' => [
        'title' => 'Subtítulo Cursos e palestras',
        'type' => 'text',
        'width' => 6
      ],
      'subtitulo_noticias' => [
        'title' => 'Subtítulo Notícias',
        'type' => 'text',
        'width' => 6
      ],
      'subtitulo_agencias_associadas' => [
        'title' => 'Subtítulo Agências associadas',
        'type' => 'text',
        'width' => 6
      ],
      'subtitulo_quero_associar' => [
        'title' => 'Subtítulo Quero me associar',
        'type' => 'text',
        'width' => 6
      ],
      'subtitulo_contato' => [
        'title' => 'Subtítulo Contato',
        'type' => 'text',
        'width' => 6
      ],
      'atendimento' => [
        'title' => 'Atendimento',
        'type' => 'text',
        'width' => 6
      ],
      'whatsapp' => [
        'title' => 'Whatsapp',
        'type' => 'text',
        'width' => 6
      ],
      'onde_estamos' => [
        'title' => 'Onde estamos',
        'type' => 'text',
        'width' => 6
      ],
      'como_chegar' => [
        'title' => 'Como chegar',
        'type' => 'text',
        'width' => 6
      ],
      'conteudo_area_restrita' => [
        'title' => 'Conteudo Área Restrita',
        'type' => 'textarea',
        'editor'=>true,
        'width' => 6
      ],
      'conteudo_associar' => [
        'title' => 'Conteudo associar',
        'type' => 'textarea',
        'editor'=>true,
        'width' => 6
      ],
     
        'emails' => [
        'title' => 'Emails para contato',
        'type' => 'repeater',
        'width' => 12,
        'button' => 'Novo E-mail',
        'button_d' => 'Remover E-mail',
        'validators' => 'nullable|array',
        'fields' => [
          'email' => [
            'title' => 'E-mail',
            'type' => 'text',
            'width' => 12,
            'validators' => 'nullable|string|min:10',
          ],
        ],
      ],
     
      

    ];
}
