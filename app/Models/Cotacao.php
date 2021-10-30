<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class Cotacao extends Model
{
    use Presentable;

    protected $guarded = [];
    protected $presenter = 'App\Http\Presenters\CotacaoPresenter';

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function origem()
    {
        return $this->belongsTo(Empresa::class, 'empresa_origem', 'id');
    }

    public function destino()
    {
        return $this->belongsTo(Empresa::class, 'empresa_destino', 'id');
    }

    public function mensagem()
    {
        return $this->hasOne(Mensagem::class);
    }
}
