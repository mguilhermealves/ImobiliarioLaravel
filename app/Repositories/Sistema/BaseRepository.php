<?php

namespace App\Repositories\Sistema;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    public static function adicionar(String $model, FormRequest $request)
    {
        $model = 'App\Models\\' . ucfirst($model);
        $model::create($request->all());
    }

    public static function toSelect(Collection $items) : array
    {
        return $items->pluck('nome', 'id')->toArray();
    }
}
