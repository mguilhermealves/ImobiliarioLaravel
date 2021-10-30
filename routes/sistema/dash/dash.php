<?php

  Route::group([
    'prefix' => '/area-restrita',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.inicio',
        'uses' => 'Sistema\Dash\DashController@index',
      ]);

      Route::get('/meus-dados', [
        'as' => 'sistema.dash.meus-dados',
        'uses' => 'Sistema\Dash\DashController@meusdados',
      ]);

      Route::post('/meus-dados', [
        'as' => 'sistema.dash.alterarConta',
        'uses' => 'Sistema\Dash\DashController@alterarConta',
      ]);

  });
