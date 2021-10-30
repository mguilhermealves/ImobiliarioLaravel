<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
        // pre($this->all());
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
          'logo' => 'nullable|string|min:5',
          'nome' => 'required|string|min:3',
          'telefone' => 'nullable|regex:/\(\d{2,}\) \d{4,5}\-\d{4}/',
          'email' => 'nullable|email',
          'uf' => 'required|string|size:2',
          'cidade' => 'required|string|min:2',         
          'site' => 'nullable|string|min:5',
          'cnpj' => 'required|regex:/\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/|unique:empresas,cnpj,' . $this->empresa_id,
          'cep' => 'required|string|size:9',
          'logradouro' => 'required|string|min:2',
          'numero' => 'required|string|min:1',
          'bairro' => 'required|string|min:2',
          'sobre' => 'nullable|string|min:1',
        ];
    }
}
