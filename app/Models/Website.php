<?php

namespace App\Models;

use App\Repositories\Empresas\EmpresasRepository;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function vitrine()
    {
        return $this->empresa->produtos->where('vitrine', 1)->where('status', 1);
    }

    public function destaques()
    {
        return EmpresasRepository::getDestaques($this->empresa);
    }
}
