<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Produto;
use App\Notifications\ProdutoSalvo;
use App\Notifications\ProdutoAprovado;
use App\Notifications\ProdutoReprovado;

class ProdutoObserver
{
    /**
     * Handle the produto "created" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function created(Produto $produto)
    {
      if( ($produto->notifica != 0 || !isset($produto->notifica)) ){
        User::all()->each(function ($u) {
            $u->notify(new ProdutoSalvo());
        });
      }
    }

    /**
     * Handle the produto "updated" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function updated(Produto $produto)
    {
        if ($produto->status == 0 && !$produto->isDirty('visitas') ) {
            User::all()->each(function ($u) {
                $u->notify(new ProdutoSalvo());
            });
        }

        if ($produto->isDirty('status')) {
            if ($produto->status == 1) {
                $produto->empresa->usuario->notify(new ProdutoAprovado($produto));
            }

            if ($produto->status == 2) {
                $produto->empresa->usuario->notify(new ProdutoReprovado($produto));
            }
        }
    }

    /**
     * Handle the produto "deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function deleted(Produto $produto)
    {
        //
    }

    /**
     * Handle the produto "restored" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function restored(Produto $produto)
    {
        //
    }

    /**
     * Handle the produto "force deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function forceDeleted(Produto $produto)
    {
        //
    }
}
