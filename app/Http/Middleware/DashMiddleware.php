<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Repositories\Cotacoes\CotacaoRepository;
use App\Repositories\Mensagens\MensagemRepository;

class DashMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {                       
        $usuario = Auth('sistema')->user();
        
        // if ($request->is('dash/comprador*')) {
        //     $usuario = Auth('sistema')->user();
        //     View::share('nmensagens', MensagemRepository::novasMensagens($usuario));
        //     View::share('ncotacoes', CotacaoRepository::novasMensagensCotacao($usuario));
        //     View::share('nmensagensC', MensagemRepository::novasMensagens($usuario));
        //     View::share('ncotacoesC', CotacaoRepository::novasMensagensCotacao($usuario));                               
        // }
        // if ($request->is('dash/vendedor*')) {
        //     $usuario = Auth('sistema')->user();
        //     View::share('nmensagens', MensagemRepository::novasMensagensVendedor($usuario));
        //     View::share('ncotacoes', CotacaoRepository::novasVendedor($usuario));           
        //     View::share('nmensagensV', MensagemRepository::novasMensagensVendedor($usuario));
        //     View::share('ncotacoesV', CotacaoRepository::novasVendedor($usuario)); 
        //     // View::share('respostarRFQ', CotacaoRepository::novasMensagensCotacao($usuario));           
        // }
        // if ($request->is('dash/contatos*')) {
        //     View::share('nmensagens', 0);
        //     View::share('ncotacoes', 0);
        // }
        // View::share('novaMsgRfqPanelVendedor', CotacaoRepository::novaMsgRfqPanelVendedor($usuario));
        // View::share('novaMsgRfqPanelComprador', CotacaoRepository::novaMsgRfqPanelComprador($usuario));

        return $next($request);
    }
}
