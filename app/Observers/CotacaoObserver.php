<?php

namespace App\Observers;

use App\Models\Cotacao;
use App\Notifications\CotacaoCriada;

class CotacaoObserver
{
    /**
     * Handle the cotacao "created" event.
     *
     * @param  \App\Cotacao  $cotacao
     * @return void
     */
    public function created(Cotacao $cotacao)
    {
        $cotacao->destino->usuario->notify(new CotacaoCriada($cotacao->produto, $cotacao->origem->usuario));
    }

    /**
     * Handle the cotacao "updated" event.
     *
     * @param  \App\Cotacao  $cotacao
     * @return void
     */
    public function updated(Cotacao $cotacao)
    {
        // $cotacao->destino->usuario->notify(new CotacaoCriada($cotacao->produto, $cotacao->origem->usuario));
    }

    /**
     * Handle the cotacao "deleted" event.
     *
     * @param  \App\Cotacao  $cotacao
     * @return void
     */
    public function deleted(Cotacao $cotacao)
    {
        //
    }

    /**
     * Handle the cotacao "restored" event.
     *
     * @param  \App\Cotacao  $cotacao
     * @return void
     */
    public function restored(Cotacao $cotacao)
    {
        //
    }

    /**
     * Handle the cotacao "force deleted" event.
     *
     * @param  \App\Cotacao  $cotacao
     * @return void
     */
    public function forceDeleted(Cotacao $cotacao)
    {
        //
    }
}
