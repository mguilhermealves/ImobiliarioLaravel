<?php

namespace App\Http\Controllers\Sistema\Planos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Planos\PlanosRepository;
use App\Http\Requests\Sistema\Painel\PagamentoRequest;
use App\Repositories\Empresas\EmpresasRepository;

class PlanosController extends Controller
{
    public function pagar(PagamentoRequest $request)
    {
        if ($request->forma == 0) {
            $resposta = PlanosRepository::pagarCC($this->usuario->empresa, $request);
            if (is_object($resposta)) {
                PlanosRepository::atualizaAssinatura($this->usuario->empresa, $resposta);
                PlanosRepository::atualizaValidade($this->usuario->empresa);

                return SistemaService::jsonR(200, 1, 'Sua assinatura foi enviada para análise financeira e, em breve, você terá uma resposta!<br>Obrigado!', route('sistema.painel.perfil'));
            }

            return SistemaService::jsonR(200, 0, $resposta, 0);
        }

        if ($request->forma == 1) {
            $resposta = PlanosRepository::pagarBoleto($this->usuario->empresa, $request);
            if (is_object($resposta)) {
                PlanosRepository::atualizaAssinatura($this->usuario->empresa, $resposta);
                PlanosRepository::atualizaBoleto($this->usuario->empresa, $resposta);

                return SistemaService::jsonR(200, 1, 'por favor, realize o pagamento de seu boleto na próxima tela, e aguarde a compensação do mesmo!', route('sistema.painel.plano.boleto'));
            }

            return SistemaService::jsonR(200, 0, $resposta, 0);
        }

        if ($request->forma == 2) {            
                        
                PlanosRepository::atualizaAssinaturaGratis($this->usuario->empresa, $request->plano_id);
                return SistemaService::jsonR(200, 1, 'Teste grátis ativado. Aproveite os 30 dias grátis e cadastre seus produtos.', route('sistema.painel.perfil'));           
               
        }
    }

    public function resposta(Request $request)
    {
        $data = $request->getContent();
        $postback = json_decode(json_encode($data), false);
        $status = $postback->subscription->current_transaction->status;
        $id = $postback->subscription->id;
        if ($status == 'paid') {
            $empresa = EmpresasRepository::porAssinatura($id);
            if ($empresa) {
                PlanosRepository::atualizaValidade($empresa);
            }
        }
    }
}
