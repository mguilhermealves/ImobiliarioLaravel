<?php

namespace App\Traits\Sistema;

use auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Repositories\Categorias\CategoriasRepository;
use App\Repositories\Cotacoes\CotacaoRepository;
use App\Repositories\Mensagens\MensagemRepository;
use App\Repositories\Home\HomeRepository;
use App\Repositories\Geral\GeralRepository;
use App\Repositories\Noticias\NoticiasRepository;
use App\Repositories\CursosPalestras\CursosPalestrasRepository;

trait Handler
{
    protected $user;
    protected $categorias;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $this->usuario = auth('sistema')->user();  

            View::share('usuario', $this->usuario);       

            return $next($request);
        });

       
       
        // $homeconfig = HomeRepository::getHomeConfig();
        // $geral = GeralRepository::getGeral();
        // $emailsgeral = json_decode($geral->emails,true);
        // $numeros = json_decode($homeconfig->numeros,true);
        // $maislidas = NoticiasRepository::maisLidas();
        // $palestras = CursosPalestrasRepository::homeList();

        

        // View::share('homeconfig', $homeconfig);
        // View::share('geral', $geral);
        // View::share('numeros',  $numeros);
        // View::share('maislidas',  $maislidas);
        // View::share('palestras',  $palestras);
        // View::share('emailsgeral',  $emailsgeral);
        
        View::share('titulo', '');
       
    }

    /**
     * Share with view
     *
     * @param Request $request
     * @return void
     */
    private function share(Request $request)
    {
    }
}
