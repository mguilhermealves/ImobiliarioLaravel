<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresacertificado extends Model
{
    protected $guarded = [];
    protected $appends = [
      'tamanho',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getTamanhoAttribute()
    {
        $titulo = $this->empresa->id . '/' . $this->nome;
        foreach (Storage::disk('certificados')->files($this->empresa->id) as $file) {
            if ($titulo == $file) {
                return Storage::disk('certificados')->size($file);
            }
        }
    }
}
