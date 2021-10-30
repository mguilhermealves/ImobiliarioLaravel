<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;


class Empresa extends Model
{
    use Sluggable, Notifiable;

    protected $guarded = [
      'empresa_id',
      'termos',
    ];
    protected $dates = [
      'validade_plano',
    ];
    protected $appends = [
      'tipoTag',
      'principais',
      'avaliacao',
      'planoNome',
      'responsavel',
      'status',
      'interesses',
      'cidadeUf',
      'boletoTag',
      'qtdeProd',
      'Recebidos',
      'Enviados',
    ];

    public $title = 'Empresas';
    public $update = true;
    public $hasOrder = false;
    public $hasForm = true;
    public $listagem = [
      'nome',
      'cnpj',
      'Telefone' => 'usuario.telefone',
      'Cidade' => 'cidadeUf',
      'Plano' => 'planoNome',
      'Validade de Acesso' => 'validade_plano',
      'Responsável' => 'responsavel',
      'Confirmado?' => 'status',
      'Boleto Pendente?' => 'boletoTag',
      'interesses',
      'qtdeProd',
      'Orçamentos Recebidos' => 'Recebidos',
      'Orçamentos Enviados' => 'Enviados',
    ];

    public $formulario = [
      'logo' => [
        'title' => 'Logo da empresa',
        'type' => 'image',
        'width' => 12,
      ],
      'nome' => [
        'title' => 'Nome da empresa',
        'type' => 'text',
        'width' => 12,
      ],
      'cnpj' => [
        'title' => 'CNPJ',
        'type' => 'text',
        'width' => 2,
      ],
      'telefone' => [
        'title' => 'Telefone',
        'type' => 'text',
        'width' => 2,
      ],
      'email' => [
        'title' => 'E-mail',
        'type' => 'text',
        'width' => 4,
      ],
      'site' => [
        'title' => 'Website',
        'type' => 'text',
        'width' => 4,
      ],
      'fundacao' => [
        'title' => 'Ano de Fundação',
        'type' => 'text',
        'width' => 2,
      ],
      'funcionarios' => [
        'title' => 'Número de funcionários',
        'type' => 'text',
        'width' => 2,
      ],
      'funcionarios' => [
        'title' => 'Número de funcionários',
        'type' => 'text',
        'width' => 2,
      ],
      'created_at' => [
        'title' => 'Cadastrada em',
        'type' => 'text',
        'width' => 2,
      ],
      'sobre' => [
        'title' => 'Sobre',
        'type' => 'textarea',
        'editor' => false,
        'width' => 12,
      ],
      'cep' => [
        'title' => 'CEP',
        'type' => 'text',
        'width' => 2,
      ],
      'logradouro' => [
        'title' => 'Logradouro',
        'type' => 'text',
        'width' => 8,
      ],
      'numero' => [
        'title' => 'Número',
        'type' => 'text',
        'width' => 2,
      ],
      'complemento' => [
        'title' => 'Complemento',
        'type' => 'text',
        'width' => 2,
      ],
      'bairro' => [
        'title' => 'Bairro',
        'type' => 'text',
        'width' => 4,
      ],
      'cidade' => [
        'title' => 'Cidade',
        'type' => 'text',
        'width' => 4,
      ],
      'uf' => [
        'title' => 'UF',
        'type' => 'text',
        'width' => 2,
      ],
      'produto1' => [
        'title' => 'Produto 1',
        'type' => 'text',
        'width' => 3,
      ],
      'produto2' => [
        'title' => 'Produto 2',
        'type' => 'text',
        'width' => 3,
      ],
      'produto3' => [
        'title' => 'Produto 3',
        'type' => 'text',
        'width' => 3,
      ],
      'produto4' => [
        'title' => 'Produto 4',
        'type' => 'text',
        'width' => 3,
      ],
      'plano_id' => [
        'title' => 'Plano contratado',
        'type' => 'belongs',
        'model' => 'Plano',
        'show' => 'nome',
        'width' => 3,
      ],
      'validade_plano' => [
        'title' => 'Validade de acesso',
        'type' => 'text',
        'width' => 3,
      ],
      'assinatura_id' => [
        'title' => 'Código da assinatura',
        'type' => 'text',
        'width' => 3,
      ],
      'nota' => [
        'title' => 'Média de avaliação',
        'type' => 'text',
        'width' => 3,
      ]
    ];

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }

    public function novoPlano()
    {
        return $this->belongsTo(Plano::class, 'novo_plano_id');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function imagens()
    {
        return $this->hasMany(Imagem::class);
    }

    public function website()
    {
        return $this->hasOne(Website::class);
    }

    public function cotacoes()
    {
        return $this->hasMany(Cotacao::class, 'empresa_destino', 'id');
    }

    public function cotacoesComprador()
    {
        return $this->hasMany(Cotacao::class, 'empresa_origem', 'id');
    }

    public function grupos()
    {
        return $this->hasMany(Empresagrupo::class);
    }

    public function rfqs()
    {
        return $this->hasMany(Rfq::class);
    }

    public function respostas()
    {
        return $this->hasMany(Rfqresposta::class, 'fornecedor_id', 'id');
    }

    public function certificados()
    {
        return $this->hasMany(Empresacertificado::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'avaliado', 'id');
    }

    public function getTipoTagAttribute()
    {
        switch ($this->tipo) {
        case 1:
          $tag = 'Fabricante';

          break;

        case 2:
          $tag = 'Importador';

          break;

        default:
          $tag = 'Distribuidor';

          break;
      }

        return $this->attributes['tipoTag'] = $tag;
    }

    public function getPrincipaisAttribute()
    {
        $principais = [
          $this->produto1,
          $this->produto2,
          $this->produto3,
          $this->produto4,
        ];

        return $this->attributes['principais'] = implode(',', array_filter($principais));
    }

    public function getAvaliacaoAttribute()
    {
        return $this->attributes['avaliacao'] = round($this->nota);
    }

    public function getPlanoNomeAttribute()
    {
        return $this->attributes['planoNome'] = $this->plano->nome;
    }

    public function getResponsavelAttribute()
    {
        if ($this->usuario()->exists()) {
            return $this->attributes['responsavel'] = $this->usuario->nome . ' - ' . $this->usuario->email;
        }
    }

    public function getStatusAttribute()
    {
        if ($this->usuario()->exists()) {
            if ($this->usuario->confirmation_token === null) {
                $tag = '<label for="" class="label label-success">SIM</label>';
            } else {
                $tag = '<label for="" class="label label-danger">NÃO</label>';
            }

            return $this->attributes['status'] = $tag;
        }
    }

    public function getBoletoTagAttribute()
    {
        if ($this->boleto !== null) {
            $tag = '<label for="" class="label label-success">SIM</label>';
        } else {
            $tag = '';
        }

        return $this->attributes['boletoTag'] = $tag;
    }

    public function getInteressesAttribute()
    {
        $resp = '';
        if ($this->usuario()->exists()) {
            if ($this->usuario->interesse1()->exists()) {
                $resp .= $this->usuario->interesse1->nome;
            }
            if ($this->usuario->interesse2()->exists()) {
                $resp .= '<br>' . $this->usuario->interesse2->nome;
            }
            if ($this->usuario->interesse3()->exists()) {
                $resp .= '<br>' . $this->usuario->interesse3->nome;
            }

            return $this->attributes['interesses'] = $resp;
        }
    }
   
    public function getCidadeUfAttribute()
    {
        return $this->attributes['cidadeUf'] = $this->cidade . '/' . $this->uf;
    }

    public function getQtdeProdAttribute()
    {              
        return $this->attributes['qtdeProd'] = $this->produtos()->count();
    }

    public function getRecebidosAttribute()
    {              
        return $this->attributes['Recebidos'] = $this->cotacoesComprador()->count();
    }

    public function getEnviadosAttribute()
    {              
        return $this->attributes['Enviados'] = $this->cotacoes()->count();
    }


    public function sluggable()
    {
        return [
          'slug' => [
            'source' => ['nome'],
          ],
        ];
    }
}
