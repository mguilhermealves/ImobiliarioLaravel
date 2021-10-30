<?php

namespace App\Repositories\Planos;

use App\Http\Requests\Sistema\Painel\PagamentoRequest;
use App\Models\Empresa;
use PagarMe\Client as Pagarme;
use PagarMe\Exceptions\PagarMeException;

class PagarmeRepository
{
    public static function cc(Empresa $empresa, PagamentoRequest $request)
    {
        $pagarme = new Pagarme(config('app.pagarme.api_key'));

        try {
            $assinatura = $pagarme->subscriptions()->create([
                'plan_id' => $request->plano_id,
                'payment_method' => 'credit_card',
                'card_number' => $request->cc,
                'card_holder_name' => $request->titular,
                'card_expiration_date' => $request->mes . $request->ano,
                'card_cvv' => $request->cvc,
                // 'postback_url' => route('sistema.assinaturas.resposta'),
                'postback_url' => 'https://webhook.site/d7cbde75-596d-40a5-86ed-7206a5335b79',
                'customer' => [
                    'email' => $empresa->usuario->email,
                    'name' => $empresa->usuario->fullName,
                    'document_number' => $request->cpf,
                    'address' => [
                        'street' => $request->logradouro,
                        'street_number' => $request->numero,
                        'complementary' => $request->complemento,
                        'neighborhood' => $request->bairro,
                        'zipcode' => $request->cep,
                    ],
                    // 'phone' => [
                    //     'ddd' => '01',
                    //     'number' => '923456780',
                    // ],
                    // 'sex' => 'other',
                    // 'born_at' => '1970-01-01',
                ],
            ]);

            return $assinatura;
        } catch (PagarMeException $e) {
            return self::preparaErro($e->getMessage());
        }
    }

    public static function boleto(Empresa $empresa, PagamentoRequest $request)
    {
        $pagarme = new Pagarme(config('app.pagarme.api_key'));

        try {
            $assinatura = $pagarme->subscriptions()->create([
                'plan_id' => $request->plano_id,
                'payment_method' => 'boleto',
                'postback_url' => route('sistema.assinaturas.resposta'),
                // 'postback_url' => 'https://webhook.site/d7cbde75-596d-40a5-86ed-7206a5335b79',
                'customer' => [
                    'email' => $empresa->usuario->email,
                    'name' => $empresa->usuario->fullName,
                    'document_number' => $request->cpf_b,
                    'address' => [
                        'street' => $request->logradouro,
                        'street_number' => $request->numero,
                        'complementary' => $request->complemento,
                        'neighborhood' => $request->bairro,
                        'zipcode' => $request->cep,
                    ],
                    // 'phone' => [
                    //     'ddd' => '01',
                    //     'number' => '923456780',
                    // ],
                    // 'sex' => 'other',
                    // 'born_at' => '1970-01-01',
                ],
            ]);

            return $assinatura;
        } catch (PagarMeException $e) {
            return self::preparaErro($e->getMessage());
        }
    }

    public static function preparaErro(String $erro)
    {
        $erros = explode('MESSAGE:', $erro);

        return end($erros);
    }

    public static function cancelar(Empresa $empresa)
    {
        $pagarme = new Pagarme(config('app.pagarme.api_key'));
        $canceledSubscription = $pagarme->subscriptions()->cancel([
            'id' => $empresa->assinatura_id,
        ]);
    }
}
