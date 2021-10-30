<?php

namespace App\Http\Requests\Sistema\Auth;

use Illuminate\Foundation\Http\FormRequest;

class NovaSenhaRequest extends FormRequest
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
        //   'senha' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
