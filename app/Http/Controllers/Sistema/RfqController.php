<?php

namespace App\Http\Controllers\Sistema;

use App\Models\Rfq;
use App\Models\Empresa;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Sistema\SistemaService;
use App\Repositories\Cotacoes\RfqRepository;
use App\Repositories\Sistema\BaseRepository;
use App\Http\Requests\Sistema\Rfq\NovoRfqRequest;
use App\Repositories\Empresas\EmpresasRepository;
use App\Repositories\Unidades\UnidadesRepository;
use App\Repositories\Mensagens\MensagemRepository;
use App\Http\Requests\Sistema\Rfq\RfqRespostaRequest;
use App\Repositories\Categorias\CategoriasRepository;
use App\Http\Requests\Sistema\Fornecedores\MensagemRequest;

class RfqController extends Controller
{
    public function index(Categoria $categoria = null, Request $request)
    {
        $rfqs = RfqRepository::get($categoria, $request);
        $titulo = 'Últimas Solicitações';
        if ($categoria != null) {
            $titulo = 'Últimas Solicitações da categoria <span class="text-orange">' . $categoria->nome . '</span>';
        }
        if ($request->termo) {
            $titulo = 'Últimas solicitações com o termo <span class="text-orange">' . $request->termo . '</span>';
        }

        return view('sistema.rfq.cotacoes', [
          'titulo' => $titulo,
          'lista' => $rfqs,
          'empresas' => EmpresasRepository::getDestaquesHome(),
          'title' => 'RFQ'
        ]);
    }

    public function como()
    {
        return view('sistema.rfq.como', [
          'como' => RfqRepository::como(),
          'title' => 'RFQ / Como Funciona'
        ]);
    }

    public function detalhes(Rfq $item)
    {
        return view('sistema/rfq/detalhes', [
          'titulo' => 'Detalhes da cotação global',
          'subtitulo' => 'Confira abaixo todos os detalhes desta cotação',
          'item' => $item,
          'resposta' => RfqRepository::checkResposta($item, $this->usuario->empresa ?? new Empresa()),
          'produtos' => Auth::guard('sistema')->check() == true ? BaseRepository::toSelect($this->usuario->empresa->produtos) : null,
          'unidades' => BaseRepository::toSelect(UnidadesRepository::all()),
          'title' => 'RFQ Detalhes /'.$item->termo
        ]);
    }

    public function nova(Request $request)
    {       
           

        $unidades = UnidadesRepository::all();        
        return view('sistema.rfq.nova-cotacao', [
          'titulo' => 'Uma solicitação, várias cotações!',
          'subtitulo' => 'Envie sua cotação para vários fornecedores ao mesmo tempo',
          'termo' => $request->termo,
          'quantidade' => $request->quantidade,
          'unidade' => $request->unidade,
          'unidades' => BaseRepository::toSelect($unidades),
          'categorias' => BaseRepository::toSelect(CategoriasRepository::all()),
          'title' => 'RFQ - Nova Cotação'
        ]);
    }

    public function anexar(Rfq $item, Request $request)
    {
        return RfqRepository::anexar($item, $request);
    }

    public function salvar(NovoRfqRequest $request)
    {
        RfqRepository::salvar($this->usuario->empresa, $request);

        return SistemaService::jsonR(200, 1, 'Solicitação enviada com sucesso!<br>Os fornecedores compatíveis com os critérios informados já foram avisados e em breve você receberá respostas.', route('sistema.index'));
    }

    public function check(Rfq $item)
    {
        if (!RfqRepository::check($item)) {
            return SistemaService::jsonR(200, 0, 'Infelizmente o limite de cotações para este item já foi atingido!<br>Por favor, selecione outro item.', 0);
        }
        if (!RfqRepository::checkResposta($item, $this->usuario->empresa)) {
            return SistemaService::jsonR(200, 0, 'Sua empresa já respondeu a esta cotação!', 0);
        }

        return SistemaService::jsonR(200, 1, 'Ok, vamos preparar a resposta da cotação para você!', route('sistema.dash.vendedor.rfqs'));
    }

    public function responder(Rfq $item, RfqRespostaRequest $request)
    {
        $resposta = RfqRepository::responder($item, $request);
        $msg = MensagemRepository::criaMensagem($this->usuario, $item->empresa->usuario, null, $resposta);
        $mRequest = new MensagemRequest();
        $mRequest->mensagem = $item->informacoes;
        MensagemRepository::criaMensagemItem($msg, $resposta->fornecedor->usuario, $mRequest);
        $mRequest->mensagem = 'Segue a resposta de sua cotação! Qualquer dúvida, por favor, escreva aqui.';
        MensagemRepository::criaMensagemItem($msg, $item->empresa->usuario, $mRequest);
        $mRequest->mensagem = $resposta->adicionais . $resposta->proposta;
        MensagemRepository::criaMensagemItem($msg, $item->empresa->usuario, $mRequest);

        return SistemaService::jsonR(200, 1, 'Resposta enviada com sucesso!<br>Você poderá acompanhar esta resposta em seu Dashboard, no menu "88 Market".', route('sistema.rfq.index'));
    }




}
