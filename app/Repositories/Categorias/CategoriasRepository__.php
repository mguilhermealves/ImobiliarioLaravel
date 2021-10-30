<?php

namespace App\Repositories\Categorias;

use App\Models\Categorias\Grupo;
use App\Models\Categorias\Categoria;
use App\Models\Categorias\SubCategoria;
use App\Http\Requests\Backend\Categorias\GruposRequest;
use App\Http\Requests\Backend\Categorias\CategoriasRequest;
use App\Http\Requests\Backend\Categorias\SubCategoriasRequest;

class CategoriasRepository__
{
    public static function get()
    {
        $data['data'] = Categoria::all();
        foreach ($data['data'] as $d) {
            $d->subs = $d->subcategorias->count();
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.categorias.categoria', $d->id) . '" data-titulo="Editar categoria" data-toggle="tooltip" title="Ver / Editar Categoria"><i class="fa fa-pencil-square-o"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.categoria.apagar', $d->id) . '" data-toggle="tooltip" title="Excluir Categoria"><i class="fa fa-trash"></i></button>';
        }

        return response()->json($data);
    }

    public static function editar(Categoria $categoria)
    {
        if ($categoria->imagem == '') {
            $categoria->imagem = assets('backend/images/sem-imagem.png');
        }

        return $categoria;
    }

    public static function all()
    {
        return Categoria::all();
    }

    public static function toSelect()
    {
        return Categoria::all()->pluck('nome', 'id')->toArray();
    }

    public static function childByCateg($idCateg)
    {
        return SubCategoria::all()->where('categoria_id', $idCateg)->pluck('nome', 'id')->toArray();
    }

    public static function adicionar(CategoriasRequest $request)
    {
        Categoria::create($request->all());
    }

    public static function salvar(CategoriasRequest $request)
    {
        Categoria::find($request->id)->update($request->all());
    }

    /** SUBS */
    public static function getSubs()
    {
        $data['data'] = SubCategoria::all();
        foreach ($data['data'] as $d) {
            $d->cat = $d->categoria->nome;
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.categorias.sub', $d->id) . '" data-toggle="tooltip" title="Ver / Editar Sub Categoria"><i class="fa fa-pencil-square-o"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.categoria.sub.apagar', $d->id) . '" data-toggle="tooltip" title="Excluir Sub Categoria"><i class="fa fa-trash"></i></button>';
        }

        return response()->json($data);
    }

    public static function subsToSelect()
    {
        return SubCategoria::all()->pluck('nome', 'id')->toArray();
    }

    public static function subsToSelectBack()
    {
        $lista = SubCategoria::all();
        $array = [];
        foreach ($lista as $l) {
            $array[$l->id] = $l->categoria->nome . ' >> ' . $l->nome;
        }

        return $array;
    }

    public static function subsPorCategoria(Int $categoria)
    {
        return Categoria::find($categoria)->subcategorias->pluck('nome', 'id')->toArray();
    }

    public static function GrupoBySubCateg($sub)
    {
        return Grupo::all()->where('sub_categoria_id', $sub)->pluck('nome', 'id')->toArray();
    }

    public static function adicionarSub(SubCategoriasRequest $request)
    {
        SubCategoria::create($request->all());
    }

    public static function salvarSub(SubCategoriasRequest $request)
    {
        SubCategoria::find($request->id)->update($request->all());
    }

    /** GRUPOS */
    public static function getGrupos()
    {
        $data['data'] = Grupo::all();
        foreach ($data['data'] as $d) {
            $d->sub = $d->subcategoria->categoria->nome . ' >> ' . $d->subcategoria->nome;
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.categorias.grupo', $d->id) . '" data-toggle="tooltip" title="Ver / Editar Sub Categoria"><i class="fa fa-pencil-square-o"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.categoria.grupo.apagar', $d->id) . '" data-toggle="tooltip" title="Excluir Sub Categoria"><i class="fa fa-trash"></i></button>';
        }

        return response()->json($data);
    }

    public static function gruposToSelect()
    {
        return Grupo::all()->pluck('nome', 'id')->toArray();
    }

    public static function gruposPorSubCategoria(Int $sub)
    {
        return SubCategoria::find($sub)->grupos->pluck('nome', 'id')->toArray();
    }

    public static function adicionarGrupo(GruposRequest $request)
    {
        Grupo::create($request->all());
    }

    public static function salvarGrupo(GruposRequest $request)
    {
        Grupo::find($request->id)->update($request->all());
    }
}
