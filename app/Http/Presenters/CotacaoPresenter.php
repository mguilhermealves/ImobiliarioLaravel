<?php

namespace App\Http\Presenters;

use App\Models\Produto;
use Laracodes\Presenter\Presenter;

class CotacaoPresenter extends Presenter
{
    public static function produtoCotacao(Int $id)
    {
        return Produto::find($id) ?? null;
    }

    public function nomeAnexo()
    {
        if ($this->anexo != null) {
            $nomes = explode('/', $this->anexo);

            return end($nomes);
        }
    }
}
