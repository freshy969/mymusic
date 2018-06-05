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
use App\User;

Route::get('/', function () {
  return view('welcome');
});
//mostrar perfil personal 3/4
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//profiles
Route::get('/profiles','ArtistprofileController@index');
Route::get('/profile/create', 'ArtistprofileController@create');
Route::post('/profile/s', 'ArtistprofileController@store');
Route::get('/profile/{Perprof}', 'ArtistprofileController@show');
Route::get('/profile/{Perprof}/edit', 'ArtistprofileController@edit');
Route::post('/profile/{Perprof}', 'ArtistprofileController@update');//fix
Route::get('/profile/{Perprof}/self','ArtistprofileController@own');
Route::post('/profilepic','ArtistprofileController@updateavatar');
Route::get('profiles/searchredirect', function(){     
    /* Nuevo: si el argumento search está vacío regresar a la página anterior */
    if (empty(Request::get('search'))) return redirect()->back();
    
    $search = urlencode(e(Request::get('search')));
    $route = "/profiles/$search";
    return redirect($route);
});
Route::get("/profiles/{search}", "ArtistprofileController@search");
Route::get("/profiles/mayores/18","ArtistprofileController@mayor");
Route::get("/profiles/banda/s","ArtistprofileController@bandas");
Route::get("/profiles/solista/s","ArtistprofileController@solistas");


//videos
Route::get('/profile/{Perprof}/videos', 'VideosController@videosfromprofile');
Route::get('/profile/{Perprof}/{id}/videos', 'VideosController@videosfromprofile');

////Route::get('/profile/{Perprof}/videos/create', 'VideosController@create');
//Route::get('descarga/{archivo}', 'VideosController@descarga')->name('descarga');//fix
Route::resource('video', 'VideosController', ['only' => ['store', 'destroy']]);//fix destroy

//events
Route::get('/profile/{Perprof}/events', 'FutureventsController@index');
Route::get('/profile/{Perprof}/events/create','FutureventsController@create');
Route::post('/profile/{Perprof}/events', 'FutureventsController@store');

//audios
Route::get('/profile/{Perprof}/audios','AudiosController@audiosfromprofile');
Route::get('/profile/{Perprof}/{id}/audios','AudiosController@audiosfromprofile');
////Route::get('/profile/{Perprof}/audios/create','AudiosController@create');
//Route::get('descarga/{archivo}', 'AudiosController@descarga')->name('descarga');//fix
Route::resource('audios', 'AudiosController', ['only' => ['store', 'destroy']]);//fix destroy
/*Route::post('/profile/{Perprof}/audio/', [
    'as' => 'audios.store',
    'uses' => 'AudiosController@store'
]);*/
Route::get('/phpinf', function() {
    phpinfo();
});