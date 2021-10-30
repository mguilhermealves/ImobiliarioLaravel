<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Empresasubgrupo extends Model
{
    use Sluggable;

    protected $guarded = [
      'empresa_id',
    ];

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => ['nome'],
        ],
      ];
    }

    public function grupo()
    {
        return $this->belongsTo(Empresagrupo::class, 'empresagrupo_id', 'id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }
}
