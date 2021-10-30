<?php

namespace App\Repositories\Juridico;

use App\Models\Juridico;

class JuridicoRepository
{
    public static function get()
    {
        return Juridico::find(1);
    }
}
