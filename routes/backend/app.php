<?php
Route::group([
  'prefix' => '/backend',
], function () {
    Route::get('/', [
      'as' => 'backend.index',
      'uses' => 'Backend\AppController@index',
    ]);

    Route::get('/login', [
      'as' => 'backend.form',
      'uses' => 'Backend\LoginController@Form',
    ]);

    Route::post('/login', [
      'as' => 'backend.login',
      'uses' => 'Backend\LoginController@Index',
    ]);
});

Route::group([
  'middleware' => 'auth.backend',
  'prefix' => '/backend',
], function () {
    Route::post('/cities', [
      'as' => 'backend.cities',
      'uses' => 'Backend\AppController@cities',
    ]);
    Route::get('/produto/{produto}/imagens', [
      'as' => 'backend.produto.imagens',
      'uses' => 'Backend\Produtos\ProdutoController@imagens',
    ]);

    Route::post('/produto/{produto}/imagens/upload', [
      'as' => 'backend.produtos.produto.imagem',
      'uses' => 'Backend\Produtos\ProdutoController@upload',
    ]);

    Route::post('/produto/{produto}/imagens/apagar', [
      'as' => 'backend.produtos.produto.imagem.apagar',
      'uses' => 'Backend\Produtos\ProdutoController@apagar',
    ]);

    Route::get('/modulo/categoria/{categoria}/{model}', [
      'as' => 'backend.categorias.subs',
      'uses' => 'Backend\AppController@subModulo',
    ]);

    Route::get('/modulo/subcategoria/{subcategoria}/{model}', [
      'as' => 'backend.categorias.grupos',
      'uses' => 'Backend\AppController@subModulo',
    ]);

    Route::get('/home', [
      'as' => 'backend.home',
      'uses' => 'Backend\HomeController@index',
    ]);

    Route::get('/sair', [
      'as' => 'sair',
      'uses' => 'Backend\LoginController@Sair',
    ]);

    Route::post('/upload', [
      'as' => 'backend.ajax.upload',
      'uses' => 'Backend\ImageController@Upload',
    ]);

    Route::post('/load', [
      'as' => 'backend.ajax.load',
      'uses' => 'Backend\ImageController@Load',
    ]);

    Route::delete('/delete', [
      'as' => 'backend.ajax.delete',
      'uses' => 'Backend\ImageController@Delete',
    ]);

    Route::get('/modulo/{model}/{acao?}', [
      'as' => 'backend.model',
      'uses' => 'Backend\AppController@Modulo',
    ]);

    Route::post('/{model}', [
      'as' => 'backend.adicionar',
      'uses' => 'Backend\AppController@Inserir',
    ]);

    Route::post('/{model}/save', [
      'as' => 'backend.salvar',
      'uses' => 'Backend\AppController@Alterar',
    ]);

    Route::post('/reordenar/{model}', [
      'as' => 'backend.reordenar',
      'uses' => 'Backend\AppController@Reordenar',
    ]);

    Route::get('/get/{model}/{action?}', [
      'as' => 'backend.get',
      'uses' => 'Backend\AppController@Get',
    ]);

    Route::get('/getsub/{model}/{pai}/{id}', [
      'as' => 'backend.get.sub',
      'uses' => 'Backend\AppController@getSub',
    ]);

    Route::get('/{model}/{id}/{action?}', [
      'as' => 'backend.editar',
      'uses' => 'Backend\AppController@Objeto',
    ]);

    Route::delete('/{model}/{id}', [
      'as' => 'backend.apagar',
      'uses' => 'Backend\AppController@Apagar',
    ]);
});
