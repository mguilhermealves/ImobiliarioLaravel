<?php

namespace App\Repositories\DuvidasFrequente;

use App\Models\TrabalhoTemporario;

class DuvidasFrequenteRepository
{
    public static function get()
    {
        return DuvidasFrequente::find(1);
    }
}
