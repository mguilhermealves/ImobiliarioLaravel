<?php

namespace App\Repositories\SobreNos;

use App\Models\Sobrenos;

class SobreNosRepository
{
    public static function get()
    {
        return Sobrenos::find(1);
    }
}
