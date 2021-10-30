<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Produtos;

use Illuminate\Foundation\Http\FormRequest;

class MensagemCategoriaRequest extends FormRequest
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
          'nome' => 'required|string|min:2',
          'email' => 'required|email',
          'celular' => 'required|regex:/\(\d{2,}\) \d{5}\-\d{4}/',
          'mensagem' => 'required|string|min:10',
        ];
    }
}
