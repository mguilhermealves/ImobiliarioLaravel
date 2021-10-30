<?php

  Route::group([
    'prefix' => '/painel',
    'middleware' => 'auth.usuarios',
  ], function () {
      Route::get('/perfil', [
        'as' => 'sistema.painel.perfil',
        'uses' => 'Sistema\Painel\PainelController@perfil',
      ]);

      Route::post('/perfil', [
        'as' => 'sistema.painel.perfil.alterar',
        'uses' => 'Sistema\Painel\PainelController@alterarPerfil',
      ]);

      Route::post('/empresa', [
        'as' => 'sistema.painel.empresa.alterar',
        'uses' => 'Sistema\Painel\PainelController@alterarEmpresa',
      ]);

      Route::get('/conta', [
        'as' => 'sistema.painel.conta',
        'uses' => 'Sistema\Painel\PainelController@conta',
      ]);

      Route::get('/plano', [
        'as' => 'sistema.painel.plano',
        'uses' => 'Sistema\Painel\PainelController@plano',
      ]);

      Route::post('/plano/forma', [
        'as' => 'sistema.painel.plano.forma',
        'uses' => 'Sistema\Painel\PainelController@planoForma',
      ]);

      Route::post('/plano/pagamento', [
        'as' => 'sistema.painel.plano.pagamento',
        'uses' => 'Sistema\Painel\PainelController@planoPagamento',
      ]);

      Route::get('/dashboard', [
        'as' => 'sistema.dashboard',
        'uses' => 'Sistema\Painel\PainelController@dash',
      ]);

      Route::get('/pagamento/boleto', [
        'as' => 'sistema.painel.plano.boleto',
        'uses' => 'Sistema\Painel\PainelController@boleto',
      ]);

      Route::post('/cancelar', [
        'as' => 'sistema.painel.plano.cancelar',
        'uses' => 'Sistema\Painel\PainelController@cancelar',
      ]);

      Route::get('/sair', [
        'as' => 'sistema.sair',
        'uses' => 'Sistema\Auth\AuthController@sair',
      ]);
  });
