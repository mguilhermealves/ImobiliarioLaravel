<?php

namespace App\Repositories\Noticias;

use App\Models\Noticia;
use App\Models\Video;
use App\Models\BannerNoticia;

class NoticiasRepository
{
    public static function all()
    {
        return Noticia::orderBy('data', 'DESC')->paginate(6);
    }

    public static function homelist()
    {
        return Noticia::orderBy('created_at', 'ASC')->get()->take(4);
    }

    public static function getBySlug($slug)
    {
        return Noticia::where('slug', $slug)->first();
    }

    public static function maisLidas()
    {
        return Noticia::orderBy('visitas', 'DESC')->get()->take(3);
    }

    public static function updateVisitas(Noticia $noticia)
    {
        $noticia->visitas++;
        $noticia->save();
    }

    public static function videos()
    {
        return Video::orderBy('created_at', 'ASC')->get();
    }

    public static function bannerNoticias()
    {
        return BannerNoticia::orderBy('created_at', 'ASC')->get();
    }

}
