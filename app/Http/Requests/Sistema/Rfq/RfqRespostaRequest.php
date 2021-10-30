<?php

namespace App\Http\Requests\Sistema\Rfq;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RfqRespostaRequest extends FormRequest
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
        $this->merge([
          'valor' => currencyToBd($this->valor),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'produto_id' => 'required_if:tipo,0|int|exists:produtos,id',
          'valor' => 'required|numeric|min:0.01',
          'unidade_id' => 'required|int|exists:unidades,id',
          'pagamento' => 'required|string|min:2',
          'validade' => 'required|date_format:d/m/Y',
          'produto' => 'required_if:tipo,1|string|min:5',
        ];
    }

    public function messages()
    {
        return[
          'produto_id.required_if' => 'Por favor, selecione um produto!',
          'unidade_id.required' => 'A unidade é obrigatória!',
          'produto.required_if' => 'O nome do produto é obrigatório!',
        ];
    }

    public function passedValidation()
    {
        $usuario = Auth::guard('sistema')->user();

        return $this->merge([
          'fornecedor_id' => $usuario->empresa->id,
          'validade' => dateAppToBd($this->validade),
        ]);
    }
}
