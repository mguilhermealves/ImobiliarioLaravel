<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rfqresposta extends Model
{

    use Notifiable;

    protected $guarded = [
      'tipo',
    ];
    protected $appends = [
      'nomeProduto',
      'descricao',
      'imagens',
    ];

    public function rfq()
    {
        return $this->belongsTo(Rfq::class, 'rfq_id', 'id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Empresa::class, 'fornecedor_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function mensagem()
    {
        return $this->hasOne(Mensagem::class);
    }

    public function getNomeProdutoAttribute()
    {
        if ($this->item()->exists()) {
            $nome = $this->item->nome;
        } else {
            $nome = $this->produto;
        }

        return $this->attributes['nomeProduto'] = $nome;
    }

    public function getDescricaoAttribute()
    {
        if ($this->item()->exists()) {
            $descricao = $this->item->descricao;
        } else {
            $descricao = $this->proposta;
        }

        return $this->attributes['descricao'] = $descricao;
    }

    public function getImagensAttribute()
    {
        if ($this->item()->exists()) {
            $imagens = [$this->item->principal, $this->item->outrasImagens()[0]->imagem];
        } else {
            $imagens = [$this->imagem1, $this->imagem2];
        }
        
        return $this->attributes['imagens'] = $imagens;
    }
}
