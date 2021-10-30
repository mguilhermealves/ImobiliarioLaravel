<?php

  Route::group([
    'prefix' => '/dash/comprador/meu-88market',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.comprador.rfqs',
        'uses' => 'Sistema\Dash\RfqController@indexComprador',
      ]);
      Route::post('/rfq/editar-rfq/{rfq}', [
        'as' => 'sistema.dash.comprador.editarrfq',
        'uses' => 'Sistema\Dash\RfqController@editarRfq',
      ]);
      Route::post('/rfq/salvar-rfq', [
        'as' => 'sistema.dash.comprador.salvarrfq',
        'uses' => 'Sistema\Dash\RfqController@salvarrfq',
      ]);
      Route::post('/rfq/{empresa}/{rfqresposta}', [
        'as' => 'sistema.dash.comprador.rfq',
        'uses' => 'Sistema\Dash\RfqController@rfqComprador',
      ]);      
      Route::post('/mensagem/{mensagem}/mensagens', [
        'as' => 'sistema.dash.comprador.rfq.mensagens',
        'uses' => 'Sistema\Dash\RfqController@mensagensComprador',
      ]);
      Route::post('/comparar/{rfq}', [
        'as' => 'sistema.dash.comprador.rfq.comparar',
        'uses' => 'Sistema\Dash\RfqController@comparar',
      ]);
      Route::post('/avaliar/{rfqresposta}', [
        'as' => 'sistema.dash.comprador.rfq.avaliar',
        'uses' => 'Sistema\Dash\RfqController@avaliar',
      ]);
   
  });
