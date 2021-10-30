<?php

namespace App\Repositories\Mensagens;

use Carbon\Carbon;
use App\Models\Cotacao;
use App\Models\Usuario;
use App\Models\Mensagem;
use App\Models\Rfqresposta;
use App\Models\Mensagemitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;

class MensagemRepository
{
    public static function criaMensagem(Usuario $origem, Usuario $destino, Cotacao $cotacao = null, Rfqresposta $resposta = null)
    {
        $msg = new Mensagem();
        $msg->origem = $origem->id;
        $msg->destino = $destino->id;
        if ($cotacao != null) {
            $msg->cotacao_id = $cotacao->id;
        }
        if ($resposta != null) {
            $msg->rfqresposta_id = $resposta->id;
        }
        $msg->save();

        return $msg;
    }

    public static function criaMensagemItem(Mensagem $mensagem, Usuario $destino, MensagemRequest $request, Int $tipo = 0)
    {
        $item = new Mensagemitem();
        $item->mensagem_id = $mensagem->id;
        $item->tipo = $tipo;
        $item->mensagem = $request->mensagem;
        $item->destino = $destino->id;
        $item->status = 0;
        $item->save();
        self::updateMensagem($mensagem);
    }

    public static function mensagens(Usuario $usuario)
    {
        return $usuario->mensagens_recebidas
          ->where('cotacao_id', null)
          ->where('rfqresposta_id', null)
          ->sortByDesc('updated_at');
    }

    public static function checkDono(Mensagem $mensagem, Usuario $usuario)
    {
        if ($mensagem->destino != $usuario->id) {
            return false;
        }

        return true;
    }

    public static function mensagensComprador(Usuario $usuario)
    {
        return $usuario->mensagens_enviadas->where('cotacao_id', null)->sortByDesc('updated_at')->take(4);
    }

    public static function checkDonoComprador(Mensagem $mensagem, Usuario $usuario)
    {
        if ($mensagem->origem != $usuario->id) {
            return false;
        }

        return true;
    }

    public static function updateMensagem(Mensagem $mensagem)
    {
        $mensagem->updated_at = Carbon::now();
        $mensagem->save();
    }

    public static function updateStatus(Mensagem $mensagem, Usuario $usuario)
    {
        $mensagem->mensagens->where('destino', $usuario->id)->each(function ($m) {
            $m->status = 1;
            $m->save();
        });
    }

    public static function updateRfqRespostaLida($id)
    {
        Rfqresposta::where('id', $id)->each(function ($m) {
            $m->lida = 1;
            $m->save();
        });
    }

    public static function updateRfqRespostaNaoLida($id)
    {
        Rfqresposta::where('id', $id)->each(function ($m) {
            $m->lida = 0;
            $m->save();
        });
    }

    public static function anexar(Mensagem $mensagem, Request $request)
    {
        $nameFile = null;
        if ($request->hasFile('anexo') && $request->file('anexo')->isValid()) {
            $titulo = $request->anexo->getClientOriginalName();
            $name = uniqid(date('HisYmd'));
            $extension = $request->anexo->extension();
            $nameFile = $mensagem->id . '/' . $titulo;
            $upload = Storage::disk('mensagens')->put($nameFile, file_get_contents($request->anexo), 'public');
            if (!$upload) {
                return redirect()
            ->back()
            ->with('error', 'Falha ao fazer upload')
            ->withInput();
            }
            $anexo = Storage::disk('mensagens')->url($nameFile);

            return $anexo;
        }
    }

    public static function naoLidas(Usuario $usuario)
    {
        $mensagens = $usuario->mensagens_recebidas->where('cotacao_id', null);

        return $mensagens->where('status', 0)->count();
    }

    public static function novasMensagens(Usuario $usuario)
    {
        return Mensagem::with('mensagens')->whereHas('mensagens', function ($q) use ($usuario) {
            return $q->where('status', 0)->where('destino', $usuario->id);
        })  
      ->where('origem', $usuario->id)
      ->where('cotacao_id', null)
      ->where('rfqresposta_id', null)
      ->count();
    }

    public static function novasMensagensVendedor(Usuario $usuario)
    {
        return Mensagem::with('mensagens')->whereHas('mensagens', function ($q) use ($usuario) {
            return $q->where('status', 0)->where('destino', $usuario->id);
        })
      ->where('destino', $usuario->id)
      ->where('cotacao_id', null)
      ->where('rfqresposta_id', null)
      ->count();
    }

    public static function checkChatVendedor(Usuario $usuario, Usuario $origem)
    {
        $chat = $usuario->mensagens_recebidas
                  ->where('origem', $origem->id)
                  ->where('cotacao_id', null)
                  ->where('rfqresposta_id', null)
                  ->first();
        if (!$chat) {
            $msg = self::criaMensagem($origem, $usuario)->id;
        } else {
            $msg = $chat->id;
        }

        return $msg;
    }

    public static function checkChat(Usuario $usuario, Usuario $destino)
    {
        $chat = $usuario->mensagens_enviadas
                  ->where('destino', $destino->id)
                  ->where('cotacao_id', null)
                  ->where('rfqresposta_id', null)
                  ->first();
        if (!$chat) {
            $msg = self::criaMensagem($usuario, $destino)->id;
        } else {
            $msg = $chat->id;
        }

        return $msg;
    }

    public static function checkChatFront(Usuario $usuario, Usuario $destino)
    {
        $chat = $usuario->mensagens_enviadas
                  ->where('destino', $destino->id)
                  ->where('cotacao_id', null)
                  ->where('rfqresposta_id', null)
                  ->first();
        if (!$chat) {
            $msg = self::criaMensagem($usuario, $destino)->id;
        } else {
            $msg = $chat;
        }

        return $msg;
    }
}
