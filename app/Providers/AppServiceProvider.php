<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Rfq;
use App\Models\Rfqresposta;
use App\Models\Cotacao;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Mensagemitem;
use App\Models\Empresa;
use App\Observers\RfqObserver;
use App\Observers\RfqRespostaObserver;
use App\Observers\CotacaoObserver;
use App\Observers\ProdutoObserver;
use App\Observers\UsuarioObserver;
use App\Observers\EmpresaObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Observers\MensagemItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      // if (env('APP_ENV') === 'production') {
      //   $this->app['request']->server->set('HTTPS', true);
      // }
      //URL::forceScheme('http');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        ini_set('display_errors', '0');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.UTF-8', 'pt_BR.utf8', 'portuguese');
        $faker = \Faker\Factory::create('pt_BR');
        require_once app_path('Macros/Functions.php');
        $url = $this->app['url'];
        $url->forceRootUrl(config('app.url'));
        Carbon::setLocale('pt_BR');
        Usuario::observe(UsuarioObserver::class);
        Cotacao::observe(CotacaoObserver::class);
        Rfq::observe(RfqObserver::class);
        RfqResposta::observe(RfqRespostaObserver::class);
        Produto::observe(ProdutoObserver::class);
        Mensagemitem::observe(MensagemItemObserver::class);
        Empresa::observe(EmpresaObserver::class);
        // URL::forceScheme('https');
        // if (!\App::environment('local')) {
        //   URL::forceScheme('https');
        // }
    }
}
