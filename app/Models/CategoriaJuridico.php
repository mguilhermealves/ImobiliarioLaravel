<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaJuridico extends Model
{   
    protected $guarded = [];
    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Categoria';
    public $newButton = 'Nova Categoria';

    public $listagem = [
      'nome',          
    ];

    public $formulario = [
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ]
    ];

  

}
