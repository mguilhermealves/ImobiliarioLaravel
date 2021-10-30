<?php

namespace App\Http\Controllers\Sistema\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\Sistema\SistemaService;
use App\Http\Requests\Sistema\Auth\LoginRequest;
use App\Http\Requests\Sistema\Auth\SenhaRequest;
use App\Repositories\Usuarios\UsuariosRepository;
use App\Http\Requests\Sistema\Auth\NovaSenhaRequest;
use App\Notifications\BoasVindas;
use App\Notifications\BoasVindasComprador;
use App\Http\Requests\Sistema\ContatoRequest;
use App\Models\User;
use App\Notifications\CadastroAgencia;

class AuthController extends Controller
{
    public function cadastro()
    {
        return view('sistema.auth.registro', [
          'titulo' => 'Cadastro',
          'subtitulo' => 'Preencha as informações abaixo',
          'title' => 'Cadastre-se',
        ]);
    }

    public function cadastrar(ContatoRequest $request)
    {
        //UsuariosRepository::adicionar($request);
        User::all()->each(function ($u) use ($request) {
            $u->notify(new CadastroAgencia($request));
        });

        return SistemaService::jsonR(200, 1, 'Solicitação enviada com sucesso! Por favor, aguarde o contato de nossa equipe!', route('sistema.index'));
    }

    public function cadastroFinalizado()
    {
        return view('sistema.auth.obrigado', [
            'titulo' => 'Obrigado por se cadastrar',
            'subtitulo' => 'Verifique seu e-mail e confirme o cadastro',
            'title' => 'Cadastro finalizado',
            ]);
    }

    public function confirmar(Usuario $usuario, String $token)
    {
        $confirmacao = UsuariosRepository::confirma($usuario, $token);

        if ($usuario->perfil == 0) {
            $usuario->notify(new BoasVindas($usuario));
        } else {
            $usuario->notify(new BoasVindasComprador($usuario));
        }

        return view('sistema.auth.confirmacao', [
          'titulo' => 'Confirmação de usuário',
          'subtitulo' => 'Obrigado por se cadastrar!',
          'confirmacao' => $confirmacao,
          'title' => 'Confirmação de Conta',
        ]);
    }

    public function login(Request $request)
    {
        // pre(routeName(url()->previous()));
        if (routeName(url()->previous()) != 'sistema.sair' && routeName(url()->previous()) != 'sistema.auth' && routeName(url()->previous()) != 'sistema.auth.confirmar') {
            session()->put('from', url()->previous());
        } else {
            session()->put('from', route('sistema.index'));
        }
        // pre(session('from'));

        return view('sistema.auth.login', [
          'titulo' => 'Acesso ao Sistema',
          'subtitulo' => 'Faça seu login abaixo',
          'title' => 'Autenticação',
        ]);
    }

    public function recuperarSenha()
    {
        return view('sistema.auth.senha', [
          'titulo' => 'Recuperação de senha',
          'subtitulo' => 'Preencha os dados abaixo',
          'title' => 'Recuperar Senha',
        ]);
    }

    public function senha(SenhaRequest $request)
    {
        if (UsuariosRepository::senha($request)) {
            return SistemaService::jsonR(200, 1, 'Recuperação de senha concluída com sucesso!<br>Por favor, siga as instruções no e-mail que você receberá em breve.', route('sistema.index'));
        }

        return SistemaService::jsonR(401, 0, 'Ocorreu algum erro em nosso sistema, por favor, tente novamente mais tarde.', route('sistema.index'));
    }

    public function novaSenha(Usuario $usuario, String $token)
    {
        if (UsuariosRepository::validaToken($usuario, $token)) {
            return view('sistema.auth.nova-senha', [
              'titulo' => 'Recuperação de senha - Criação de nova senha',
              'subtitulo' => '<b>' . $usuario->fullname . '</b>, crie uma nova senha abaixo',
              'usuario' => $usuario,
              'token' => $token,
              'title' => 'Criação de Nova Senha',
            ]);
        }

        return view('sistema.auth.nova-senha-fail', [
          'titulo' => 'Recuperação de senha',
          'subtitulo' => 'Preencha os dados abaixo',
          'title' => 'Preencha os campos',
        ]);
    }

    public function criarSenha(Usuario $usuario, String $token, NovaSenhaRequest $request)
    {
        if (UsuariosRepository::validaToken($usuario, $token)) {
            UsuariosRepository::novaSenha($usuario, $request);

            return SistemaService::jsonR(200, 1, 'Nova senha cadastrada com sucesso!<br>Por favor, realize o login.', route('sistema.auth.login'));
        }

        return SistemaService::jsonR(401, 0, 'Ocorreu algum erro em nosso sistema, por favor, tente novamente mais tarde.', route('sistema.index'));
    }

    public function auth(LoginRequest $request)
    {
        return UsuariosRepository::login($request);
    }

    public function sair()
    {
        // pre('asdasdasd');
        Auth::guard('sistema')->logout();
        // Session::flush();

        return response()->redirectTo(route('sistema.index'));
    }
}
