<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laracodes\Presenter\Traits\Presentable;

class Usuario extends Authenticatable
{
    use Presentable,  Notifiable;

    protected $guarded = [
      'csenha',
    ];
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $appends = [
      'EstadoUf',
      'cidadeCerta',
    ];

    protected $with = [
      'cidades',
    ];

    public $listagem = [
      'empresa',
      'email',
      'estado' => 'EstadoUf',
      // 'Cidade' => 'cidades.Nome',
    ];

    public $newButton = 'Nova Agência';
    public $title = 'Agência';
    public $hasForm = true;
    public $update = true;

    public $formulario = [
      'empresa' => [
        'title' => 'Empresa',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'nome' => [
        'title' => 'Nome do responsavel',
        'type' => 'text',
        'width' => 6,
      ],
      'email' => [
        'title' => 'E-mail',
        'type' => 'text',
        'width' => 12,
      ],
      'telefone1' => [
        'title' => 'Telefone',
        'type' => 'text',
        'width' => 6,
      ],
      'telefone2' => [
        'title' => 'Telefone 2',
        'type' => 'text',
        'width' => 6,
      ],
      'site' => [
        'title' => 'Site',
        'type' => 'text',
        'width' => 6,
        'validators' => 'nullable|url|min:3',
      ],
      'desde' => [
        'title' => 'Associada desde:',
        'type' => 'text',
        'width' => 6,
      ],
      'cnpj' => [
        'title' => 'cnpj',
        'type' => 'text',
        'width' => 12,
      ],
      'endereco' => [
        'title' => 'Endereço',
        'type' => 'text',
        'width' => 12,
      ],
      'bairro' => [
        'title' => 'Bairro',
        'type' => 'text',
        'width' => 12,
      ],
      'cep' => [
        'title' => 'Cep',
        'type' => 'text',
        'width' => 12,
      ],
      'estado_id' => [
        'title' => 'Estado',
        'type' => 'belongs',
        'width' => 6,
        'class' => 'estado',
        'model' => 'Estado',
        'show' => 'Uf',
        'state' => true,
        'search' => 'Uf',
        'src' => 'Usuario',
        'validators' => 'required|exists:estados,id',
      ],
      'municipio_id' => [
        'title' => 'Cidade',
        'type' => 'select',
        'src' => 'array',
        'data' => [],
        'model' => 'Cidade',
        'city' => true,
        'show' => 'Nome',
        'width' => 6,
        'validators' => 'required',
      ],
      'senha' => [
        'title' => 'Senha',
        'type' => 'password',
        'main' => true,
        'token' => 'remember_token',
        'token_size' => 60,
        'width' => 6,
      ],
      'csenha' => [
        'title' => 'Confirmar Senha',
        'type' => 'password',
        'width' => 6,
        'validators' => 'required_with:senha|same:senha',
      ],
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cidades()
    {
        return $this->belongsTo(Cidade::class, 'municipio_id', 'id');
    }

    protected $presenter = 'App\Http\Presenters\UsuarioPresenter';

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getEstadoUfAttribute()
    {
        if ($this->estado) {
            return $this->attributes['EstadoUf'] = $this->estado->Uf;
        }
    }

    public function getCidadeCertaAttribute()
    {
        if ($this->municipio_id != null) {
            return $this->attributes['cidadeCerta'] = $this->cidades->Nome;
        }
    }
}
