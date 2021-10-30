<?php

namespace App\Providers;

use App\Models\Grupo;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Contato;
use App\Models\Cotacao;
use App\Models\Empresacertificado;
use App\Models\Empresagrupo;
use App\Models\Empresasubgrupo;
use App\Models\Mensagem;
use App\Models\Rfq;
use App\Models\Rfqresposta;
use App\Models\Subcategoria;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $url = $this->app['url'];

        /* BACKEND */

        Route::bind(
          'model',
          function ($handle) {
              $model = 'App\Models\\' . ucfirst($handle);

              return new $model();
          }
        );

        Route::bind(
          'pai',
          function ($handle) {
              $model = 'App\Models\\' . ucfirst($handle);

              return new $model();
          }
        );

        Route::bind(
          'categoria',
          function ($handle) {
              return Categoria::find($handle);
          }
        );

        Route::bind(
          'subcategoria',
          function ($handle) {
              return Subcategoria::find($handle);
          }
        );

        /* FRONT  */

        Route::bind(
          'produto',
          function ($handle) {
              return Produto::find($handle);
          }
        );

        Route::bind(
          'categoriaSlug',
          function ($handle) {
              return Categoria::where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'subSlug',
          function ($handle, $route) {
              $cat = $route->parameter('categoriaSlug');

              return Subcategoria::where('categoria_id', $cat->id)->where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'grupoSlug',
          function ($handle, $route) {
              $sub = $route->parameter('subSlug');

              return Grupo::where('subcategoria_id', $sub->id)->where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'produtoSlug',
          function ($handle) {
              return Produto::where('slug', $handle)->where('status', 1)->first() ?? abort(404);
          }
        );

        Route::bind(
          'produtoSlugDash',
          function ($handle) {
              return Produto::where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'empresa',
          function ($handle) {
              return Empresa::find($handle);
          }
        );

        Route::bind(
          'empresaSlug',
          function ($handle) {
              return Empresa::where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'empresaGrupo',
          function ($handle) {
              return Empresagrupo::find($handle);
          }
        );

        Route::bind(
          'empresaSubgrupo',
          function ($handle) {
              return Empresasubgrupo::find($handle);
          }
        );

        Route::bind(
          'empresagrupoSlug',
          function ($handle) {
              return Empresagrupo::where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'empresasubgrupoSlug',
          function ($handle, $route) {
              $cat = $route->parameter('empresagrupoSlug');

              return Empresasubgrupo::where('empresagrupo_id', $cat->id)->where('slug', $handle)->first() ?? abort(404);
          }
        );

        Route::bind(
          'cotacao',
          function ($handle) {
              return Cotacao::find($handle);
          }
        );

        Route::bind(
          'mensagem',
          function ($handle) {
              return Mensagem::find($handle);
          }
        );

        Route::bind(
          'usuario',
          function ($handle) {
              return Usuario::find($handle);
          }
        );

        Route::bind(
          'contato',
          function ($handle) {
              return Contato::find($handle);
          }
        );

        Route::bind(
          'rfq',
          function ($handle) {
              return Rfq::find($handle);
          }
        );

        Route::bind(
          'rfqresposta',
          function ($handle) {
              return Rfqresposta::find($handle);
          }
        );

        Route::bind(
          'certificado',
          function ($handle) {
              return Empresacertificado::find($handle);
          }
        );

        Route::bind(
          'usuarioSlug',
          function ($handle, $route) {
              $empresa = $route->parameter('empresaSlug');

              return Usuario::where('empresa_id', $empresa->id)->where('slug', $handle)->first() ?? abort(404);
          }
        );
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
          'middleware' => 'web',
          'namespace' => $this->namespace,
        ], function () {
            $files = glob(base_path('routes/backend/*.php'));
            foreach ($files as $file) {
                require $file;
            }
            $files = glob(base_path('routes/sistema/*'));
            foreach ($files as $file) {
                if (is_file($file)) {
                    require $file;
                } else {
                    $folder = glob($file . '/*');
                    foreach ($folder as $f) {
                        if (is_file($f)) {
                            require $f;
                        }
                    }
                }
            }
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
    }
}
