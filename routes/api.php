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
Route::apiResources(['category' => 'API\CategoryController']);
Route::apiResources(['subcategory' => 'API\SubCategoryController']);
Route::apiResources(['library' => 'API\LibraryController']);
Route::get('findProject', 'API\ProjectController@search');
Route::get('findCabinet/{id}', 'API\LibraryController@findCabinet');
Route::get('findCabinetBySubCategory/{id}', 'API\LibraryController@findCabinetBySubCategory');
Route::post('addCabinet', 'API\RoomController@addCabinet');






