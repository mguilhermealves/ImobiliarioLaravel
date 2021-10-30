<?php

namespace App\Http\Requests\Sistema\Painel\Perfil;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
          'telefone' => 'nullable|regex:/\(\d{2,}\) \d{4,5}\-\d{4}/',
          'celular' => 'nullable|regex:/\(\d{2,}\) \d{5}\-\d{4}/',
        ];
    }
}
