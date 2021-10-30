<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Produtos;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->valor_minimo) {
            $this->merge([
          'valor_minimo' => currencyToBd($this->valor_minimo),
        ]);
        }
        if ($this->valor_maximo) {
            $this->merge([
          'valor_maximo' => currencyToBd($this->valor_maximo),
        ]);
        }
        if ($this->valor_unico) {
            $this->merge([
          'valor_unico' => currencyToBd($this->valor_unico),
        ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'empresa_id' => 'required|int|exists:empresas,id',
          'nome' => 'required|string|min:2|max:60',
          'modelo' => 'nullable|string|min:2',
          'keywords' => 'required|string|min:2',
          'categoria_id' => 'required|int|exists:categorias,id',
          'subcategoria_id' => 'required|int|exists:subcategorias,id',
          'grupo_id' => 'nullable|int|exists:grupos,id',
          'unidade_id' => 'required|int|exists:unidades,id',
          'descricao' => 'required|string|min:50',
          'quantidade_minima' => 'required|numeric|min:0',
          'valor_minimo' => 'required_without:valor_unico|required_with:valor_maximo|numeric|min:0.01',
          'valor_maximo' => 'required_with:valor_minimo|required_without:valor_unico|numeric|min:0.01',
          'valor_unico' => 'required_without_all:valor_minimo,valor_maximo|numeric|min:0.01',
          'principal' => 'required|string|min:20',
        ];
    }

    public function messages()
    {
        return [
        'principal.required' => 'A imagem principal é obrigatória!',
        'valor_maximo.required_with' => 'Este campo é obrigatório junto com o valor mínimo!',
        'valor_minimo.required_without' => 'Preencha um destes campos!',
        'valor_maximo.required_without' => 'Preencha um destes campos!',
        'valor_unico.required_without' => 'Preencha um destes campos!',
        'valor_minimo.required_with' => 'Este campo é obrigatório junto com o valor máximo!',
      ];
    }
}
