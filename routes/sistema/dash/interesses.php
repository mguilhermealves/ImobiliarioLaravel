<?php

  Route::group([
    'prefix' => '/dash/comprador/lista-de-interesses',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.interesses',
        'uses' => 'Sistema\Dash\InteressesController@index',
      ]);
  });
