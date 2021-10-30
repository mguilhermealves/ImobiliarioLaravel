<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Mensagens\MensagemRepository;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;

class MensagensController extends Controller
{
    public function index()
    {
        return view('sistema.dash.vendedor.mensagens.index', [
          'mensagens' => MensagemRepository::mensagens($this->usuario),
          'title' => 'Painel de Controle - Vendedor - Mensagens'
        ]);
    }

    public function mensagem(Mensagem $mensagem)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDono($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }

            MensagemRepository::updateStatus($mensagem, $this->usuario);
            
           
          
            return view('sistema.parts.dash.mensagem', [
              'mensagem' => $mensagem,
            ])->render();
        }
    }

    public function responder(Mensagem $mensagem, MensagemRequest $request)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDono($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }

            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioOrigem, $request);

            return SistemaService::jsonR(200, 1, $mensagem->id, 0);
        }
    }

    public function indexComprador()
    {
        return view('sistema.dash.comprador.mensagens.index', [
          'mensagens' => MensagemRepository::mensagens($this->usuario),
          'title' => 'Painel de Controle - Comprador - Mensagens'
        ]);
    }

    public function mensagemComprador(Mensagem $mensagem)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDonoComprador($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }

            MensagemRepository::updateStatus($mensagem, $this->usuario);

            return view('sistema.parts.dash.mensagem', [
              'mensagem' => $mensagem,
            ])->render();
        }
    }

    public function responderComprador(Mensagem $mensagem, MensagemRequest $request)
    {
        if ($mensagem) {
            if (!MensagemRepository::checkDonoComprador($mensagem, $this->usuario)) {
                return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.mensagens'));
            }

            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioDestino, $request);

            return SistemaService::jsonR(200, 1, $mensagem->id, 0);
        }
    }

    public function anexar(Mensagem $mensagem, Request $request)
    {
        $anexo = MensagemRepository::anexar($mensagem, $request);
        $request = new MensagemRequest();
        $request['mensagem'] = $anexo;
        if ($mensagem->origem != $this->usuario->id) {
            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioOrigem, $request, 1);
        } else {
            MensagemRepository::criaMensagemItem($mensagem, $mensagem->usuarioDestino, $request, 1);
        }

        return SistemaService::jsonR(200, 1, $mensagem->id, 0);
    }
}
