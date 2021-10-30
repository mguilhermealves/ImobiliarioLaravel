<?php

  Route::group([
    'prefix' => '/',
  ], function () {
      Route::get('/', [
        'as' => 'sistema.index',
        'uses' => 'Sistema\AppController@index',
      ]);

      Route::get('/sobre-nos', [
        'as' => 'sistema.asserttem',
        'uses' => 'Sistema\AppController@sobre',
      ]);

      Route::get('/trabalho-temporario', [
        'as' => 'sistema.trabalho-temporario',
        'uses' => 'Sistema\AppController@trabalho',
      ]);

      Route::get('/juridico', [
        'as' => 'sistema.juridico',
        'uses' => 'Sistema\AppController@juridico',
      ]);

      Route::get('/duvidas-frequentes', [
        'as' => 'sistema.duvidas-frequentes',
        'uses' => 'Sistema\AppController@duvidas',
      ]);

      Route::get('/cursos-e-palestras', [
        'as' => 'sistema.cursos-palestras',
        'uses' => 'Sistema\AppController@cursospalestras',
      ]);

      Route::get('/curso-palestra/{slug}', [
        'as' => 'sistema.cursos-detalhes',
        'uses' => 'Sistema\AppController@cursodetalhes',
      ]);

      Route::get('/noticias', [
        'as' => 'sistema.noticias',
        'uses' => 'Sistema\AppController@noticias',
      ]);

      Route::get('/noticia/{slug}', [
        'as' => 'sistema.noticia',
        'uses' => 'Sistema\AppController@noticia',
      ]);

      Route::post('/salvar-inscricao', [
        'as' => 'sistema.salvar-inscricao',
        'uses' => 'Sistema\InscricaoCursoController@inscrever',
      ]);


      Route::get('/agencias-associadas', [
        'as' => 'sistema.agencias-associadas',
        'uses' => 'Sistema\AppController@agenciasassociadas',
      ]);


      Route::get('/politica-de-privacidade', [
        'as' => 'sistema.politica',
        'uses' => 'Sistema\AppController@politica',
      ]);

      Route::get('/termos-de-uso', [
        'as' => 'sistema.termos',
        'uses' => 'Sistema\AppController@termos',
      ]);

      Route::get('/categorias', [
        'as' => 'sistema.categorias.todas',
        'uses' => 'Sistema\AppController@todas',
      ]);

      Route::get('/categoria/{categoriaSlug}', [
        'as' => 'sistema.categoria',
        'uses' => 'Sistema\AppController@categoria',
      ]);

      Route::get('/categoria/{categoriaSlug}/{subSlug}', [
        'as' => 'sistema.categoria.sub',
        'uses' => 'Sistema\AppController@subCategoria',
      ]);

      Route::get('/categoria/{categoriaSlug}/{subSlug}/{grupoSlug}', [
        'as' => 'sistema.categoria.grupo',
        'uses' => 'Sistema\AppController@grupo',
      ]);

      Route::get('/produto/{produtoSlug}', [
        'as' => 'sistema.produto',
        'uses' => 'Sistema\ProdutosController@index',
      ]);

      Route::get('/busca', [
        'as' => 'sistema.busca',
        'uses' => 'Sistema\AppController@busca',
      ]);

      Route::get('/planos', [
        'as' => 'sistema.planos',
        'uses' => 'Sistema\AppController@planos',
      ]);

      Route::post('/assinaturas/resposta', [
        'as' => 'sistema.assinaturas.resposta',
        'uses' => 'Sistema\Planos\PlanosController@resposta',
      ]);

      Route::get('/fornecedor/{empresaSlug}/{usuarioSlug}/perfil', [
        'as' => 'sistema.usuarios.perfil',
        'uses' => 'Sistema\AppController@perfilUsuario',
      ]);

      Route::post('/newsletter', [
        'as' => 'sistema.newsletter',
        'uses' => 'Sistema\AppController@newsletter',
      ]);

      Route::get('/sou-comprador', [
        'as' => 'sistema.comprador',
        'uses' => 'Sistema\AppController@comprador',
      ]);

      Route::get('/sou-vendedor', [
        'as' => 'sistema.vendedor',
        'uses' => 'Sistema\AppController@vendedor',
      ]);

      Route::get('/faq', [
        'as' => 'sistema.faq',
        'uses' => 'Sistema\AppController@faq',
      ]);

      Route::get('/fale-conosco', [
        'as' => 'sistema.contato',
        'uses' => 'Sistema\AppController@contato',
      ]);

      Route::get('/corpo-diretivo', [
        'as' => 'sistema.corpo-diretivo',
        'uses' => 'Sistema\AppController@equipe',
      ]);

      Route::post('/fale-conosco', [
        'as' => 'sistema.contato.enviar',
        'uses' => 'Sistema\AppController@contatoEnviar',
      ]);

      Route::get('/resposta-agencias', [
        'as' => 'sistema.resposta-agencias',
        'uses' => 'Sistema\AppController@respostaAgencias',
      ]);

      Route::post('/cookiepopup', [
        'as' => 'sistema.cookiepopup',
        'uses' => 'Sistema\AppController@CookiePopup',
      ]);
  });
