<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Grupos;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user('sistema')->empresa->id != $this->empresa_id) {
            return false;
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
          'empresa_id' => 'required|int|exists:empresas,id',
          'nome' => 'required|string|min:2|unique_with:empresagrupos,nome,empresa_id,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
        'nome.unique_with' => 'Já existe um grupo com este nome!',
      ];
    }
}
