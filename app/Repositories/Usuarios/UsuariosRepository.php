<?php

namespace App\Repositories\Usuarios;

use App\Models\Contato;
use App\Models\Usuario;
use App\Models\Estado;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Services\Sistema\SistemaService;
use App\Http\Requests\Sistema\Auth\LoginRequest;
use App\Http\Requests\Sistema\Auth\SenhaRequest;
use App\Http\Requests\Sistema\Auth\CadastroRequest;
use App\Http\Requests\Sistema\Auth\NovaSenhaRequest;
use App\Http\Requests\Sistema\Painel\Perfil\PerfilRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UsuariosRepository
{
    public static function all()
    {
        return Usuario::with('estado')->orderBy('nome', 'DESC')->get();
    }

    public static function agenciasPorEstado($uf)
    {
        $estado = Estado::where('Uf', $uf)->get();

        return Usuario::where('estado_id', $estado[0]->id)->orderBy('nome', 'DESC')->get();
    }

    public static function adicionar(CadastroRequest $request)
    {
        $request->merge([
          'senha' => Hash::make($request->senha),
          // 'confirmation_token' => Str::random(100),
          // 'reset_token' => Str::random(100),
        ]);
        $usuario = Usuario::create($request->all());
        $usuario->refresh();
        // self::enviaConfirmacao($usuario);
    }

    public static function confirma(Usuario $usuario, String $token)
    {
        if ($usuario->confirmation_token !== $token || $usuario->confirmation_token === null) {
            return false;
        }
        $usuario->confirmation_token = null;
        $usuario->save();

        return true;
    }

    public static function enviaConfirmacao(Usuario $usuario)
    {
        Mail::send('sistema.emails.confirma-cadastro', [
          'obj' => $usuario,
        ], function ($mail) use ($usuario) {
            $mail->from(config('app.email'), config('app.name'));
            $mail->to($usuario->email);
            $mail->subject('88 Markets - Confirmação de Cadastro');
        });
    }

    public static function login(LoginRequest $request)
    {
        $credentials = [
          'email' => $request->email,
          'password' => $request->senha,
          'confirmation_token' => null,
        ];
        if (Auth::guard('sistema')->attempt($credentials)) {
            return SistemaService::jsonR(200, 1, 'Logado com sucesso!', route('sistema.dash.inicio'));
        }

        return self::sendFailedLoginResponse($request);
    }

    public static function verificaPlano(LoginRequest $request)
    {
        $usuario = Usuario::where('email', $request->email)->with('empresa')->first();
        $empresa = $usuario->empresa;
        if ($empresa->inicio_teste != null) {
            if ($empresa->validade_plano < Carbon::now()) {
                $empresa->plano_id = 1;
                $empresa->novo_plano_id = null;
                $empresa->assinatura_id = null;
                $empresa->save();
            }
        }
    }

    public static function sendFailedLoginResponse(LoginRequest $request)
    {
        $usuario = Usuario::where('email', $request->email)->first();
        if (!Hash::check($request->senha, $usuario->senha)) {
            return SistemaService::jsonR(200, 0, '<b>Senha incorreta!</b>');
        }
        if ($usuario->confirmation_token != null) {
            return SistemaService::jsonR(200, 0, '<b>Esta conta ainda não foi confirmada!</b> <br>Por favor, verifique seu e-mail.');
        }
    }

    public static function altera(Usuario $usuario, PerfilRequest $request)
    {
        $usuario->update($request->all());
    }

    public static function contato(Usuario $usuario, Usuario $contato)
    {
        return Contato::where('usuario_id', $usuario->id)->where('contato_id', $contato->id)->first();
    }

    public static function senha(SenhaRequest $request)
    {
        $usuario = Usuario::whereEmail($request->email)->first();
        if ($usuario && $usuario->reset_token != null) {
            $nToken = Str::random(60);
            $usuario->reset_token = $nToken;
            $usuario->save();
            self::enviaSenha($usuario);

            return true;
        }

        return false;
    }

    public static function enviaSenha(Usuario $usuario)
    {
        Mail::send('sistema.emails.recuperar-senha', [
          'obj' => $usuario,
        ], function ($mail) use ($usuario) {
            $mail->from(config('app.email'), config('app.name'));
            $mail->to($usuario->email);
            $mail->subject('88 Market - Recuperação de senha');
        });
    }

    public static function validaToken(Usuario $usuario, String $token)
    {
        return $usuario->reset_token === $token;
    }

    public static function novaSenha(Usuario $usuario, NovaSenhaRequest $request)
    {
        $usuario->senha = Hash::make($request->senha);
        $usuario->reset_token = Str::random(60);
        $usuario->save();
    }

    public static function calculaPerfil(Usuario $usuario)
    {
        $alvo = 20;
        $usu = 0;
        $emp = 0;
        $usuf = self::usuarioFields();
        $empf = self::empresaFields();
        foreach ($usuario->getAttributes() as $k => $v) {
            if (in_array($k, $usuf)) {
                if ($v != '' || $v != null) {
                    $usu ++;
                }
            }
        }
        foreach ($usuario->empresa->getAttributes() as $k => $v) {
            if (in_array($k, $empf)) {
                if ($v != '' || $v != null) {
                    $emp ++;
                }
            }
        }

        $total = $usu + $emp;
        $p = number_format(($total * 100) / $alvo, 2, '.', ',');
        $f = number_format((100 - $p), 2, '.', ',');

        return ['p' => $p, 'f' => $f];
    }

    public static function makeCidades(Collection $agencias)
    {
        $cidades = [];
        foreach ($agencias as $item) {
            if ($item->cidades()->exists()) {
                $cidades[$item->cidades->id] = $item->cidades->Nome;
            }
        }

        return $cidades;
    }

    protected static function usuarioFields()
    {
        return  [
        'nome',
        'sobrenome',
        'telefone',
        'celular',
      ];
    }

    protected static function empresaFields()
    {
        return  [
        'cnpj',
        'nome',
        'uf',
        'cidade',
        'site',
        'fundacao',
        'funcionarios',
        'tipo',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'produto1',
        'produto2',
        'produto3',
        'produto4',
      ];
    }
}
