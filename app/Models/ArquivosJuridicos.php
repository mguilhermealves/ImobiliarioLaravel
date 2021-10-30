<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ArquivosJuridicos extends Model
{ 
    protected $guarded = ['file_arquivo'];
    public $hasOrder = false;
    public $hasForm = true;
    public $update = true;
    public $title = 'Arquivos';
    public $newButton = 'Novo Arquivo';

    protected $appends = [
      'categoriaNome',
      'tipoNome'
    ];

    public $listagem = [
      'titulo',      
      'categoria'=>'categoriaNome',
      'tipo' => 'tipoNome'
    ];

    public $formulario = [
      'titulo' => [
        'title' => 'Titulo',
        'type' => 'text',
        'width' => 6,
        'validators' => 'required|string|min:3',
      ],
      'arquivo' => [
        'title' => 'Arquivo',
        'type' => 'file',
        'width' => 12,
        'types' => ['pdf'],
        'validators' => 'nullable|file',
      ],
      'categoria_id' => [
        'title' => 'Categoria do Arquivo',
        'type' => 'belongs',
        'width' => 4,
        'class' => 'CategoriaJuridico',
        'model' => 'CategoriaJuridico',
        'show' => 'nome',
        'validators' => 'required|exists:categoria_juridicos,id',
        'state' =>false
      ],
      'tipo' => [
        'title' => 'Tipo',
        'type' => 'radio',
        'src' => 'array',
        'data' => [0 => 'Publico', 1 => 'Restrito'],
        'width' => 3,
        'validators' => 'required',
      ],

    ];

    public function getCategoriaNomeAttribute()
    {
        if ($this->categoria) {
            return $this->attributes['categoriaNome'] = $this->categoria->nome;
        }
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaJuridico::class);
    }

    public function getTipoNomeAttribute()
    {
       
            return $this->attributes['tipo'] = $this->tipo == 0 ? 'Público' : 'Restrito';
      
    }

    

}

