<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Contato;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Contatos\ContatosRepository;
use App\Repositories\Mensagens\MensagemRepository;

class ContatosController extends Controller
{
    public function index()
    {
        return view('sistema.dash.vendedor.contatos.index', [
          'contatos' => $this->usuario->contatos,
          'title' => 'Painel de Controle - Contatos'
        ]);
    }

    public function modal()
    {
        return view('sistema.dash.vendedor.contatos.modal', [
          'contatos' => $this->usuario->contatos,
          'title' => 'Painel de Controle - Contatos'
        ]);
    }

    public function adicionar(Usuario $contato)
    {
        ContatosRepository::adiciona($this->usuario, $contato);

        return SistemaService::jsonR(200, 1, 'Contato adicionado com sucesso!', 0);
    }

    public function excluir(Contato $contato)
    {
        if (ContatosRepository::checkDono($this->usuario, $contato)) {
            $contato->delete();

            return SistemaService::jsonR(200, 1, 'Contato excluído com sucesso!', 0);
        }

        return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', 0);
    }

    public function nova(Contato $contato, Request $request)
    {
        $path = explode('/', $request->p);
        if ($path[2] == 'vendedor') {
            $chat = MensagemRepository::checkChatVendedor($this->usuario, $contato->usuario);
            $url = route('sistema.dash.vendedor.mensagens');
        } else {
            $chat = MensagemRepository::checkChat($this->usuario, $contato->usuario);
            $url = route('sistema.dash.comprador.mensagens');
        }

        return response()->json(['chat' => $chat, 'url' => $url]);
    }
}
