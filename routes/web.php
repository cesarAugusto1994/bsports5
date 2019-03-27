<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['namespace' => 'Auth'],function(){
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::middleware('loadCache')->group(function() {

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/', 'HomeController@index')->name('home_2');
  Route::get('/contato', 'HomeController@contato')->name('contato');
  Route::get('/classificacao', 'HomeController@classificacao')->name('classificacao');

  Route::get('/galerias', 'MidiasController@galerias')->name('galerias');
  Route::get('/galeria/{id}', 'MidiasController@galeria')->name('galeria');

  Route::get('/evento/{id}/{titulo}', 'EventoController@show')->name('evento');
  Route::get('/posts', 'NoticiasController@posts')->name('posts');
  Route::get('/noticia/{id}/{titulo}', 'NoticiasController@show')->name('noticia');

  Route::get('/jogador/{id}', 'JogadoresController@show')->name('jogador');

  Route::get('/pagina/{slug}/{id}', 'PaginasController@show')->name('pagina');
  Route::get('/paginas', 'PaginasController@index')->name('paginas');

  Route::get('/formulario/agendar', 'PartidasController@formularioAgenda')->name('formulario_agendar');
  Route::post('/formulario/agendar', 'PartidasController@formularioAgendaStore')->name('formulario_agendar_store');

  Route::get('/formulario/clube', 'HomeController@formularioClube')->name('formulario_clube');
  Route::post('/formulario/clube', 'HomeController@formularioClubeStore')->name('formulario_clube_store');

  Route::get('/resultados', 'ResultadosController@index')->name('resultados');
  Route::get('/calendario', 'CalendarioJogosController@index')->name('calendario');

  Route::get('/import-jogadores', 'HomeController@importJogadores')->name('import_jogadores');
  Route::get('/import-partidas', 'HomeController@importPartidas')->name('import_partidas');

  Route::get('/partidas/ajax', 'PartidasController@partidasAjax')->name('partidas_ajax');
  Route::get('jogadores/get-ajax', 'JogadoresController@toAjax')->name('jogadores_ajax');

  Route::get('/image/external', 'ImagensController@image')->name('image');

  Route::get('/partida/{id}/remover-jogador/{jogador}', 'PartidasController@removerJogador')->name('remover_jogador_partida');
  Route::get('/partida/{id}/trocar/jogador/{jogador}', 'PartidasController@trocarJogador')->name('trocar_jogador_partida');

  Route::get('/images', 'PropagandasController@images')->name('images');
  Route::get('/images/external', 'PropagandasController@externalImages')->name('external_images');
  Route::get('/images/storage', 'PropagandasController@storageImages')->name('storage_images');

  Route::group(['middleware' => 'auth'], function () {

  //  Route::group(['middleware' => 'checkrole'], function () {

  Route::get('/cep', 'JogadoresController@cep')->name('cep');

      Route::group(['middleware' => 'role:user|admin'], function () {
        Route::group(['prefix' => 'player'], function () {
            Route::get('/dashboard', 'PlayerController@index')->name('player_dashboard');
            Route::get('/', 'PlayerController@index')->name('player_index');
            Route::get('/profile/details', 'PlayerController@show')->name('player_details');
            //Route::get('/profile', 'PlayerController@show')->name('player');
            Route::resource('profile', 'PlayerController');

            Route::get('/appointment', 'PartidasController@agendamento')->name('player_agendar_partida');
            Route::get('/appointment/create', 'PartidasController@create')->name('player_create_partida');
            //Route::resource('perfil', 'PerfilController');
            Route::get('/mensalidade', 'JogadoresController@mensalidade')->name('player_mensalidade');
            Route::resource('partida', 'PartidasController');
            Route::resource('mensalidades', 'JogadorMensalidadesController');
            Route::resource('checkout', 'CheckoutController');
            Route::post('checkout/sale', 'CheckoutController@sale')->name('checkout_sale');

            Route::get('/appointment/{id}/match', 'PartidasController@agendar')->name('player_agendar_partida_jogador');
            Route::post('/appointment/{id}/match/store', 'PartidasController@agendarStore')->name('player_partida_jogador_store');
            Route::get('/appointment/ajax', 'PartidasController@listaPartidasAjax')->name('player_lista_partidas_ajax');
        });
      });

      Route::group(['middleware' => 'role:admin'], function () {
          Route::group(['prefix' => 'admin'], function () {
              Route::get('/dashboard', 'AdminController@index')->name('admin_dashboard');
              Route::get('/', 'AdminController@index')->name('admin_index');
              Route::get('/players/list', 'AdminController@jogadores')->name('admin_jogadores');
              Route::resource('players', 'JogadoresController');
              Route::resource('matches', 'PartidasController');
              Route::get('/appointment', 'PartidasController@agendamento')->name('agendar_partida');
              Route::get('/appointment/create', 'PartidasController@create')->name('create_partida');

              Route::get('/mensalidade', 'JogadoresController@mensalidade')->name('mensalidade');
              Route::get('/banner/link', 'BannersController@image')->name('banner_link');

              Route::get('/players/{id}/profile', 'JogadoresController@view')->name('player_profile');
              Route::resource('configs', 'ConfigsController');
              Route::resource('partida', 'PartidasController');
              Route::resource('jogadores', 'JogadoresController');
              Route::resource('mensalidades', 'JogadorMensalidadesController');
              Route::resource('categorias', 'CategoriasController');
              Route::resource('torneios', 'TorneiosController');
              Route::resource('quadras', 'QuadrasController');
              Route::resource('banners', 'BannersController');
              Route::resource('eventos', 'EventoController');
              Route::resource('noticias', 'NoticiasController');

              Route::resource('campeoes', 'CampeoesController');
              Route::resource('semestres', 'SemestreController');

              Route::resource('solicitacao', 'SolicitacaoPartidaController');
              Route::resource('midias', 'MidiasController');

              Route::resource('pagamentos', 'PagamentosController');

              Route::post('/pagamentos/{id}/informe-pagamento', 'PagamentosController@informe')->name('informe_pagamento');
              Route::get('/partidas/{id}/placar', 'PartidasController@placar')->name('partida_placar');
              Route::get('/partidas/{id}/placar/edit', 'PartidasController@editarPlacar')->name('editar_partida_placar');
              Route::post('/partida/{id}/placar/update', 'PartidasController@placarUpdate')->name('partida_placar_update');

              Route::get('mensalidades/create/from-categories', 'JogadorMensalidadesController@createFromCategories')->name('mensalidade_create_from_categories');

              Route::get('/appointment/{id}/match', 'PartidasController@agendar')->name('agendar_partida_jogador');
              Route::post('/appointment/{id}/match/store', 'PartidasController@agendarStore')->name('partida_jogador_store');

              Route::post('/partidas/{id}/trocar/jogador', 'PartidasController@trocarJogadorStore')->name('trocar_jogador_store');

              Route::get('/appointment/ajax', 'PartidasController@listaPartidasAjax')->name('lista_partidas_ajax');

              Route::post('/joagdores/inativar/em-massa', 'JogadoresController@inativarEmMassa')->name('jogadores_inativar_em_massa');

              Route::get('/joagdores/sem-partida', 'JogadoresController@semPartida')->name('jogadores_sem_partidas_marcadas');

              Route::post('/categorias/{id}/menu', 'CategoriasController@toMenu')->name('categoria_to_menu');

              Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

              Route::get('partidas/{id}/jogador/{jogador}/wo', 'PartidasController@wo')->name('wo');
              Route::get('partidas/{id}/jogador/{jogador}/desistencia', 'PartidasController@desistencia')->name('desistencia');

              Route::post('/partidas/{id}/wo/store', 'PartidasController@woStore')->name('wo_store');
              Route::post('/partidas/{id}/desistencia/store', 'PartidasController@desistenciaStore')->name('wo_desistencia');

              Route::resource('templates', 'TemplatesController');
              Route::resource('modelos', 'ModelosController');
              Route::resource('propagandas', 'PropagandasController');

              Route::resource('mailling', 'MaillingController');

              Route::get('/mailling/email/envio', 'MaillingController@envioEmail')->name('mailling_envio_email_clientes');
              Route::post('/mailling/{id}/send/email', 'MaillingController@sendEmail')->name('mailling_send_email');

              Route::post('templates/preview', 'ModelosController@setPreview')->name('template_preview');
              Route::get('templates/preview/{id}', 'ModelosController@preview')->name('template_preview_item');

              Route::get('/images/google', 'PropagandasController@googleImages')->name('google_images');
              Route::post('/images/upload', 'PropagandasController@enviarImagem')->name('upload_images');
              Route::post('/templates/preview/storeImages', 'PropagandasController@storeImages')->name('template_store_images');
          });
      });

  //  });

  });

  Route::get('/pagseguro/redirect', 'CheckoutController@redirect')->name('pagseguro.redirect');

});

Route::post('/pagseguro/notification', [
  'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
  'as' => 'pagseguro.notification',
]);
