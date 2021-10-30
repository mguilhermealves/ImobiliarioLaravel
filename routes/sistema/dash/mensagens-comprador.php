<?php

  Route::group([
    'prefix' => '/dash/comprador/mensagens',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.comprador.mensagens',
        'uses' => 'Sistema\Dash\MensagensController@indexComprador',
      ]);
      Route::post('/{mensagem}', [
        'as' => 'sistema.dash.comprador.mensagens.mensagem',
        'uses' => 'Sistema\Dash\MensagensController@mensagemComprador',
      ]);
      Route::post('/{mensagem}/responder', [
        'as' => 'sistema.dash.comprador.mensagens.mensagem.responder',
        'uses' => 'Sistema\Dash\MensagensController@responderComprador',
      ]);
  });
