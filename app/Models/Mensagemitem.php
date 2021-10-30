<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class Mensagemitem extends Model
{
    use Presentable;

    protected $presenter = 'App\Http\Presenters\MensagemPresenter';

    public function chat()
    {
        return $this->belongsTo(Mensagem::class, 'mensagem_id', 'id');
    }

    public function usuario_destino()
    {
        return $this->belongsTo(Usuario::class, 'destino', 'id');
    }
}
