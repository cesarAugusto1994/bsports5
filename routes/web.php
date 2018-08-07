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

Route::middleware('loadCache')->group(function() {

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/', 'HomeController@index')->name('home_2');
  Route::get('/contato', 'HomeController@contato')->name('contato');
  Route::get('/classificacao', 'HomeController@classificacao')->name('classificacao');

  Route::get('/jogador/{slug}/{id}', 'JogadoresController@show')->name('jogador');

  Route::get('/pagina/{slug}/{id}', 'PaginasController@show')->name('pagina');
  Route::get('/paginas', 'PaginasController@index')->name('paginas');

  Route::get('/resultados', 'ResultadosController@index')->name('resultados');
  Route::get('/calendario', 'CalendarioJogosController@index')->name('calendario');

  Route::get('/import-jogadores', 'HomeController@importJogadores')->name('import_jogadores');
  Route::get('/import-partidas', 'HomeController@importPartidas')->name('import_partidas');

  Route::get('/partidas/ajax', 'PartidasController@partidasAjax')->name('partidas_ajax');
  Route::get('jogadores/get-ajax', 'JogadoresController@toAjax')->name('jogadores_ajax');

  Route::group(['middleware' => 'auth'], function () {

  //  Route::group(['middleware' => 'checkrole'], function () {

      Route::group(['middleware' => 'role:user'], function () {
        Route::group(['prefix' => 'player'], function () {
            Route::get('/dashboard', 'PlayerController@index')->name('player_dashboard');
            Route::get('/', 'PlayerController@index')->name('player_index');
            Route::get('/profile', 'PlayerController@show')->name('player');

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
              Route::get('/players', 'AdminController@jogadores')->name('admin_jogadores');
              Route::resource('players', 'JogadoresController');
              Route::get('/appointment', 'PartidasController@agendamento')->name('agendar_partida');
              Route::get('/appointment/create', 'PartidasController@create')->name('create_partida');
              //Route::resource('perfil', 'PerfilController');
              Route::get('/mensalidade', 'JogadoresController@mensalidade')->name('mensalidade');
              Route::resource('partida', 'PartidasController');
              Route::resource('mensalidades', 'JogadorMensalidadesController');
              Route::resource('categorias', 'CategoriasController');
              Route::resource('torneios', 'TorneiosController');
              Route::get('/appointment/{id}/match', 'PartidasController@agendar')->name('agendar_partida_jogador');
              Route::post('/appointment/{id}/match/store', 'PartidasController@agendarStore')->name('partida_jogador_store');
              Route::get('/appointment/ajax', 'PartidasController@listaPartidasAjax')->name('lista_partidas_ajax');
          });
      });

  //  });

  });

  Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
  ]);

  Route::get('/pagseguro/redirect', 'CheckoutController@redirect')->name('pagseguro.redirect');

});
