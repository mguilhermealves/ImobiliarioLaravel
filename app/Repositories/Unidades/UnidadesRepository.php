<?php

namespace App\Repositories\Unidades;

use App\Models\Unidade;
use App\Http\Requests\Backend\Unidades\UnidadesRequest;

class UnidadesRepository
{
    public static function all()
    {
        return Unidade::all();
    }

    public static function get()
    {
        $data['data'] = self::all();
        foreach ($data['data'] as $d) {
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.unidades.unidade', $d->id) . '" data-titulo="Edição de Unidade" data-toggle="tooltip" title="Ver / Editar Unidade"><i class="fa fa-pencil"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.unidade.apagar', $d->id) . '" data-toggle="tooltip" title="Apagar Unidade"><i class="fa fa-trash"></i></button>';
        }

        return response()->json($data);
    }

    public static function cadastrar(UnidadesRequest $request)
    {
        Unidade::create($request->all());
    }

    public static function salvar(UnidadesRequest $request)
    {
        Unidade::find($request->id)->update($request->all());
    }

    public static function apagar(Unidade $unidade)
    {
        $unidade->delete();
    }

    public static function toSelect()
    {
        return Unidade::all()->pluck('nome', 'id')->toArray();
    }
}
