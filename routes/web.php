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

Route::get('/welcome', function () {
    return view('welcome_basic');
})->middleware('auth.basic');

Route::get('/usuario/{id}', 'UserController@show')
    //Acceso restringido pasa a nivel del controlador
    ////->middleware('auth')
    ->name('perfil');
Route::post('/usuario/update', 'UserController@update')
    //Acceso restringido pasa a nivel del controlador
    ////->middleware('auth')
    ->name('update');

Route::get('/', ['as'=>'home','uses'=>'AppController@index']);

//Sin Verificación por EMAIL
////Auth::routes();
//Con Verificación por Email
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
