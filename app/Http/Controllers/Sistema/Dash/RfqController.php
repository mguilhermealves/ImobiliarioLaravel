<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Models\Rfq;
use App\Models\Empresa;
use App\Models\Mensagem;
use App\Models\Rfqresposta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Sistema\SistemaService;
use App\Repositories\Cotacoes\RfqRepository;
use App\Repositories\Mensagens\MensagemRepository;
use App\Repositories\Unidades\UnidadesRepository;
use App\Repositories\Sistema\BaseRepository;
use App\Repositories\Categorias\CategoriasRepository;

class RfqController extends Controller
{
    public function index()
    {
        return view('sistema.dash.vendedor.rfq.index', [
          'rfqs' => RfqRepository::getVendedor($this->usuario->empresa),
          'fechadas' => RfqRepository::getVendedorFechadas($this->usuario->empresa),          
          'title' => 'Painel de Controle - Vendedor - Meu 88 Market'
        ]);
    }

    public function Rfq(Empresa $empresa, Rfqresposta $item)
    {
        if (!RfqRepository::checkVendedor($empresa, $item)) {
            return SistemaService::jsonR(200, 0, 'Você não tem permissão para isso!', 0);
        }

            MensagemRepository::updateRfqRespostaLida($item->id);
       
        return view('sistema.parts.dash.rfq-resposta-individual-vendedor', [
          'resposta' => $item,
        ]);
    }

    public function indexComprador()
    {
        return view('sistema.dash.comprador.rfq.index', [
          'rfqs' => RfqRepository::getComprador($this->usuario->empresa),
          'fechadas' => RfqRepository::getCompradorFechadas($this->usuario->empresa),
          'title' => 'Painel de Controle - Comprador - Meu 88 Market'
        ]);
    }

    public function rfqComprador(Empresa $empresa, Rfqresposta $item)
    {
        if (!RfqRepository::checkComprador($empresa, $item)) {
            return SistemaService::jsonR(200, 0, 'Você não tem permissão para isso!', 0);
        }

        RfqRepository::leResposta($item);

        return view('sistema.parts.dash.rfq-resposta-individual', [
          'resposta' => $item,
        ]);
    }

    public function editarRfq(Rfq $item)
    {              

        $unidades = UnidadesRepository::all();

        return view('sistema.parts.dash.rfq-editar', [
            'item' => $item,
            'unidades' => BaseRepository::toSelect($unidades),
            'categorias' => BaseRepository::toSelect(CategoriasRepository::all()),
            'subs' => BaseRepository::toSelect(CategoriasRepository::allSubs()),
            'grupos' => BaseRepository::toSelect(CategoriasRepository::allGrupos()),
          ]);
    }

    public function salvarrfq(Rfq $item, Request $request){

        RfqRepository::editar($request);

        return SistemaService::jsonR(200, 1, 'Cotação alterada com sucesso! <br>', route('sistema.dash.comprador.rfqs'));
    }

    public function mensagens(Mensagem $mensagem)
    {
        if (!MensagemRepository::checkDonoComprador($mensagem, $this->usuario)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        MensagemRepository::updateStatus($mensagem, $this->usuario);

        return view('sistema.parts.dash.mensagem-cotacao', [
          'mensagem' => $mensagem,
        ])->render();
    }

    public function mensagensComprador(Mensagem $mensagem)
    {
        if (!MensagemRepository::checkDono($mensagem, $this->usuario)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', route('sistema.dash.vendedor.cotacoes'));
        }

        MensagemRepository::updateStatus($mensagem, $this->usuario);

        return view('sistema.parts.dash.mensagem-cotacao', [
          'mensagem' => $mensagem,
        ])->render();
    }

    public function comparar(Rfq $item)
    {
        return view('sistema.parts.dash.rfq-multi', [
          'item' => $item,
        ]);
    }

    public function avaliar(Rfqresposta $item, Request $request)
    {
        if (!RfqRepository::checkComprador($this->usuario->empresa, $item)) {
            return SistemaService::jsonR(401, 0, 'Você não tem permissão para isso!', 0);
        }

        RfqRepository::avalia($item, $this->usuario, $request);

        return SistemaService::jsonR(200, 1, 'Cotação encerrada com sucesso!', 0);
    }
}
