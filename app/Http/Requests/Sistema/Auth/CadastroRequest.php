<?php

namespace App\Http\Requests\Sistema\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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

    public function passedValidation()
    {
        unset($this['email_confirmation'], $this['senha_confirmation']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'email' => 'required|email|unique:usuarios,email|confirmed',
          'email_confirmation' => 'required_with:email|email',
          'senha' => 'required|confirmed|string|min:6',
          'senha_confirmation' => 'required_with:senha|string|min:6',
          'nome' => 'required|string|min:2',                    
          'telefone' => 'required|regex:/\(\d{2,}\) \d{4,5}\-\d{4}/',
          'empresa' => 'required|string|min:3',
          'estado_id'=> 'required|exists:estado,id',
        ];
    }

    public function messages()
    {
        return [
        'email.email_checker' => 'E-mail inválido ou inexistente!',
        'email.confirmed' => 'Confirmação de e-mail incorreta!',
        'telefone.regex' => 'Telefone inválido!',
      ];
    }
}
