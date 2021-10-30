<?php

namespace App\Http\Controllers\Sistema;

use App\Models\InscricaoCurso;
use App\Models\CursosPalestra;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\InscricaoCursos\InscricaoCursosRepository;
use App\Repositories\CursosPalestras\CursosPalestrasRepository;
use App\Http\Requests\Sistema\InscricaoCursos\InscricaoCursosRequest;


class InscricaoCursoController extends Controller
{
   

    public function inscrever(InscricaoCursosRequest $request, CursosPalestra $curso)
    {             
        $curso = CursosPalestrasRepository::get($request->cursos_palestras_id);
      
        InscricaoCursosRepository::gravar($request);
        return SistemaService::jsonR(200, 1, 'Inscrição realizada com sucesso! Aguarde a resposta de nossa equipe!.', route('sistema.cursos-detalhes',$curso->slug));
    }

}
