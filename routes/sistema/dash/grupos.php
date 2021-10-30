<?php

  Route::group([
    'prefix' => '/dash/vendedor/grupos-e-subgrupos',
    'middleware' => ['auth.usuarios', 'dash'],
  ], function () {
      Route::get('/', [
        'as' => 'sistema.dash.vendedor.produtos.grupos',
        'uses' => 'Sistema\Dash\GruposController@grupos',
      ]);
      Route::get('/grupos', [
        'as' => 'sistema.dash.vendedor.produtos.grupos.get',
        'uses' => 'Sistema\Dash\GruposController@gruposGet',
      ]);
      Route::get('/grupos/grupo/{empresaGrupo}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo',
        'uses' => 'Sistema\Dash\GruposController@grupo',
      ]);
      Route::post('/{empresa}/grupos', [
        'as' => 'sistema.dash.vendedor.produtos.grupos.adicionar',
        'uses' => 'Sistema\Dash\GruposController@grupoAdicionar',
      ]);
      Route::put('/{empresa}/grupos', [
        'as' => 'sistema.dash.vendedor.produtos.grupos.salvar',
        'uses' => 'Sistema\Dash\GruposController@grupoSalvar',
      ]);
      Route::post('/{empresa}/{empresaSubgrupo}/subgrupos', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.sub.adicionar',
        'uses' => 'Sistema\Dash\GruposController@subgrupoAdicionar',
      ]);
      Route::put('/{empresaGrupo}/{empresaSubgrupo}/salvar', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.sub.salvar',
        'uses' => 'Sistema\Dash\GruposController@subgrupoSalvar',
      ]);
      Route::get('vinculados/{empresa}/{empresaGrupo}/{empresaSubgrupo?}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.vinculados',
        'uses' => 'Sistema\Dash\GruposController@grupoVinculados',
      ]);
      Route::post('/vincular/{empresa}/{empresaGrupo}/{empresaSubgrupo?}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.vincular',
        'uses' => 'Sistema\Dash\GruposController@grupoVincular',
      ]);
      Route::post('/desvincular/{empresa}/{empresaGrupo}/{empresaSubgrupo?}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.desvincular',
        'uses' => 'Sistema\Dash\GruposController@grupoDesvincular',
      ]);
      Route::get('/{empresa}/subgrupo/{empresaSubgrupo}/get', [
        'as' => 'sistema.dash.vendedor.produtos.subgrupo',
        'uses' => 'Sistema\Dash\GruposController@subgrupo',
      ]);
      Route::put('/{empresa}/{empresaSubgrupo}/subgrupos', [
        'as' => 'sistema.dash.vendedor.produtos.subgrupos.salvar',
        'uses' => 'Sistema\Dash\GruposController@subgrupoSalvar',
      ]);
      Route::delete('/apagar/{empresa}/{empresaGrupo}/{empresaSubgrupo?}', [
        'as' => 'sistema.dash.vendedor.produtos.grupos.apagar',
        'uses' => 'Sistema\Dash\GruposController@grupoApagar',
      ]);
      Route::post('/exibir/{empresa}/{empresaGrupo}', [
        'as' => 'sistema.dash.vendedor.produtos.grupos.exibir',
        'uses' => 'Sistema\Dash\GruposController@grupoExibir',
      ]);
      Route::get('/destaques/{empresa}/{empresaGrupo}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.destacados',
        'uses' => 'Sistema\Dash\GruposController@grupoDestacados',
      ]);
      Route::post('/destacar/{empresa}/{empresaGrupo}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.destacar',
        'uses' => 'Sistema\Dash\GruposController@grupoDestacar',
      ]);
      Route::post('/remover-destaque/{empresa}/{empresaGrupo}', [
        'as' => 'sistema.dash.vendedor.produtos.grupo.remover-destaque',
        'uses' => 'Sistema\Dash\GruposController@grupoRemoverDestaque',
      ]);
  });
