<?php

namespace App\Models;

use App\Traits\Sistema\Search;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laracodes\Presenter\Traits\Presentable;

class Produto extends Model
{
    use Sluggable;
    use Presentable;
    use Search;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => ['empresa.nome', 'nome'],
        ],
      ];
    }

    protected $guarded = [
      'principal',
      'imagem_1',
      'imagem_2',
      'imagem_3',
      'imagem_4',
      'imagem_5',
      'imagem1',
      'imagem2',
      'imagem3',
      'imagem4',
      'imagem5',
      'notifica',
    ];
    protected $appends = [
      'empresaNome',
      'categoriaNome',
      'subcategoriaNome',
      'grupoNome',
      'statusTag',
      'precoFront',
      'principal',
      'imagem1',
      'imagem2',
      'imagem3',
      'imagem4',
      'imagem5',
      'preco',
      'pagamentoFront',
      'freteFront',
      'dataFormatada',
      'dataFormatadaAlt',
    ];
    protected $searchable = [
      'produtos.nome',
      'keywords',
    ];
    protected $presenter = 'App\Http\Presenters\ProdutoPresenter';

    public $hasOrder = false;
    public $order = 6;
    public $hasForm = true;
    public $update = true;
    public $listagem = [
      'nome',
      'empresa' => 'empresaNome',
      'categoria' => 'categoriaNome',
      'sub Categoria' => 'subcategoriaNome',
      'grupo' => 'grupoNome',
      'Data de Criação' => 'dataFormatada',
      'Data de Alteração' => 'dataFormatadaAlt',
    ];
    public $defs = [
      '6' => 'date-euro',
    ];

    public $formulario = [
      'nome' => [
        'title' => 'Nome do Produto',
        'type' => 'text',
        'width' => 8,
        'validators' => 'required|min:2|unique:categorias,nome,$this->id',
      ],
      'modelo' => [
        'title' => 'Modelo',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'keywords' => [
        'title' => 'Keywords',
        'type' => 'text',
        'width' => 12,
        'class' => 'keywords',
        'validators' => 'required|min:1',
      ],
      'categoria_id' => [
        'title' => 'Categoria do Produto',
        'type' => 'belongs',
        'width' => 4,
        'class' => 'categorias',
        'model' => 'Categoria',
        'show' => 'nome',
        'validators' => 'required|exists:categorias,id',
      ],
      'subcategoria_id' => [
        'title' => 'SubCategoria do Produto',
        'type' => 'belongs',
        'width' => 4,
        'class' => 'subcategorias',
        'model' => 'Subcategoria',
        'show' => 'nome',
        'validators' => 'required|exists:subcategorias,id',
      ],
      'grupo_id' => [
        'title' => 'Grupo do Produto',
        'type' => 'belongs',
        'width' => 4,
        'class' => 'grupos',
        'model' => 'Grupo',
        'show' => 'nome',
        'validators' => 'nullable|exists:grupos,id',
      ],
      'descricao' => [
        'title' => 'Descrição do Produto',
        'type' => 'textarea',
        'width' => 12,
        'editor' => true,
      ],
      'info' => [
        'title' => 'Informações Adicionais',
        'type' => 'fieldset',
      ],
      'marca' => [
        'title' => 'Marca',
        'type' => 'text',
        'width' => 3,
        'validators' => 'nullable|min:1',
      ],
      'tipo_material' => [
        'title' => 'Tipo de Material',
        'type' => 'text',
        'width' => 3,
        'validators' => 'nullable|min:1',
      ],
      'cidade_origem' => [
        'title' => 'Cidade de Origem',
        'type' => 'text',
        'width' => 3,
        'validators' => 'nullable|min:1',
      ],
      'prazo_entrega' => [
        'title' => 'Prazo de Entrega Estimado',
        'type' => 'text',
        'width' => 3,
        'validators' => 'nullable|min:1',
      ],
      'amostra' => [
        'title' => 'Amostra?',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Não', 1 => 'Sim'],
        'width' => 3,
      ],
      'reciclavel' => [
        'title' => 'Reciclável?',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Não', 1 => 'Sim'],
        'width' => 3,
      ],
      'oem' => [
        'title' => 'OEM?',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Não', 1 => 'Sim'],
        'width' => 3,
      ],
      'origem' => [
        'title' => 'Origem',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Nacional', 1 => 'Importado'],
        'width' => 3,
      ],
      'info2' => [
        'title' => 'Informações de Logística',
        'type' => 'fieldset',
      ],
      'dimensao_produto' => [
        'title' => 'Dimensão do Produto',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'peso_produto' => [
        'title' => 'Peso do Produto',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'dimensao_master' => [
        'title' => 'Dimensão da Caixa Master',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'peso_master' => [
        'title' => 'Peso da Caixa Master',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'quantidade_master' => [
        'title' => 'Quantidade na Caixa Master',
        'type' => 'text',
        'width' => 4,
        'validators' => 'nullable|min:1',
      ],
      'info3' => [
        'title' => 'Imagens do Produto',
        'type' => 'fieldset',
      ],
      'principal' => [
        'title' => 'Imagem Principal',
        'type' => 'image',
        'width' => 12,
        'validators' => 'required|string|min:10',
      ],
      'imagem1' => [
        'title' => 'Imagem 1',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem2' => [
        'title' => 'Imagem 2',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem3' => [
        'title' => 'Imagem 3',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem4' => [
        'title' => 'Imagem 4',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'imagem5' => [
        'title' => 'Imagem 5',
        'type' => 'image',
        'width' => 12,
        'validators' => 'nullable|string|min:10',
      ],
      'info4' => [
        'title' => 'Status do Produto',
        'type' => 'fieldset',
      ],
      'status' => [
        'title' => 'Status',
        'type' => 'radio',
        'src' => 'array',
        'data' => [1 => 'Aprovado', 2 => 'Reprovado'],
        'width' => 3,
        'validators' => 'required|int|min:1|max:2',
      ],
      'motivo_rejeicao' => [
        'title' => 'Motivo da rejeicao',
        'type' => 'textarea',
        'width' => 12,
        'editor' => false,
        'validators' => 'required_if:status,2|min:10',
      ],
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
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

    public function imagens()
    {
        return $this->hasMany(Produtoimagem::class);
    }

    public function favoritados()
    {
        return $this->belongsToMany(Usuario::class);
    }

    public function imagemPrincipal()
    {
        return $this->imagens()->where('principal', 1)->first();
    }

    public function outrasImagens()
    {
        return $this->imagens()->where('principal', 0)->get();
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function grupos()
    {
        return $this->belongsToMany(Empresagrupo::class);
    }

    public function subgrupos()
    {
        return $this->belongsToMany(Empresasubgrupo::class);
    }

    public function novos()
    {
        return [
          'title' => 'Produtos Novos',
          'filter' => [
            'field' => 'status',
            'operator' => '=',
            'value' => 0,
          ],
          'form' => [
            'status' => [
              'value' => 0,
              'validators' => 'required|int|min:0|max:0',
            ],
          ],
        ];
    }

    public function aprovados()
    {
        return [
          'title' => 'Produtos Aprovados',
          'filter' => [
            'field' => 'status',
            'operator' => '=',
            'value' => 1,
          ],
          'form' => [
            'status' => [
              'value' => 1,
              'validators' => 'required|int|min:1|max:1',
            ],
          ],
        ];
    }

    public function reprovados()
    {
        return [
          'title' => 'Produtos Reprovados',
          'filter' => [
            'field' => 'status',
            'operator' => '=',
            'value' => 2,
          ],
          'form' => [
            'status' => [
              'value' => 2,
              'validators' => 'required|int|min:2|max:2',
            ],
          ],
        ];
    }

    public function getEmpresaNomeAttribute()
    {
        return $this->attributes['empresaNome'] = $this->empresa->nome;
    }

    public function getCategoriaNomeAttribute()
    {
        if ($this->categoria) {
            return $this->attributes['categoriaNome'] = $this->categoria->nome;
        }
    }

    public function getSubCategoriaNomeAttribute()
    {
        if ($this->subcategoria) {
            return $this->attributes['subcategoriaNome'] = $this->subcategoria->nome;
        }
    }

    public function getGrupoNomeAttribute()
    {
        if ($this->grupo()->exists()) {
            return $this->attributes['grupoNome'] = $this->grupo->nome;
        }

        return $this->attributes['grupoNome'] = '--';
    }

    public function getStatusTagAttribute()
    {
        switch ($this->status) {
        case 0:
          $tag = '<label for="" class="badge badge-warning" title="Aguardando aprovação">&nbsp;</label>';

          break;

        case 1:
          $tag = '<label for="" class="badge badge-success" title="Aprovado">&nbsp;</label>';

          break;

        default:
          $tag = '<label for="" class="badge badge-danger" title="Reprovado">&nbsp;</label>';

          break;
      }

        return $this->attributes['statusTag'] = $tag;
    }

    public function getPrecoFrontAttribute()
    {
        if ((float) $this->valor_unico > 0) {
            $preco = currencyToApp($this->valor_unico);
        } else {
            $preco = currencyToApp($this->valor_minimo) . ' - ' . currencyToApp($this->valor_maximo);
        }

        return $this->attributes['precoFront'] = $preco;
    }

    public function getPrincipalAttribute()
    {
        if ($this->imagemPrincipal()) {
            return $this->attributes['principal'] = $this->imagemPrincipal()->imagem;
        }

        return $this->attributes['principal'] = '';
    }

    public function getImagem1Attribute()
    {
        if (isset($this->outrasImagens()[0])) {
            return $this->attributes['imagem1'] = $this->outrasImagens()[0]->imagem;
        }

        return $this->attributes['imagem1'] = assets('backend/images/sem-imagem.png');
    }

    public function getImagem2Attribute()
    {
        if (isset($this->outrasImagens()[1])) {
            return $this->attributes['imagem1'] = $this->outrasImagens()[1]->imagem;
        }

        return $this->attributes['imagem1'] = assets('backend/images/sem-imagem.png');
    }

    public function getImagem3Attribute()
    {
        if (isset($this->outrasImagens()[2])) {
            return $this->attributes['imagem1'] = $this->outrasImagens()[2]->imagem;
        }

        return $this->attributes['imagem1'] = assets('backend/images/sem-imagem.png');
    }

    public function getImagem4Attribute()
    {
        if (isset($this->outrasImagens()[3])) {
            return $this->attributes['imagem1'] = $this->outrasImagens()[3]->imagem;
        }

        return $this->attributes['imagem1'] = assets('backend/images/sem-imagem.png');
    }

    public function getImagem5Attribute()
    {
        if (isset($this->outrasImagens()[4])) {
            return $this->attributes['imagem1'] = $this->outrasImagens()[4]->imagem;
        }

        return $this->attributes['imagem1'] = assets('backend/images/sem-imagem.png');
    }

    public function getPrecoAttribute()
    {
        if ((float) $this->valor_unico > 0) {
            return $this->attributes['preco'] = currencyToApp($this->valor_unico);
        }

        return $this->attributes['preco'] = currencyToApp($this->valor_minimo) . ' - ' . currencyToApp($this->valor_maximo);
    }

    public function getPagamentoFrontAttribute()
    {
        switch ($this->pagamento) {
        case 0:
          $out = 'À Vista';

          break;

        default:
          $out = 'À Prazo';

          break;
      }

        return $this->attributes['pagamentoFront'] = $out;
    }

    public function getFreteFrontAttribute()
    {
        switch ($this->frete) {
        case 0:
          $out = 'CIF';

          break;

        default:
          $out = 'FOB';

          break;
      }

        return $this->attributes['freteFront'] = $out;
    }

    public function getDataFormatadaAttribute()
    {
        return $this->attributes['dataFormatada'] = $this->created_at->format('d/m/Y H:i:s');
    }

    public function getDataFormatadaAltAttribute()
    {
        return $this->attributes['dataFormatadaAlt'] = $this->updated_at->format('d/m/Y H:i:s');
    }
}
