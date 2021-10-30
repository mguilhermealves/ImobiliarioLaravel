<?php

  Route::group([
    'prefix' => '/fornecedor',
  ], function () {
      Route::get('/{empresaSlug}', [
        'as' => 'sistema.fornecedor',
        'uses' => 'Sistema\FornecedorController@index',
      ]);

      Route::get('/{empresaSlug}/perfil', [
        'as' => 'sistema.fornecedor.perfil',
        'uses' => 'Sistema\FornecedorController@fornecedorPerfil',
      ]);

      Route::get('/{empresaSlug}/produtos', [
        'as' => 'sistema.fornecedor.produtos',
        'uses' => 'Sistema\FornecedorController@fornecedorProdutos',
      ]);

      Route::get('/{empresaSlug}/produtos/{empresagrupoSlug}/{empresasubgrupoSlug?}', [
        'as' => 'sistema.fornecedor.produtos.grupo',
        'uses' => 'Sistema\FornecedorController@fornecedorProdutosGrupo',
      ]);
  });

  Route::group([
    'prefix' => '/fornecedor',
    'middleware' => 'auth.usuarios',
  ], function () {
      Route::post('/{empresaSlug}/mensagem', [
        'as' => 'sistema.fornecedor.mensagem',
        'uses' => 'Sistema\FornecedorController@mensagem',
      ]);
  });
