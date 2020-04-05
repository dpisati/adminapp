<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');
