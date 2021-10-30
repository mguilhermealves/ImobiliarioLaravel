<?php

Route::group([
  'prefix' => '/autenticacao',
], function () {
    Route::get('/', [
      'as' => 'sistema.auth',
      'uses' => 'Sistema\Auth\AuthController@login',
    ]);

    Route::get('/recuperar-senha', [
      'as' => 'sistema.auth.recuperar-senha',
      'uses' => 'Sistema\Auth\AuthController@recuperarSenha',
    ]);

    Route::post('/recuperar-senha', [
      'as' => 'sistema.auth.senha',
      'uses' => 'Sistema\Auth\AuthController@senha',
    ]);

    Route::get('/nova-senha/{usuario}/{token}', [
      'as' => 'sistema.auth.nova-senha',
      'uses' => 'Sistema\Auth\AuthController@novaSenha',
    ]);

    Route::post('/nova-senha/{usuario}/{token}', [
      'as' => 'sistema.auth.criar-senha',
      'uses' => 'Sistema\Auth\AuthController@criarSenha',
    ]);

    Route::post('/', [
      'as' => 'sistema.auth.login',
      'uses' => 'Sistema\Auth\AuthController@auth',
    ]);

    Route::get('/obrigado', [
      'as' => 'sistema.auth.obrigado',
      'uses' => 'Sistema\Auth\AuthController@cadastroFinalizado',
    ]);

    Route::get('/cadastro', [
      'as' => 'sistema.auth.cadastro',
      'uses' => 'Sistema\Auth\AuthController@cadastro',
    ]);

    Route::post('/cadastro', [
      'as' => 'sistema.auth.cadastrar',
      'uses' => 'Sistema\Auth\AuthController@cadastrar',
    ]);

   

    Route::get('/confirmacao/{usuario}/{token}', [
      'as' => 'sistema.auth.confirmar',
      'uses' => 'Sistema\Auth\AuthController@confirmar',
    ]);
});
