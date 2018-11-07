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

  Route::get('/evento/{id}/{titulo}', 'EventoController@show')->name('evento');
  Route::get('/noticia/{id}/{titulo}', 'NoticiasController@show')->name('noticia');

  Route::get('/jogador/{id}', 'JogadoresController@show')->name('jogador');

  Route::get('/pagina/{slug}/{id}', 'PaginasController@show')->name('pagina');
  Route::get('/paginas', 'PaginasController@index')->name('paginas');

  Route::get('/formulario/agendar', 'PartidasController@formularioAgenda')->name('formulario_agendar');
  Route::post('/formulario/agendar', 'PartidasController@formularioAgendaStore')->name('formulario_agendar_store');

  Route::get('/resultados', 'ResultadosController@index')->name('resultados');
  Route::get('/calendario', 'CalendarioJogosController@index')->name('calendario');

  Route::get('/import-jogadores', 'HomeController@importJogadores')->name('import_jogadores');
  Route::get('/import-partidas', 'HomeController@importPartidas')->name('import_partidas');

  Route::get('/partidas/ajax', 'PartidasController@partidasAjax')->name('partidas_ajax');
  Route::get('jogadores/get-ajax', 'JogadoresController@toAjax')->name('jogadores_ajax');

  Route::get('/image/external', 'ImagensController@image')->name('image');

  Route::get('/partida/{id}/remover-jogador/{jogador}', 'PartidasController@removerJogador')->name('remover_jogador_partida');
  Route::get('/partida/{id}/trocar/jogador/{jogador}', 'PartidasController@trocarJogador')->name('trocar_jogador_partida');

  Route::group(['middleware' => 'auth'], function () {

  //  Route::group(['middleware' => 'checkrole'], function () {

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
              //Route::resource('perfil', 'PerfilController');
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

              Route::resource('solicitacao', 'SolicitacaoPartidaController');

              Route::get('/partidas/{id}/placar', 'PartidasController@placar')->name('partida_placar');
              Route::get('/partidas/{id}/placar/edit', 'PartidasController@editarPlacar')->name('editar_partida_placar');
              Route::post('/partida/{id}/placar/update', 'PartidasController@placarUpdate')->name('partida_placar_update');

              Route::get('mensalidades/create/from-categories', 'JogadorMensalidadesController@createFromCategories')->name('mensalidade_create_from_categories');

              Route::get('/appointment/{id}/match', 'PartidasController@agendar')->name('agendar_partida_jogador');
              Route::post('/appointment/{id}/match/store', 'PartidasController@agendarStore')->name('partida_jogador_store');

              Route::post('/partidas/{id}/trocar/jogador', 'PartidasController@trocarJogadorStore')->name('trocar_jogador_store');

              Route::get('/appointment/ajax', 'PartidasController@listaPartidasAjax')->name('lista_partidas_ajax');

              Route::post('/joagdores/inativar/em-massa', 'JogadoresController@inativarEmMassa')->name('jogadores_inativar_em_massa');

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
