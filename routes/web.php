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

Route::get('/', function () {
    $links = [
        'https://platzi.com'=>'Platzi',
        'https://www.epn.edu.ec/'=>'EPN',
        'https://esfot.epn.edu.ec/'=>'ESFOT'
    ];
    return view('welcome',[
        'links'=> $links
    ]);
});
Route::get('/about-us',function(){
    return view('about');
});
