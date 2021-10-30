<?php

namespace App\Http\Presenters;

use Laracodes\Presenter\Presenter;

class ProdutoPresenter extends Presenter
{
    public function getSimNao(Int $value)
    {
        return $value == 0 ? 'Sim' : 'Não';
    }

    public function origem()
    {
        return $this->model->origem == 0 ? 'Nacional' : 'Importado';
    }
}
