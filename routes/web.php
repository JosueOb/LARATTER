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

Route::get('/','PagesController@home');

Route::get('/messages','MessagesController@search');
// Route::get('/messages/{id}', 'MessagesController@show');
Route::get('/messages/{message}', 'MessagesController@show');//se espera un objeto message
// Route::post('/messages/create', 'MessagesController@create')->middleware('auth');//se protege esta ruta

Auth::routes();
Route::get('/{username}','UsersController@show');

Route::get('/{username}/follows','UsersController@follows');
Route::get('/{username}/followers','UsersController@followers');

// Route::post('/{username}/follow','UsersController@follow')->middleware('auth');
// Route::post('/{username}/unfollow','UsersController@unfollow')->middleware('auth');

// Route::get('/home', 'HomeController@index')->name('home');
//rutas de login con facebook
Route::get('/auth/facebook','SocialAuthController@facebook');
Route::get('/auth/facebook/callback','SocialAuthController@callback');
Route::post('/auth/facebook/register','SocialAuthController@register');


//se pueden agrupar rutas que en este caso necesiten de autenticación
Route::group(['middleware' => 'auth'], function(){
    Route::post('/messages/create', 'MessagesController@create');
    Route::post('/{username}/follow','UsersController@follow');
    Route::post('/{username}/unfollow','UsersController@unfollow');
    
    Route::get('/conversations/{conversation}','UsersController@showConversation');
    //rutas para el envío de mensajes
    Route::post('/{username}/dms','UsersController@sendPrivateMessage');
    
});
