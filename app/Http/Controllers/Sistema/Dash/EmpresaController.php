<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Empresas\EmpresasRepository;
use App\Http\Requests\Sistema\Dash\Vendedor\Empresa\EmpresaRequest;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('sistema.dash.vendedor.empresa.index', [
          'empresa' => $this->usuario->empresa,
          'title' => 'Painel de Controle - Vendedor - Dados da Empresa'
        ]);
    }

    public function salvar(EmpresaRequest $request)
    {
        EmpresasRepository::salvar($this->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Dados atualizados com sucesso!', route('sistema.dash.vendedor.empresa'));
    }

    public function certificadoAdicionar(Empresa $empresa, Request $request){
        if (EmpresasRepository::checkEmpresa($this->usuario, $empresa)) {
            return EmpresasRepository::certificados($empresa, $request);
        }

        return SistemaService::jsonR(401, 0, 'Operação não autorizada!', route('sistema.dash.vendedor.empresa'));
    }

    public function certificadoApagar(Empresa $empresa, Request $request)
    {
        if (EmpresasRepository::checkEmpresa($this->usuario, $empresa)) {
            return EmpresasRepository::apagarCertificado($empresa, $request);
        }

        return SistemaService::jsonR(401, 0, 'Operação não autorizada!', route('sistema.dash.vendedor.empresa'));
    }
}
