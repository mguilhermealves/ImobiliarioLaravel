<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Estado extends Model
{
    protected $guarded = [];
    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Estado';
    public $newButton = 'Novo Estado';

    public $listagem = [
      'Uf',          
    ];

    public $formulario = [
      'Uf' => [
        'title' => 'Uf',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ]
    ];    
}
