<?php

namespace App\Models;

use App\Repositories\Grupos\GruposRepository;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Empresagrupo extends Model
{
    use Sluggable;

    protected $guarded = [];

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => ['nome'],
        ],
      ];
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function subs()
    {
        return $this->hasMany(Empresasubgrupo::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)->withPivot('destaque');
    }

    public function destacados()
    {
        return GruposRepository::getDestacados($this);
    }
}
