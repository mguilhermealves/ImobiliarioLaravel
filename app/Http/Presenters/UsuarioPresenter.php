<?php

namespace App\Http\Presenters;

use App\Models\Usuario;
use App\Repositories\Usuarios\UsuariosRepository;
use Laracodes\Presenter\Presenter;

class UsuarioPresenter extends Presenter
{
    public function contato(Usuario $contato)
    {
        return UsuariosRepository::contato($this->model, $contato);
    }
}
