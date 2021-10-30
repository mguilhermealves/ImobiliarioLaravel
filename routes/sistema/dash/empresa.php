<?php

  Route::group([
    'prefix' => '/dash/vendedor/empresa',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.empresa',
        'uses' => 'Sistema\Dash\EmpresaController@index',
      ]);
      Route::post('/', [
        'as' => 'sistema.dash.vendedor.empresa.salvar',
        'uses' => 'Sistema\Dash\EmpresaController@salvar',
      ]);
      Route::get('/meu-website', [
        'as' => 'sistema.dash.vendedor.website',
        'uses' => 'Sistema\Dash\WebsiteController@index',
      ]);
      Route::post('/meu-website', [
        'as' => 'sistema.dash.vendedor.website.salvar',
        'uses' => 'Sistema\Dash\WebsiteController@salvar',
      ]);
      Route::get('/vitrine', [
        'as' => 'sistema.dash.vendedor.vitrine',
        'uses' => 'Sistema\Dash\WebsiteController@vitrine',
      ]);
      Route::get('/vitrine/{empresa}/produtos', [
        'as' => 'sistema.dash.vendedor.vitrine.produtos',
        'uses' => 'Sistema\Dash\WebsiteController@vitrineProdutos',
      ]);
      Route::post('/vitrine/{empresa}/produtos', [
        'as' => 'sistema.dash.vendedor.vitrine.produtos.adicionar',
        'uses' => 'Sistema\Dash\WebsiteController@vitrineProdutosAdicionar',
      ]);
      Route::delete('/vitrine/{empresa}/{produto}', [
        'as' => 'sistema.dash.vendedor.vitrine.produtos.remover',
        'uses' => 'Sistema\Dash\WebsiteController@vitrineProdutosRemover',
      ]);
      Route::post('/certificados/{empresa}/adicionar', [
        'as' => 'sistema.dash.vendedor.empresa.certificados.adicionar',
        'uses' => 'Sistema\Dash\EmpresaController@certificadoAdicionar',
      ]);
      Route::post('/certificados/{empresa}', [
        'as' => 'sistema.dash.vendedor.empresa.certificados.apagar',
        'uses' => 'Sistema\Dash\EmpresaController@certificadoApagar',
      ]);
  });
