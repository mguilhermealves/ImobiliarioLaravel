<?php

namespace App\Repositories\Estados;


use App\Models\Estado;

use Illuminate\Http\Request;
use Collective\Html\FormFacade as Form;
use App\Repositories\Sistema\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class EstadosRepository
{

    public static function all()
    {
        return Estado::all();
    }

}
