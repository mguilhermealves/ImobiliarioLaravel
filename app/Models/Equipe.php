<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $guarded = [];
    protected $appends = [
      'imageTag',
      'tipoTag',
    ];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Equipe';
    public $newButton = 'Novo membro';

    public $listagem = [
      'nome',
      'imagem' => 'imageTag',
      'Tipo' => 'tipoTag',
    ];

    public $formulario = [
      'tipo' => [
        'title' => 'Tipo de Profissional',
        'type' => 'radio',
        'width' => 12,
        'src' => 'array',
        'data' => [0 => 'DIRETORIA EXECUTIVA', 1 => 'DIRETORIA REGIONAL', 2 => 'CONSELHO FISCAL', 3 => 'CONSELHO CONSULTIVO'],
        'validators' => 'required|int|min:0|max:3',
      ],
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3',
      ],
      'informacoes' => [
        'title' => 'Informações',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
        'validators' => 'required',
      ],
      'imagem' => [
        'title' => 'Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'required|string|min:10',
      ],
    ];

    public function getImageTagAttribute()
    {
        return $this->attributes['imageTag'] = '<img src="' . $this->imagem . '"/>';
    }

    public function getTipoTagAttribute()
    {
        switch ($this->tipo) {
        case 0:
          $tag = '<label for="" class="label label-primary">DIRETORIA EXECUTIVA</label>';

          break;
        case 1:
          $tag = '<label for="" class="label label-success">DIRETORIA REGIONAL</label>';

          break;
        case 2:
          $tag = '<label for="" class="label label-warning">CONSELHO FISCAL</label>';

          break;
        case 3:
          $tag = '<label for="" class="label label-info">CONSELHO CONSULTIVO</label>';

          break;

        default:
          # code...
          break;
      }

        return $this->attributes['tipoTag'] = $tag;
    }
}
