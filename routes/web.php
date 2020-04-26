<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);



Route::get('/home', 'HomeController@index')->name('home');
// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');

