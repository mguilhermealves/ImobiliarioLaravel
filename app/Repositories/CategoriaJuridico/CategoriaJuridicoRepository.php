<?php

namespace App\Repositories\CategoriaJuridico;


use App\Models\CategoriaJuridico;

use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
use App\Repositories\Sistema\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoriaJuridicoRepository
{
    private static $lista;
    public static function all() : Collection
    {
        return CategoriaJuridico::get();
    }

}
