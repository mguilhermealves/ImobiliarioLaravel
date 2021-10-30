<?php

  Route::group([
    'prefix' => '/planos',
    'middleware' => 'auth.usuarios',
  ], function () {
      Route::post('/pagar', [
        'as' => 'sistema.painel.plano.pagar',
        'uses' => 'Sistema\Planos\PlanosController@pagar',
      ]);
  });
