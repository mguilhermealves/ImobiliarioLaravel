<?php

namespace App\Observers;

use App\Models\Usuario;
use App\Notifications\EnviarSenha;

class UsuarioObserver
{
    /**
     * Handle the usuario "created" event.
     *
     * @param  \App\Usuario  $usuario
     * @return void
     */
    public function created(Usuario $usuario)
    {
        //$usuario->notify(new UsuarioCriado());
    }

    /**
     * Handle the usuario "updated" event.
     *
     * @param  \App\Usuario  $usuario
     * @return void
     */
    public function updated(Usuario $usuario)
    {   
       
        if($usuario->email != null){
            $usuario->notify(new EnviarSenha());       
        }
    }

    /**
     * Handle the usuario "deleted" event.
     *
     * @param  \App\Usuario  $usuario
     * @return void
     */
    public function deleted(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the usuario "restored" event.
     *
     * @param  \App\Usuario  $usuario
     * @return void
     */
    public function restored(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the usuario "force deleted" event.
     *
     * @param  \App\Usuario  $usuario
     * @return void
     */
    public function forceDeleted(Usuario $usuario)
    {
        //
    }
}
