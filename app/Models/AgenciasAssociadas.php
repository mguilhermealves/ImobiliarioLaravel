<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgenciasAssociadas extends Model
{
    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Agencias';
    public $newButton = 'Nova Agencia';

    public $listagem = [
      'nome',
      'endereco',
      'link',
    ];

    public $formulario = [
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'telefone' => [
        'title' => 'telefone',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required',
      ],
      'endereco' => [
        'title' => 'endereco',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required',
      ],
      'site' => [
        'title' => 'site',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required',
      ]
    ];

   
}
