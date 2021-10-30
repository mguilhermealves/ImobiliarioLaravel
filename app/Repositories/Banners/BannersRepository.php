<?php

namespace App\Repositories\Banners;

use App\Models\Banner;

class BannersRepository
{
    public static function get()
    {
        $data['data'] = Banner::all();
        foreach ($data['data'] as $d) {
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.banners.banner', $d->id) . '" data-titulo="Editar Banner" data-toggle="tooltip" title="Ver / Editar Banner"><i class="fa fa-pencil-square-o"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.banner.apagar', $d->id) . '" data-toggle="tooltip" title="Excluir Banner"><i class="fa fa-trash"></i></button>';
        }

        return response()->json($data);
    }

    public static function all()
    {
        return Banner::all();
    }
}
