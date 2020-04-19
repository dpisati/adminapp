<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => 'API\UserController']);
Route::get('findUser', 'API\UserController@search');
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');

Route::apiResources(['project' => 'API\ProjectController']);
Route::apiResources(['room' => 'API\RoomController']);
Route::apiResources(['cabinet' => 'API\CabinetController']);
Route::get('findProject', 'API\ProjectController@search');
Route::post('addCabinet', 'API\RoomController@addCabinet');






