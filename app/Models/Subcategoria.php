<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Subcategoria extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'nome',
          'unique' => false,
        ],
      ];
    }

    protected $guarded = [];
    protected $appends = [
      'categoriaNome',
      'imageTag',
      'corDisplay',
    ];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Sub Categorias';
    public $newButton = 'Nova Subcategoria';

    public $listagem = [
      'imagem' => 'imageTag',
      'nome',
      'cor' => 'corDisplay',
    ];

    public $formulario = [
      'categoria_id' => [
        'type' => 'info',
        'validators' => 'required|int|exists:categorias,id',
      ],
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3|unique_with:subcategorias,nome,categoria_id,$this->id',
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
          'color' => 'primary',
          'class' => 'btn-subs',
          'route' => 'backend.categorias.grupos',
          'model' => 'grupo',
          'title' => 'Grupos para esta',
          'icon' => 'th-list',
        ],
      ];
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->orderBy('order', 'asc');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class)->where('status', 1);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class)->orderBy('order', 'asc');
    }

    public function getImageTagAttribute()
    {
        return $this->attributes['imageTag'] = '<img src="' . $this->imagem . '"/>';
    }

    public function getCategoriaNomeAttribute()
    {
        return $this->attributes['categoriaNome'] = $this->categoria->nome;
    }

    public function getCorDisplayAttribute()
    {
        return $this->attributes['corDisplay'] = '<div class="label" style="background-color: ' . $this->cor . '">COR</div>';
    }
}
