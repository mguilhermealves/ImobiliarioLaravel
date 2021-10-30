<?php

  Route::group([
    'prefix' => '/dash/vendedor/mensagens',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.mensagens',
        'uses' => 'Sistema\Dash\MensagensController@index',
      ]);
      Route::post('/{mensagem}', [
        'as' => 'sistema.dash.vendedor.mensagens.mensagem',
        'uses' => 'Sistema\Dash\MensagensController@mensagem',
      ]);
      Route::post('/{mensagem}/responder', [
        'as' => 'sistema.dash.vendedor.mensagens.mensagem.responder',
        'uses' => 'Sistema\Dash\MensagensController@responder',
      ]);
      Route::post('/{mensagem}/anexo', [
        'as' => 'sistema.dash.mensagem.anexo',
        'uses' => 'Sistema\Dash\MensagensController@anexar',
      ]);
  });
