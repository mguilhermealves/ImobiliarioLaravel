<?php

  Route::group([
    'prefix' => '/dash',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/contatos', [
        'as' => 'sistema.dash.contatos',
        'uses' => 'Sistema\Dash\ContatosController@index',
      ]);
      Route::get('/contatos/modal', [
        'as' => 'sistema.dash.contatos.modal',
        'uses' => 'Sistema\Dash\ContatosController@modal',
      ]);
      Route::get('/vendedor/contatos', [
        'as' => 'sistema.dash.vendedor.contatos',
        'uses' => 'Sistema\Dash\ContatosController@index',
      ]);
      Route::post('/contatos/{usuario}/adicionar', [
        'as' => 'sistema.dash.contato.adicionar',
        'uses' => 'Sistema\Dash\ContatosController@adicionar',
      ]);
      Route::post('/contatos/{contato}/bloquear', [
        'as' => 'sistema.dash.contato.bloquear',
        'uses' => 'Sistema\Dash\ContatosController@bloquear',
      ]);
      Route::delete('/contatos/{contato}/excluir', [
        'as' => 'sistema.dash.contato.excluir',
        'uses' => 'Sistema\Dash\ContatosController@excluir',
      ]);
      Route::post('/contato/nova/{contato}', [
        'as' => 'sistema.dash.contato.novamensagem',
        'uses' => 'Sistema\Dash\ContatosController@nova',
      ]);
  });
