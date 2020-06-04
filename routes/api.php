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
Route::apiResources(['supplier' => 'API\SupplierController']);
Route::apiResources(['material' => 'API\MaterialController']);
Route::apiResources(['finish' => 'API\FinishController']);
Route::apiResources(['category' => 'API\CategoryController']);
Route::apiResources(['subcategory' => 'API\SubCategoryController']);
Route::apiResources(['library' => 'API\LibraryController']);


Route::get('findProject', 'API\ProjectController@search');
Route::get('findMaterial/{id}', 'API\MaterialController@find');
Route::get('findStockMaterial', 'API\MaterialController@findStock');
Route::get('findSelectedMaterial/{id}', 'API\MaterialController@findSelectedMaterial');

Route::get('findCabinet/{id}', 'API\LibraryController@findCabinet');
Route::get('findCabinet', 'API\LibraryController@search');
Route::get('findCabinetBySubCategory/{id}', 'API\LibraryController@findCabinetBySubCategory');
Route::post('addCabinet', 'API\RoomController@addCabinet');
Route::put('cabinet', 'API\LibraryController@updateCabinet');

// Route::get('shop-cabinet/{slug}', 'API\LibraryController@shopShow');
Route::apiResources(['shop-cabinet' => 'ShopController']);






