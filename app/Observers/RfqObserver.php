<?php

namespace App\Observers;

use App\Models\Rfq;
use App\Notifications\RfqCriada;
use App\Repositories\Cotacoes\RfqRepository;
use Illuminate\Http\Request;

class RfqObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the rfq "created" event.
     *
     * @param  \App\Rfq  $rfq
     * @return void
     */
    public function created(Rfq $rfq)
    {
        $empresas = RfqRepository::buscaProdutos($this->request);
        $ids = $empresas->unique('empresa_id');
        $ids->each(function ($r) use ($rfq) {
            $usuario = $r->empresa->usuario;
            $usuario->notify(new RfqCriada($rfq->termo, $usuario, $rfq));
        });
    }

    /**
     * Handle the rfq "updated" event.
     *
     * @param  \App\Rfq  $rfq
     * @return void
     */
    public function updated(Rfq $rfq)
    {
    }

    /**
     * Handle the rfq "deleted" event.
     *
     * @param  \App\Rfq  $rfq
     * @return void
     */
    public function deleted(Rfq $rfq)
    {
        //
    }

    /**
     * Handle the rfq "restored" event.
     *
     * @param  \App\Rfq  $rfq
     * @return void
     */
    public function restored(Rfq $rfq)
    {
        //
    }

    /**
     * Handle the rfq "force deleted" event.
     *
     * @param  \App\Rfq  $rfq
     * @return void
     */
    public function forceDeleted(Rfq $rfq)
    {
        //
    }
}
