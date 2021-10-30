<?php

namespace App\Http\Requests\Sistema\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SenhaRequest extends FormRequest
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
          'email' => 'required|email|exists:usuarios,email',
        ];
    }

    public function messages()
    {
        return [
          'email.email' => 'E-mail inválido!',
          'email.exists' => 'E-mail não encontrado em nossa base de dados!',
        ];
    }
}
