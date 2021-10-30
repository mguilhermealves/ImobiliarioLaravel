<?php

  Route::group([
    'prefix' => '/dash/comprador/cotacoes',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.comprador.cotacoes',
        'uses' => 'Sistema\Dash\CotacoesController@indexComprador',
      ]);
      Route::post('/cotacao/{empresa}/{cotacao}', [
        'as' => 'sistema.dash.comprador.cotacao',
        'uses' => 'Sistema\Dash\CotacoesController@cotacaoComprador',
      ]);
      Route::post('/mensagem/{mensagem}/mensagens', [
        'as' => 'sistema.dash.comprador.cotacao.mensagens',
        'uses' => 'Sistema\Dash\CotacoesController@mensagensComprador',
      ]);
      Route::post('/mensagem/responder/{mensagem}', [
        'as' => 'sistema.dash.comprador.cotacoes.mensagem.responder',
        'uses' => 'Sistema\Dash\CotacoesController@responderComprador',
      ]);
      Route::post('/avaliar/{cotacao}', [
        'as' => 'sistema.dash.comprador.cotacoes.avaliar',
        'uses' => 'Sistema\Dash\CotacoesController@avaliar',
      ]);
  });
