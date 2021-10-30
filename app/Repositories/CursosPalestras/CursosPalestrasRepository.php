<?php

namespace App\Repositories\CursosPalestras;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Models\CursosPalestra;

class CursosPalestrasRepository
{    
    public static function all()
    {
        return CursosPalestra::paginate(8);
    }

    public static function homeList()
    {
        return CursosPalestra::get()->take(5);
    }

    public static function getBySlug($slug)
    {                
       return CursosPalestra::where('slug', $slug)->first();                       
    }

    public static function get($id)
    {                
       return CursosPalestra::where('id', $id)->first();                       
    }
}
