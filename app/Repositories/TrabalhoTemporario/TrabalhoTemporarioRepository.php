<?php

namespace App\Repositories\TrabalhoTemporario;

use App\Models\TrabalhoTemporario;

class TrabalhoTemporarioRepository
{
    public static function get()
    {
        return TrabalhoTemporario::find(1);
    }
}
