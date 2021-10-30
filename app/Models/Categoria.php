<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'nome',
        ],
      ];
    }

    protected $guarded = [];
    protected $appends = [
      'imageTag',
      'corDisplay',
    ];
    protected $searchable = [
      'nome',
    ];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Categorias';
    public $newButton = 'Nova categoria';

    public $listagem = [
      'nome',
      'imagem' => 'imageTag',
      'cor' => 'corDisplay',
    ];

    public $formulario = [
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3|unique:categorias,nome,$this->id',
      ],
      'imagem' => [
        'title' => 'Imagem',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'cor' => [
        'title' => 'Cor',
        'type' => 'color',
        'width' => 2,
        'validators' => 'required|string|size:7',
      ],
    ];

    public function getActions()
    {
        return [
        'subcategoria' => [
          'type' => 'a',
          'color' => 'info',
          'class' => 'btn-subs',
          'route' => 'backend.categorias.subs',
          'model' => 'subcategoria',
          'title' => 'Subcategorias para esta',
          'icon' => 'list-ol',
        ],
      ];
    }

    public function getImageTagAttribute()
    {
        return $this->attributes['imageTag'] = '<img src="' . $this->imagem . '"/>';
    }

    public function getCorDisplayAttribute()
    {
        return $this->attributes['corDisplay'] = '<div class="label" style="background-color: ' . $this->cor . '">COR</div>';
    }

    public function subs()
    {
        return $this->hasMany(Subcategoria::class)->orderBy('order', 'asc');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class)->where('status', 1);
    }
}
