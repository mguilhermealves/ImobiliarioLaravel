<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerNoticia extends Model
{
    protected $guarded = [];
    protected $appends = [
      'imageTag',
    ];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Banner Noticia';
    public $newButton = 'Novo Banner';

    public $listagem = [
      'nome',
      'imagem' => 'imageTag',
      'link',
    ];

    public $formulario = [
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'link' => [
        'title' => 'Link',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|url|min:3',
      ],
      'imagem' => [
        'title' => 'Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'required|string|min:10',
      ],
      
      'target' => [
        'title' => 'Target',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'blank', 1 => 'self'],
        'width' => 3,
      ],
    ];

    public function getImageTagAttribute()
    {
        return $this->attributes['imageTag'] = '<img src="' . $this->imagem . '"/>';
    }

}
