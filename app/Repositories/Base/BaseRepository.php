<?php

namespace App\Repositories\Base;

use App\Services\Cms;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Backend\BaseRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection as Col;

class BaseRepository
{
    public static function get(Model $model, String $action = null)
    {
        if (!$action) {
            $data['data'] = $model::all();
        } else {
            $actions = (object) $model->$action();
            $filter = (object) $actions->filter;
            $data['data'] = $model::where($filter->field, $filter->operator, $filter->value)->get();
        }
        foreach ($data['data'] as $d) {
            if ($model->hasOrder != true) {
                $d->order = 0;
            }
            if ($model->hasForm == true) {
                $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.editar', [class_basename($model),$d->id, $action]) . '" data-titulo="Editar ' . class_basename($model) . '" data-toggle="tooltip" title="Ver / Editar ' . class_basename($model) . '"><i class="fa fa-pencil-square-o"></i></button>';
            }
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.apagar', [class_basename($model),$d->id]) . '" data-toggle="tooltip" title="Excluir ' . class_basename($model) . '"><i class="fa fa-trash"></i></button>';
            if (method_exists($model, 'getActions')) {
                foreach ($model->getActions() as $a) {
                    $act = (object) $a;
                    if ($act->type == 'button') {
                        $d->acoes .= ' <button class="btn btn-' . $act->color . ' ' . $act->class . ' btn-sm" data-url="' . route($act->route, [class_basename($model),$d->id]) . '" data-toggle="tooltip" title="' . $act->title . ' ' . class_basename($model) . '"><i class="fa fa-' . $act->icon . '"></i></button>';
                    } else {
                        $d->acoes .= ' <a class="btn btn-' . $act->color . ' ' . $act->class . ' btn-sm" href="' . route($act->route, [$d->id]) . '" data-toggle="tooltip" title="' . $act->title . ' ' . class_basename($model) . '"><i class="fa fa-' . $act->icon . '"></i></a>';
                    }
                }
            }
        }

        return response()->json($data);
    }

    public static function getSub(Model $model, Model $pai, Int $id)
    {
        $data['data'] = $model::where(strtolower(class_basename($pai)) . '_id', $id)->get();
        foreach ($data['data'] as $d) {
            if ($model->hasOrder != true) {
                $d->order = 0;
            }
            $d->acoes = '<button class="btn btn-primary btn-editar-spa btn-sm" data-url="' . route('backend.editar', [class_basename($model),$d->id]) . '" data-titulo="Editar ' . class_basename($model) . '" data-toggle="tooltip" title="Ver / Editar ' . class_basename($model) . '"><i class="fa fa-pencil-square-o"></i></button>';
            $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="' . route('backend.apagar', [class_basename($model),$d->id]) . '" data-toggle="tooltip" title="Excluir ' . class_basename($model) . '"><i class="fa fa-trash"></i></button>';
            if (method_exists($model, 'getActions')) {
                foreach ($model->getActions() as $a) {
                    $act = (object) $a;
                    if ($act->type == 'button') {
                        $d->acoes .= ' <button class="btn btn-' . $act->color . ' ' . $act->class . ' btn-sm" data-url="' . route($act->route, [class_basename($model),$d->id]) . '" data-toggle="tooltip" title="' . $act->title . ' ' . class_basename($model) . '"><i class="fa fa-' . $act->icon . '"></i></button>';
                    } else {
                        $d->acoes .= ' <a class="btn btn-' . $act->color . ' ' . $act->class . ' btn-sm" href="' . route($act->route, [$d->id,$act->model]) . '" data-toggle="tooltip" title="' . $act->title . ' ' . class_basename($model) . '"><i class="fa fa-' . $act->icon . '"></i></a>';
                    }
                }
            }
        }

        return response()->json($data);
    }

    public static function adicionar(Model $model, BaseRequest $request)
    {
        $request = self::checkPassword($model, $request);
        if ($model->hasOrder == true) {
            $request['order'] = 0;
        }
        $object = $model::create($request->all());
        if ($model->hasOrder == true) {
            $last = $model::orderBy('order', 'desc')->first();
            $order = $last->order + 1;
            $object->order = $order;
            $object->save();
        }
        self::checkRelations($object, $request);
        self::checkFiles($object, $request);
    }

    public static function objeto(Model $model, Int $id, String $action = null)
    {
        if (is_int($id)) {
            $object = $model::find($id);
            foreach ($model->formulario as $field => $params) {
                $object->action = $action ?? null;
                $f = (object) $params;
                if (isset($f->class) && $f->class == 'dinheiro-input-mask') {
                    $object->$field = currencyToAppOnlyNumbers($object->$field);
                }
                if (isset($f->class) && $f->class == 'data-input-mask') {
                    $object->$field = dateTimeBdToApp($object->$field);
                }
                if ($f->type == 'manyTo') {
                    $relation = strtolower($field);
                    $load = $object->$relation;
                    $object->{'rel_' . $relation} = self::toMany($load);
                }
                if ($f->type == 'file') {
                    $fi = 'file_' . $field;
                    $object->$fi = $f;
                    $object->$field = url('/') . '/public/storage/' . $object->$field;
                }
            }

            return $object;
        }
    }

    public static function salvar(Model $model, BaseRequest $request)
    {
        $object = $model::find($request->id);
        $request = self::checkPassword($model, $request);
        $object->update($request->except(['action']));
        self::checkRelations($object, $request);
        self::checkFiles($object, $request);
    }

    public static function checkRelations(Model $model, BaseRequest $request)
    {
        foreach ($model->formulario as $field => $params) {
            $f = (object) $params;
            if ($f->type == 'manyTo') {
                $attach = strtolower($field);
                $model->$attach()->sync($request->$field);
            }
        }
    }

    private static function checkFiles(Model $model, BaseRequest $request)
    {
        foreach ($request->all() as $field => $value) {
            $f = explode('file_', $field);
            if (count($f) > 1) {
                self::uploadFile($model, $request, $f[1]);
            }
        }
    }

    private static function uploadFile(Model $model, BaseRequest $request, String $field)
    {
        if ($request->hasFile('file_' . $field) && $request->file('file_' . $field)->isValid()) {
            $path = $request->file('file_' . $field)->store('backend');
            $model->$field = $path;
            $model->save();
        }
    }

    public static function apagar(Model $model, Int $id)
    {
        if (is_int($id)) {
            $model::find($id)->delete();
        }
    }

    public static function toSelect(String $model, String $show)
    {
        $model = self::getModel($model);

        return $model::all()->pluck($show, 'id')->toArray();
    }

    public static function toSelectObject(Collection $model, String $show)
    {
        return $model->pluck($show, 'id')->all();
    }

    public static function relatedField(String $model, String $show, Int $id)
    {
        $model = self::getModel($model);
        // pre($model::find($id));
    }

    public static function toMany(Col $object)
    {
        $out = [];
        foreach ($object as $o) {
            $out[] = $o->id;
        }

        return $out;
    }

    public static function getMany(Model $model, String $attach)
    {
        return $model->$attach;
    }

    public static function getModel(String $model)
    {
        $class = 'App\Models\\' . ucfirst($model);

        return new $class();
    }

    public static function checkPassword(Model $model, BaseRequest $request)
    {
        $except[] = 'id';
        if ($request->action) {
            $action = $request->action;
            $list = Cms::makeObject($model->$action());
            foreach ($list->form as $field => $params) {
                $except[] = $field;
            }
            $except[] = 'action';
        }
        foreach ($request->all() as $field => $value) {
            $f = explode('file_', $field);
            if (count($f) > 1) {
                $except[] = $field;
            }
        }
        foreach ($request->except($except) as $k => $v) {
            $field = (object) $model->formulario[$k];
            if ($field->type != 'info') {
                if ($field->type == 'password' && isset($field->main)) {
                    $request[$k] = Hash::make($request->$k);
                    $request[$field->token] = Str::random($field->token_size);
                }
            }
        }

        return $request;
    }

    public static function checkObject(Model $model)
    {
        $record = $model::first();
        if (!$record) {
            $record = new $model();
            $record->save();
        }

        return $record;
    }

    public static function reordenar(Model $model, Request $request)
    {
        $obj = $model::find($request->i);
        if ($model->hasOrder == true) {
            $obj->order = $request->p;
            $obj->save();
        }
    }

    public static function getCities(Request $request)
    {
        $srcClass = 'App\Models\\' . ucfirst($request->s);
        $src = new $srcClass();
        $statesClass = 'App\Models\\' . ucfirst($request->m);
        $states = new $statesClass();
        $citiesClass = 'App\Models\\' . ucfirst($request->t);
        $cities = new $citiesClass();
        foreach ($src->formulario as $field => $params) {
            $f = (object) $params;
            if (isset($f->state) && $f->state == true) {
                $searchField = $f->search;
            }
            if (isset($f->city) && $f->city == true) {
                $showField = $f->show;
            }
        }
        if ($searchField != 'id') {
            $searchParam = $states::where('id', $request->st)->first()->$searchField;
            $results = $cities::where($searchField, $searchParam)->get();
        } else {
            $searchParam = $request->st;
            $results = $cities::where('id', $request->st)->get();
        }

        return self::toSelectObject($results, $showField);
    }
}
