<?php

namespace App\Http\Requests\Sistema\Rfq;

use Illuminate\Foundation\Http\FormRequest;

class NovoRfqRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'termo' => 'required|string|min:3',
          'quantidade' => 'required|numeric|min:1',
          'unidade_id' => 'required|int|exists:unidades,id',
          'categoria_id' => 'required|int|exists:categorias,id',
          'subcategoria_id' => 'required|int|exists:subcategorias,id',
          'grupo_id' => 'nullable|int|exists:grupos,id',
        ];
    }

    public function messages()
    {
        return [
          'termo.required' => 'O Produto é obrigatório!',
          'quantidade.required' => 'A Quantidade é obrigatória!',
          'unidade_id.required' => 'A Unidade é obrigatória!',
          'categoria_id.required' => 'A Categoria é obrigatória!',
          'subcategoria_id.required' => 'A Subategoria é obrigatória!',
        ];
    }
}
