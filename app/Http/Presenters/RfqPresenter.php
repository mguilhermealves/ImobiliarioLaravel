<?php

namespace App\Http\Presenters;

use Laracodes\Presenter\Presenter;

class RfqPresenter extends Presenter
{
    public function nomeAnexo(String $anexo)
    {
        if ($anexo != null) {
            $nomes = explode('/', $anexo);

            return end($nomes);
        }
    }
}
