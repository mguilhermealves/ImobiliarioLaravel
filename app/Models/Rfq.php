<?php

namespace App\Models;

use App\Traits\Sistema\Search;
use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class Rfq extends Model
{
    use Search;
    use Presentable;

    protected $guarded = [
      'empresas',
    ];
    protected $searchable = [
      'termo',
      'informacoes',
    ];
    protected $appends = [
      'solicitante',
      'data',
      'respondida',
    ];
    protected $presenter = 'App\Http\Presenters\RfqPresenter';
    public $title = 'RFQs 88';
    public $update = false;
    public $hasOrder = false;
    public $hasForm = true;
    public $listagem = [
      'termo',
      'solicitante',
      'data',
      'respondida',
    ];
    public $order = 0;
    public $orderDirection = 'desc';

    public $formulario = [
      'solicitante' => [
        'title' => 'solicitante',
        'type' => 'text',
        'width' => 6,
      ],
      'termo' => [
        'title' => 'Termo',
        'type' => 'text',
        'width' => 6,
      ],
      'quantidade' => [
        'title' => 'Quantidade',
        'type' => 'text',
        'width' => 3,
      ],
      'categoria_id' => [
        'title' => 'Categoria',
        'type' => 'belongs',
        'model' => 'Categoria',
        'show' => 'nome',
        'width' => 3,
      ],
      'subcategoria_id' => [
        'title' => 'Subcategoria',
        'type' => 'belongs',
        'model' => 'Subcategoria',
        'show' => 'nome',
        'width' => 3,
      ],
      'grupo_id' => [
        'title' => 'Grupo',
        'type' => 'belongs',
        'model' => 'Grupo',
        'show' => 'nome',
        'width' => 3,
      ],
      'informacoes' => [
        'title' => 'Informações adicionais',
        'type' => 'textarea',
        'editor' => false,
        'width' => 12,
      ],
      'imagem1' => [
        'title' => 'Imagem 1',
        'type' => 'image',
        'width' => 2,
      ],
      'imagem2' => [
        'title' => 'Imagem 2',
        'type' => 'image',
        'width' => 2,
      ],
      'imagem3' => [
        'title' => 'Imagem 3',
        'type' => 'image',
        'width' => 2,
      ],
      'imagem4' => [
        'title' => 'Imagem 4',
        'type' => 'image',
        'width' => 2,
      ],
      'imagem5' => [
        'title' => 'Imagem 5',
        'type' => 'image',
        'width' => 2,
      ],
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function respostas()
    {
        return $this->hasMany(Rfqresposta::class);
    }

    public function getSolicitanteAttribute()
    {
        return $this->attributes['solicitante'] = $this->empresa->usuario->fullName . ' - ' . $this->empresa->nome;
    }

    public function getDataAttribute()
    {
        return $this->attributes['data'] = $this->created_at->format('d/m/Y');
    }

    public function getRespondidaAttribute()
    {
        return $this->attributes['respondida'] = 1 == $this->status ? 'Respondida' : 'Nova';
    }
}
