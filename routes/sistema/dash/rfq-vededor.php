<?php

  Route::group([
    'prefix' => '/dash/vendedor/meu-88market',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.rfqs',
        'uses' => 'Sistema\Dash\RfqController@index',
      ]);
      Route::post('/rfq/{empresa}/{rfqresposta}', [
        'as' => 'sistema.dash.vendedor.rfq',
        'uses' => 'Sistema\Dash\RfqController@rfq',
      ]);
      Route::post('/mensagem/{mensagem}/mensagens', [
        'as' => 'sistema.dash.vendedor.rfq.mensagens',
        'uses' => 'Sistema\Dash\RfqController@mensagens',
      ]);
  });
