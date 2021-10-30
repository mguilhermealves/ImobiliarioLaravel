<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Grupo extends Model
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
      'subcategoriaNome',
    ];

    public $hasOrder = true;
    public $hasForm = true;
    public $update = true;
    public $title = 'Grupos';
    public $newButton = 'Novo Grupo';

    public $listagem = [
      'nome',
      'subcategoria' => 'subcategoriaNome',
    ];

    public $formulario = [
      'subcategoria_id' => [
        'type' => 'info',
        'validators' => 'required|int|exists:subcategorias,id',
      ],
      'nome' => [
        'title' => 'Nome',
        'type' => 'text',
        'width' => 12,
        'validators' => 'required|string|min:3|unique_with:grupos,nome,subcategoria_id,$this->id',
      ],
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'grupo_id', 'id')->where('status', 1);
    }

    public function getSubCategoriaNomeAttribute()
    {
        return $this->attributes['subcategoriaNome'] = $this->subcategoria->nome;
    }
}
