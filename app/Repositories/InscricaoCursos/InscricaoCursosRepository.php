<?php

namespace App\Repositories\InscricaoCursos;


use App\Models\InscricaoCurso;
use App\Models\CursosPalestra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Sistema\InscricaoCursos\InscricaoCursosRequest;

class InscricaoCursosRepository
{
  

    public static function gravar(InscricaoCursosRequest $request)
    {                    
        $inscricao = InscricaoCurso::create($request->all());           
    }

    public static function apagar(InscricaoCurso $inscricao)
    {
        $inscricao->delete();
    }


}
