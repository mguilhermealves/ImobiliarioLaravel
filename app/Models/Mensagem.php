<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $appends = [
      'respondido',
      'status',
    ];

    public function usuarioOrigem()
    {
        return $this->belongsTo(Usuario::class, 'origem', 'id');
    }

    public function usuarioDestino()
    {
        return $this->belongsTo(Usuario::class, 'destino', 'id');
    }

    public function cotacao()
    {
        return $this->belongsTo(Cotacao::class);
    }

    public function rfqresposta()
    {
        return $this->belongsTo(Rfqresposta::class);
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagemitem::class);
    }

    public function ultimaMensagem()
    {
        return $this->mensagens->sortByDesc('created_at')->first();
    }

    public function getRespondidoAttribute()
    {
        return $this->attributes['respondido'] = $this->updated_at->diffInDays(Carbon::now());
    }

    public function getStatusAttribute()
    {
        if ($this->ultimaMensagem()) {
            return $this->attributes['status'] = $this->ultimaMensagem()->status;
        }

        return 0;
    }
}
