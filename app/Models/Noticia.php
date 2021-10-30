<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laracodes\Presenter\Traits\Presentable;

class Noticia extends Model
{
    use Sluggable;
    use Presentable;

    public function sluggable()
    {
        return [
      'slug' => [
        'source' => ['titulo', 'titulo'],
      ],
    ];
    }

    protected $guarded = [];
    protected $appends = [
      'imageTag1',
      'imageTag2',
    ];
    protected $dates = [
    ];

    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Notícias';
    public $newButton = 'Nova Notícia';

    public $listagem = [
      'titulo',
      'resumo',
    ];

    public $formulario = [
      'data' => [
        'title' => 'Data da Postagem',
        'type' => 'text',
        'width' => 4,
        'class' => 'data-input-mask',
        'validators' => 'required|string|min:10',
      ],
      'titulo' => [
        'title' => 'Titulo',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3',
      ],
      'resumo' => [
        'title' => 'Resumo',
        'type' => 'textarea',
        'editor' => false,
        'width' => 12,
        'validators' => 'required|min:3',
      ],
      'imagem' => [
        'title' => 'Imagem',
        'type' => 'image',
        'width' => 12,
      ],
      'conteudo' => [
        'title' => 'Descricao',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
      ],
    ];

    public function getImageTag1Attribute()
    {
        return $this->attributes['imageTag1'] = '<img src="' . $this->imagem1 . '"/>';
    }

    public function getImageTag2Attribute()
    {
        return $this->attributes['imageTag2'] = '<img src="' . $this->imagem2 . '"/>';
    }
}
