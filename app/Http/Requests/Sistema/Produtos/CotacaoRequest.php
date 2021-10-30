<?php

namespace App\Http\Requests\Sistema\Produtos;

use Illuminate\Foundation\Http\FormRequest;

class CotacaoRequest extends FormRequest
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
        // pre($this->produtoSlug->quantidade_minima);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'quantidade' => 'required|numeric|min:' . $this->produtoSlug->quantidade_minima,
        ];
    }
}
