<?php

  Route::group([
    'prefix' => '/rfq',
  ], function () {
      Route::get('/como-funciona', [
        'as' => 'sistema.rfq.como',
        'uses' => 'Sistema\RfqController@como',
      ]);
      Route::get('/{categoriaSlug?}', [
        'as' => 'sistema.rfq.index',
        'uses' => 'Sistema\RfqController@index',
      ]);
      Route::get('/cotacao/{rfq}/detalhes', [
        'as' => 'sistema.rfq.detalhes',
        'uses' => 'Sistema\RfqController@detalhes',
      ]);
  });

  Route::group([
    'prefix' => '/rfq',
    'middleware' => 'auth.usuarios',
  ], function () {
      Route::get('/cotacao/nova', [
        'as' => 'sistema.rfq.nova',
        'uses' => 'Sistema\RfqController@nova',
      ]);
      Route::post('/check-cotacao/{rfq}', [
        'as' => 'sistema.rfq.check',
        'uses' => 'Sistema\RfqController@check',
      ]);
      Route::post('/anexar/{rfq}', [
        'as' => 'sistema.rfq.anexar',
        'uses' => 'Sistema\RfqController@anexar',
      ]);
      Route::post('/nova-cotacao', [
        'as' => 'sistema.rfq.salvar',
        'uses' => 'Sistema\RfqController@salvar',
      ]);
      Route::post('/responder/{rfq}', [
        'as' => 'sistema.rfq.responder',
        'uses' => 'Sistema\RfqController@responder',
      ]);
  });
