<?php

namespace App\Observers;

use App\Models\Empresa;
use App\Notifications\ReenviarConfirmacao;

class EmpresaObserver
{
    public function updated(Empresa $empresa)
    {
        //$empresa->notify(new ReenviarConfirmacao());
    }
}