<?php

namespace App\Http\Controllers\Sistema\Painel;

use Illuminate\Http\Request;
use App\Models\Usuario;

use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Empresas\EmpresasRepository;
use App\Repositories\Usuarios\UsuariosRepository;
use App\Http\Requests\Sistema\Painel\Perfil\PerfilRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Empresa\EmpresaRequest;
use App\Repositories\Planos\PlanosRepository;
use App\Http\Requests\Sistema\Auth\NovaSenhaRequest;

class PainelController extends Controller
{
    public function perfil()
    {
        // $pagarme = new Pagarme(config('app.pagarme.api_key'));
        // $postbacks = $pagarme->transactions()->simulateStatus([
        //   'id' => '7724847', //pode ser transaction ou subscription
        //   'status' => 'unpaid',
        // ]);
        // pre($postbacks);

        return view('sistema.painel.perfil', [
          'title' => 'Meu Perfil',
        ]);
    }

    public function alterarPerfil(PerfilRequest $request)
    {
        UsuariosRepository::altera($this->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Dados alterados com sucesso!', route('sistema.painel.perfil'));
    }

    public function alterarEmpresa(EmpresaRequest $request)
    {
        EmpresasRepository::salvar($this->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Dados alterados com sucesso!', route('sistema.painel.perfil'));
    }

    public function conta()
    {
        return view('sistema.painel.conta', [
          'title' => 'Minha Conta',
        ]);
    }

    public function plano()
    {
        return view('sistema.painel.plano', [
          'outros' => PlanosRepository::outros($this->usuario->empresa),
          'title' => 'Meu Plano',
        ]);
    }

    public function planoForma(Request $request)
    {
        return view('sistema.painel.plano-forma', [
            'plano' => PlanosRepository::plano($request->plano),
            'title' => 'Formas de Pagamento',
          ]
        );
    }

    public function planoPagamento(Request $request)
    {
        if ($request->plano == 0) {
            return view('sistema.painel.plano-cartao', [
              'title' => 'Pagamento Com cartão de Crédito',
            ]);
        }

        return view('sistema.painel.plano-boleto', [
          'title' => 'pagamento com Boleto',
        ]);
    }

    public function boleto()
    {
        return view('sistema.painel.boleto', [
          'title' => 'Seu Boleto',
        ]);
    }

    public function cancelar()
    {
        PlanosRepository::cancelar($this->usuario->empresa);

        return SistemaService::jsonR(200, 1, 'Sua assinatura foi cancelada com sucesso!<br>Agora o seu plano é o FREE.', route('sistema.painel.plano'));
    }
}
