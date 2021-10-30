<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Clientes';
    public $newButton = 'Novo Cliente';

    public $listagem = [
        'nome',
        'cpf'
    ];

    public $formulario = [
        'nome' => [
            'title' => 'Nome',
            'type' => 'text',
            'width' => 6,
            'validators' => 'required|string|min:3',
        ],
        'cpf' => [
            'title' => 'CPF',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:3',
        ],
        'rg' => [
            'title' => 'RG',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:3',
        ],
        'cnh' => [
            'title' => 'CNH',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:3',
        ],
        'casado' => [
            'title' => 'Casado',
            'type' => 'radio',
            'src' => 'array',
            'data' => [0 => 'Não', 1 => 'Sim'],
            'width' => 12,
            'validators' => 'required',
        ],
        'endereco' => [
            'title' => 'Endereço',
            'type' => 'text',
            'width' => 12,
            'validators' => 'required|string|min:3',
        ],
        'numero' => [
            'title' => 'Número',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:1',
        ],
        'complemento' => [
            'title' => 'Complemento',
            'type' => 'text',
            'width' => 4,
            'validators' => 'required|string|min:3',
        ],
        'bairro' => [
            'title' => 'Bairro',
            'type' => 'text',
            'width' => 4,
            'validators' => 'required|string|min:3',
        ],
        'cep' => [
            'title' => 'CEP',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:3',
        ],
        'cidade' => [
            'title' => 'Cidade',
            'type' => 'text',
            'width' => 3,
            'validators' => 'required|string|min:3',
        ],
        'uf' => [
            'title' => 'UF',
            'type' => 'text',
            'width' => 2,
            'validators' => 'required|string|min:2',
        ],
        // 'type' => [
        //     'title' => 'Tipo',
        //     'type' => 'select',
        //     'src' => 'array',
        //     'data' => [],
        //     // 'model' => 'Cidade',
        //     // 'city' => true,
        //     // 'show' => 'Nome',
        //     'width' => 3,
        //     // 'validators' => 'required',
        // ],
        'ativo' => [
            'title' => 'Ativo',
            'type' => 'radio',
            'src' => 'array',
            'data' => [0 => 'Não', 1 => 'Sim'],
            'width' => 12,
            'validators' => 'required',
        ]
    ];
}
