<?php

  Route::group([
    'prefix' => '/dash/vendedor/produtos',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.produtos',
        'uses' => 'Sistema\Dash\ProdutosController@index',
      ]);
      Route::get('/novo', [
        'as' => 'sistema.dash.vendedor.produtos.novo',
        'uses' => 'Sistema\Dash\ProdutosController@novo',
      ]);
      Route::post('/pesquisa', [
        'as' => 'sistema.dash.vendedor.produtos.novo.pesquisa',
        'uses' => 'Sistema\Dash\ProdutosController@pesquisaCategorias',
      ]);
      Route::post('/get-sub', [
        'as' => 'sistema.dash.vendedor.produtos.get-sub',
        'uses' => 'Sistema\Dash\ProdutosController@getSub',
      ]);
      Route::post('/get-grupo', [
        'as' => 'sistema.dash.vendedor.produtos.get-grupo',
        'uses' => 'Sistema\Dash\ProdutosController@getGrupo',
      ]);
      Route::post('/novo-dados', [
        'as' => 'sistema.dash.vendedor.produtos.novo.dados',
        'uses' => 'Sistema\Dash\ProdutosController@novoDados',
      ]);
      Route::post('/novo', [
        'as' => 'sistema.dash.vendedor.produtos.novo.gravar',
        'uses' => 'Sistema\Dash\ProdutosController@novoGravar',
      ]);
      Route::get('/{produtoSlugDash}/editar', [
        'as' => 'sistema.dash.vendedor.produto.editar',
        'uses' => 'Sistema\Dash\ProdutosController@editar',
      ]);
      Route::post('/{produtoSlugDash}/editar', [
        'as' => 'sistema.dash.vendedor.produto.salvar',
        'uses' => 'Sistema\Dash\ProdutosController@salvar',
      ]);
      Route::delete('/{produto}/apagar', [
        'as' => 'sistema.dash.vendedor.produto.apagar',
        'uses' => 'Sistema\Dash\ProdutosController@apagar',
      ]);
      Route::post('/{produto}/duplicar', [
        'as' => 'sistema.dash.vendedor.produto.duplicar',
        'uses' => 'Sistema\Dash\ProdutosController@clona',
      ]);
      Route::get('/banco-de-fotos', [
        'as' => 'sistema.dash.vendedor.produtos.banco',
        'uses' => 'Sistema\Dash\ProdutosController@banco',
      ]);
      Route::delete('/banco-de-fotos', [
        'as' => 'sistema.dash.vendedor.produtos.banco.apagar',
        'uses' => 'Sistema\Dash\ProdutosController@bancoApagar',
      ]);
      Route::get('/mensagem-categoria', [
        'as' => 'sistema.dash.vendedor.produtos.categorias.mensagem',
        'uses' => 'Sistema\Dash\ProdutosController@mensagemCategoria',
      ]);
      Route::post('/mensagem-categoria', [
        'as' => 'sistema.dash.vendedor.produtos.categorias.mensagem.enviar',
        'uses' => 'Sistema\Dash\ProdutosController@mensagemCategoriaEnviar',
      ]);
  });
