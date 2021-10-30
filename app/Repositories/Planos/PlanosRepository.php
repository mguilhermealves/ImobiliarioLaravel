<?php

namespace App\Repositories\Planos;

use App\Http\Requests\Sistema\Painel\PagamentoRequest;
use App\Models\Plano;
use App\Models\Empresa;
use Carbon\Carbon;

class PlanosRepository
{
    public static function all()
    {
        return Plano::orderBy('prioridade', 'asc')->get();
    }

    public static function plano(Int $id)
    {
        return Plano::find($id);
    }

    public static function planoByCode(String $id)
    {
        return Plano::where('codigo_gateway', $id)->first();
    }

    public static function outros(Empresa $empresa)
    {
        return Plano::where('id', '!=', $empresa->plano->id)->where('valor', '>', 0)->get();
    }

    public static function pagarCC(Empresa $empresa, PagamentoRequest $request)
    {
        self::atualizaPlanoEmpresa($empresa, $request);

        return PagarmeRepository::cc($empresa, $request);
    }

    public static function pagarBoleto(Empresa $empresa, PagamentoRequest $request)
    {
        self::atualizaPlanoEmpresa($empresa, $request);

        return PagarmeRepository::boleto($empresa, $request);
    }

    public static function atualizaPlanoEmpresa(Empresa $empresa, PagamentoRequest $request)
    {
        $empresa->novo_plano_id = self::planoByCode($request->plano_id)->id;
        $empresa->save();
    }

    public static function atualizaAssinatura(Empresa $empresa, Object $resposta)
    {
        $empresa->assinatura_id = $resposta->id;
        $empresa->save();
    }

    public static function atualizaAssinaturaGratis(Empresa $empresa, $idplano)
    {   
        $dias = 60;
        $empresa->validade_plano = Carbon::now()->addDays($dias);
        $empresa->plano_id = self::planoByCode($idplano)->id;
        $empresa->inicio_teste = Carbon::now();
        $empresa->save();
    }

    public static function atualizaBoleto(Empresa $empresa, Object $resposta)
    {   
        $empresa->boleto = $resposta->current_transaction->boleto_url;
        $empresa->save();
    }

    public static function atualizaValidade(Empresa $empresa)
    {
        $dias = self::pegaDias($empresa);
        $empresa->validade_plano = Carbon::now()->addDays($dias);
        $empresa->plano_id = $empresa->novo_plano_id;
        $empresa->novo_plano_id = null;
        $empresa->boleto = null;
        $empresa->save();
    }

    private static function pegaDias(Empresa $empresa)
    {
        return $empresa->novoPlano->dias;
    }

    public static function getFree()
    {
        return Plano::where('valor', 0)->first();
        // return Plano::find(3);
    }

    public static function maiores()
    {
        return Plano::where('logo', 1)->orderBy('valor', 'desc')->get();
    }

    public static function cancelar(Empresa $empresa)
    {
        PagarmeRepository::cancelar($empresa);
        $empresa->plano_id = self::getFree()->id;
        $empresa->novo_plano_id = null;
        $empresa->boleto = null;
        $empresa->save();
    }
}
