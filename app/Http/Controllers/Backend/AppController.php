<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Base\BaseRepository;
use App\Http\Requests\Backend\BaseRequest;

class AppController extends BackController
{
    public function index()
    {
        if (Auth::check()) {
            return response()->redirectTo(route('backend.home'));
        }

        return response()->redirectTo(route('backend.form'));
    }

    public function modulo(Model $model, String $action = null)
    {
        if (!isset($model->type) || $model->type == 'post') {
            $view = 'backend.modulo.index';
        } else {
            $view = 'backend.modulo.page';
            $object = BaseRepository::checkObject($model);
        }

        return view($view, [
          'modelName' => class_basename($model),
          'model' => $model,
          'action' => $action,
          'object' => $object ?? null,
        ]);
    }

    public function subModulo(Model $pai, Model $model)
    {
        if (!isset($model->type) || $model->type == 'post') {
            $view = 'backend.modulo.index-sub';
        } else {
            $view = 'backend.modulo.page';
            $object = BaseRepository::checkObject($model);
        }

        return view($view, [
          'modelName' => class_basename($model),
          'model' => $model,
          'pai' => $pai,
          'action' => '',
          'object' => $object ?? '',
        ]);
    }

    public function get(Model $model, String $action = null)
    {
        return BaseRepository::get($model, $action);
    }

    public function getSub(Model $model, Model $pai, Int $id)
    {
        return BaseRepository::getSub($model, $pai, $id);
    }

    public function Inserir(Model $model, BaseRequest $request)
    {
        BaseRepository::adicionar($model, $request);
    }

    public function Objeto(Model $model, Int $id, String $action = null)
    {
        return BaseRepository::objeto($model, $id, $action);
    }

    public function Alterar(Model $model, BaseRequest $request)
    {
        BaseRepository::salvar($model, $request);
    }

    public function Apagar(Model $model, Int $id)
    {
        BaseRepository::apagar($model, $id);
        echo 'OK';
    }

    public function Reordenar(Model $model, Request $request)
    {
        BaseRepository::reordenar($model, $request);
    }

    public function cities(Request $request)
    {
        return BaseRepository::getCities($request);
    }
}
