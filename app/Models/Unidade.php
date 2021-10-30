<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $guarded = [];

    public $hasOrder = true;
    public $title = 'Unidades';
    public $newButton = 'Nova Unidade';
    public $hasForm = true;
    public $update = true;

    public $listagem = [
      'sigla',
      'nome',
    ];

    public $formulario = [
      'sigla' => [
        'title' => 'Sigla',
        'type' => 'text',
        'width' => 2,
        'validators' => 'required|string|min:1',
      ],
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 10,
        'validators' => 'required|string|min:3',
      ],
    ];
}
