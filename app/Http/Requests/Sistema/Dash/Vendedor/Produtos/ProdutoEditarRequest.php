<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Produtos;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoEditarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->produtoSlug) {
            if ($this->produtoSlug->empresa->id != auth()->guard('sistema')->user()->empresa->id) {
                return false;
            }
        }

        if ($this->produto) {
            if ($this->produto->empresa->id != auth()->guard('sistema')->user()->empresa->id) {
                return false;
            }
        }

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
            //
        ];
    }
}
