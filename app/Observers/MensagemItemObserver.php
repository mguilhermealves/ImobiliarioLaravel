<?php

namespace App\Observers;

use App\Models\Mensagemitem;
use App\Notifications\MensagemNotification;

class MensagemItemObserver
{
    /**
     * Handle the mensagemitem "created" event.
     *
     * @param  \App\Mensagemitem  $mensagemitem
     * @return void
     */
    public function created(Mensagemitem $mensagemitem)
    {
        if ($mensagemitem->chat->cotacao_id == null && $mensagemitem->chat->rfq_id == null) {
            $mensagemitem->usuario_destino->notify(new MensagemNotification($mensagemitem->chat));
        } else {
            if ($mensagemitem->chat->cotacao_id != null && $mensagemitem->chat->mensagens->count() > 1) {
                $mensagemitem->usuario_destino->notify(new MensagemNotification($mensagemitem->chat));
            }
        }
    }

    /**
     * Handle the mensagemitem "updated" event.
     *
     * @param  \App\Mensagemitem  $mensagemitem
     * @return void
     */
    public function updated(Mensagemitem $mensagemitem)
    {
        //
    }

    /**
     * Handle the mensagemitem "deleted" event.
     *
     * @param  \App\Mensagemitem  $mensagemitem
     * @return void
     */
    public function deleted(Mensagemitem $mensagemitem)
    {
        //
    }

    /**
     * Handle the mensagemitem "restored" event.
     *
     * @param  \App\Mensagemitem  $mensagemitem
     * @return void
     */
    public function restored(Mensagemitem $mensagemitem)
    {
        //
    }

    /**
     * Handle the mensagemitem "force deleted" event.
     *
     * @param  \App\Mensagemitem  $mensagemitem
     * @return void
     */
    public function forceDeleted(Mensagemitem $mensagemitem)
    {
        //
    }
}
