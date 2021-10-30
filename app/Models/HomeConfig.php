<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeConfig extends Model
{
    protected $guarded = [];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Homepage';
    public $type = 'page';
    public $formulario = [     
      'titulo' => [
        'title' => 'Título',
        'type' => 'text',      
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'video_home' => [
        'title' => 'Vídeo Homepage',
        'type' => 'text',        
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'numeros' => [
        'title' => 'Números Asserttem',
        'type' => 'repeater',
        'width' => 12,
        'button' => 'Novo Número',
        'button_d' => 'Remover Número',
        'validators' => 'nullable|array',
        'fields' => [
          'numero' => [
            'title' => 'Número',
            'type' => 'text',
            'width' => 4,
            'validators' => 'nullable|string|min:3',
          ],
          'texto' => [
            'title' => 'Texto',
            'type' => 'text',
            'width' => 6,
            'validators' => 'nullable|string|min:3',
          ],
        ],       
      ],
      'titulo_associe' => [
        'title' => 'Titulo Associe',
        'type' => 'text',
        'width' =>12,
        'validators' => 'nullable|string|min:10',
      ],
      'texto_associe' => [
        'title' => 'Texto Associe',
        'type' => 'textarea',
        'editor' => true,
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],      
      'imagem_associe' => [
        'title' => 'Imagem Associe',
        'type' => 'image',
        'width' => 12
      ],
      'botao_associar' => [
        'title' => 'Botão Associar topo',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ],      
      'facebook' => [
        'title' => 'Facebook',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ],      
      'instagram' => [
        'title' => 'Youtube',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ],      
      'linkedin' => [
        'title' => 'Linkedin',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ],      
      'telefone_rodape' => [
        'title' => 'Telefone rodapé',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ], 
      'email_rodape' => [
        'title' => 'E-mail Rodapé',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ], 
      'endereco_rodape' => [
        'title' => 'Endereço Rodapé',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ], 
      'link_endereco' => [
        'title' => 'Link Endereço',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ], 
      'atendimento_rodape' => [
        'title' => 'Atendimento Rodapé',
        'type' => 'text',        
        'width' => 3,
        'validators' => 'nullable|string',
      ],      
    ];
}
