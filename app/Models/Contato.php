<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'contato_id', 'id');
    }
}
