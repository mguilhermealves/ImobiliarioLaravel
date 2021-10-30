<?php

namespace App\Http\Requests\Sistema\Painel;

use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
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
        return $this->merge([
          'cc' => limpaNumeros($this->cc),
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
          'forma' => 'required|int|min:0|max:2',
          'plano_id' => 'required|int|exists:planos,codigo_gateway',
          'cpf_cc' => 'required_if:forma,0|string|size:14',
          'cpf_b' => 'required_if:forma,1|string|min:14|max:18',
          'nascimento' => 'required_if:forma,0|date_format:d/m/Y',
          'cc' => ['required_if:forma,0', new CardNumber],
          'titular' => 'required_if:forma,0|string:min:10',
          'mes' => ['required_if:forma,0', new CardExpirationMonth($this->ano)],
          'ano' => ['required_if:forma,0', new CardExpirationYear($this->mes)],
          'cvc' => 'required_if:forma,0|digits_between:3,4',
          'cep' => 'required|string|size:9',
          'logradouro' => 'required|string|min:10',
          'numero' => 'required|string|min:1',
          'bairro' => 'required|string|min:2',
          'cidade' => 'required|string|min:2',
          'uf' => 'required|string|size:2',         
        ];
    }

    public function messages()
    {
        return [
        '*.required_if' => 'O campo é obrigatório!',
        '*.required' => 'O campo é obrigatório!',
        'cc.credit_card.card_invalid' => 'Número de cartão inválido!',
      ];
    }
}
