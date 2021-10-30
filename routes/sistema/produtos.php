<?php

  Route::group([
    'prefix' => '/',
    'middleware' => 'auth.usuarios',
  ], function () {
      Route::get('/produto/{produtoSlug}/cotacao', [
        'as' => 'sistema.produto.cotacao',
        'uses' => 'Sistema\ProdutosController@cotacao',
      ]);
      Route::post('/produto/{produtoSlug}/cotacao', [
        'as' => 'sistema.produto.cotacao.enviar',
        'uses' => 'Sistema\ProdutosController@enviaCotacao',
      ]);
      Route::post('/produto/{produtoSlug}/favorito', [
        'as' => 'sistema.produto.favorito.add',
        'uses' => 'Sistema\ProdutosController@addFavorito',
      ]);
      Route::post('/produto/{produtoSlug}/remove-favorito', [
        'as' => 'sistema.produto.favorito.del',
        'uses' => 'Sistema\ProdutosController@delFavorito',
      ]);
  });
