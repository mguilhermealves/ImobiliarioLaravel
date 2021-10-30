<?php
  namespace App\Repositories\Equipe;

use App\Models\Equipe;

class EquipeRepository
{
    public static function getEquipeByType(Int $tipo)
    {
        return Equipe::where('tipo', $tipo)->get();
    }
}
