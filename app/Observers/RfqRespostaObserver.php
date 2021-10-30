<?php

namespace App\Observers;

use App\Models\Rfqresposta;
use App\Models\Rfq;
use App\Models\Empresa;
use App\Notifications\RfqRespostaNotificacao;
use App\Repositories\Cotacoes\RfqRepository;

class RfqRespostaObserver
{
    public function created(Rfqresposta $rfqResposta)
    {       
            $rfq = $rfqResposta->rfq;
            $empresa = $rfqResposta->rfq->empresa;
            $empresa->notify(new RfqRespostaNotificacao($rfq->termo, $empresa, $rfq));  
    }
}
