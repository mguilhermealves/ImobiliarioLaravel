<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $guarded = [];
    protected $appends = [
      'vFormatado',
      'imageTag',
      'corDisplay',
    ];

    public $hasOrder = true;

    public $title = 'Planos';
    public $newButton = 'Novo Plano';
    public $hasForm = true;
    public $update = true;
    public $listagem = [
      'nome',
      'dias',
      'imagem' => 'imageTag',
      'valor' => 'vFormatado',
      'cor' => 'corDisplay',
    ];

    public $formulario = [
    'nome' => [
      'title' => 'Nome',
      'type' => 'text',
      'width' => 6,
      'validators' => 'required|string|min:3',
    ],
    'dias' => [
      'title' => 'Dias da assinatura',
      'type' => 'number',
      'width' => 3,
      'validators' => 'required|int|min:0',
    ],
    'codigo_gateway' => [
      'title' => 'Código do Plano no Gateway',
      'type' => 'text',
      'width' => 3,
      'validators' => 'required|string|min:1',
    ],
    'icone' => [
      'title' => 'Ícone',
      'type' => 'icon',
      'width' => 12,
      'validators' => 'required|string|min:10',
    ],
    'valor' => [
      'title' => 'Valor ( 0 = Gratuito )',
      'type' => 'text',
      'width' => 4,
      'class' => 'dinheiro-input-mask',
      'validators' => 'required|numeric|min:0',
    ],
    'cor' => [
      'title' => 'Cor',
      'type' => 'color',
      'width' => 4,
      'validators' => 'required|string|size:7',
    ],
    'prioridade' => [
      'title' => 'Prioridade',
      'type' => 'number',
      'width' => 4,
      'validators' => 'required|int|min:1',
    ],
    'produtos' => [
      'title' => 'Produtos Cadastrados (0 = ilimitado)',
      'type' => 'number',
      'width' => 4,
      'validators' => 'required|int|min:0',
    ],
    'site' => [
      'title' => 'Website?',
      'type' => 'radio',
      'src' => 'array',
      'data' => [0 => 'Não', 1 => 'Sim'],
      'width' => 2,
      'validators' => 'required|int|min:0',
    ],
    'cartao' => [
      'title' => 'Cartão de Visitas?',
      'type' => 'radio',
      'src' => 'array',
      'data' => [0 => 'Não', 1 => 'Sim'],
      'width' => 2,
      'validators' => 'required|int|min:0',
    ],
    'banco' => [
      'title' => 'Banco de Imagens MB (0 = ilimitado)',
      'type' => 'number',
      'width' => 4,
      'validators' => 'required|int|min:0',
    ],
    'chat' => [
      'title' => 'Chat de Negociação?',
      'type' => 'radio',
      'src' => 'array',
      'data' => [0 => 'Não', 1 => 'Sim'],
      'width' => 2,
      'validators' => 'required|int|min:0',
    ],
    'cotacoes' => [
      'title' => 'Mercado de Cotações?',
      'type' => 'radio',
      'src' => 'array',
      'data' => [0 => 'Não', 1 => 'Sim'],
      'width' => 2,
      'validators' => 'required|int|min:0',
    ],
    'vitrine' => [
      'title' => 'Produtos na Vitrine',
      'type' => 'number',
      'width' => 4,
      'validators' => 'required|int|min:0',
    ],
    'solicitacao' => [
      'title' => 'Cotações por mês ( 0 = ilimitado )',
      'type' => 'number',
      'width' => 4,
      'validators' => 'required|int|min:0',
    ],
    'logo' => [
      'title' => 'Logo na Home?',
      'type' => 'radio',
      'src' => 'array',
      'data' => [0 => 'Não', 1 => 'Sim'],
      'width' => 2,
      'validators' => 'required|int|min:0',
    ],
  ];

    public function empresa()
    {
        return $this->hasMany(Empresa::class);
    }

    public function getVFormatadoAttribute()
    {
        $this->valor = currencyToBd($this->valor);
        if ((float) $this->valor > 0) {
            return $this->attributes['vFormatado'] = currencyToApp($this->valor);
        }

        return $this->attributes['vFormatado'] = 0;
    }

    public function getImageTagAttribute()
    {
        return $this->attributes['imageTag'] = '<img src="' . $this->icone . '"/>';
    }

    public function getCorDisplayAttribute()
    {
        return $this->attributes['corDisplay'] = '<div class="label" style="background-color: ' . $this->cor . '">COR</div>';
    }
}
