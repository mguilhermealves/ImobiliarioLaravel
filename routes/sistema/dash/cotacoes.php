<?php

  Route::group([
    'prefix' => '/dash/vendedor/cotacoes',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.cotacoes',
        'uses' => 'Sistema\Dash\CotacoesController@index',
      ]);
      Route::post('/{empresa}/{cotacao}', [
        'as' => 'sistema.dash.vendedor.cotacao',
        'uses' => 'Sistema\Dash\CotacoesController@cotacao',
      ]);
      Route::post('/{empresa}/{cotacao}/responder', [
        'as' => 'sistema.dash.vendedor.cotacao.responder',
        'uses' => 'Sistema\Dash\CotacoesController@responderCotacao',
      ]);
      Route::post('/{empresa}/{produto}/todas', [
        'as' => 'sistema.dash.vendedor.cotacao.todas',
        'uses' => 'Sistema\Dash\CotacoesController@todas',
      ]);
      Route::post('/{empresa}/{produto}/responder-todas', [
        'as' => 'sistema.dash.vendedor.cotacao.responder.todas',
        'uses' => 'Sistema\Dash\CotacoesController@responderTodas',
      ]);
      Route::post('/mensagem/{mensagem}/mensagens', [
        'as' => 'sistema.dash.vendedor.cotacao.mensagens',
        'uses' => 'Sistema\Dash\CotacoesController@mensagens',
      ]);
      Route::post('/mensagem/responder/{mensagem}', [
        'as' => 'sistema.dash.vendedor.cotacoes.mensagem.responder',
        'uses' => 'Sistema\Dash\CotacoesController@responder',
      ]);
      Route::post('/cotacao/{cotacao}/finaliza', [
        'as' => 'sistema.dash.vendedor.cotacoes.finalizar',
        'uses' => 'Sistema\Dash\CotacoesController@finalizar',
      ]);
  });
