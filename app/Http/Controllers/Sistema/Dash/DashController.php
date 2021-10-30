<?php

namespace App\Http\Controllers\Sistema\Dash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoriaJuridico\CategoriaJuridicoRepository;
use App\Repositories\Home\HomeRepository;
use App\Services\Sistema\SistemaService;
use App\Models\Usuario;
use App\Repositories\Categorias\CategoriasRepository;
use App\Repositories\Usuarios\UsuariosRepository;
use App\Http\Requests\Sistema\Auth\NovaSenhaRequest;
use App\Http\Requests\Sistema\Painel\Perfil\PerfilRequest;

class DashController extends Controller
{
    public function index()
    {
        $categoriasJuri = CategoriaJuridicoRepository::all();
        $arquivos = HomeRepository::getArquivosJuridicosRestrita();
        return view('sistema.dash.index', [
          'title' => 'Área Restrita',
          'categorias' => $categoriasJuri,
          'arquivos'=>$arquivos     
        ]);
    }

    public function meusdados()
    {
        return view('sistema.dash.meus-dados', [
          'title' => 'Meus Dados',
        ]);
    }

    public function alterarConta(Usuario $usuario, NovaSenhaRequest $request, PerfilRequest  $perfilrequest)
    { 
      $credentials = [
        'email' => $request->email,
        'password' => $request->senha_atual,
        'confirmation_token' => null,
      ];

      if($request->senha){

        if (Auth::guard('sistema')->attempt($credentials)) {               
             UsuariosRepository::novaSenha($this->usuario, $request);    
            return SistemaService::jsonR(200, 1, 'Atualizado com sucesso!', route('sistema.dash.inicio'));
        }else{
          return SistemaService::jsonR(200, 0, 'Senha atual incorreta!', route('sistema.dash.inicio'));
        }
      
    }else{

      UsuariosRepository::altera($this->usuario, $perfilrequest);

      return SistemaService::jsonR(200, 1, 'Atualizado com sucesso!', route('sistema.dash.inicio'));
    }
       
    }
    
}
