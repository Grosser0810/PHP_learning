<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResources(['preview' => 'API\PreviewController']);
Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['group' => 'API\GroupController']);
Route::apiResources(['carousel' => 'API\CarouselController']);
Route::get('loadGroup', 'API\ProductController@group');
Route::get('loadManufacturer', 'API\ProductController@manufacturer');
Route::get('filterProduct', 'API\ProductController@filter');
Route::apiResources(['manufacturer' => 'API\ManufacturerController']);
Route::apiResources(['product' => 'API\ProductController']);
Route::get('findUser', 'API\UserController@search');
Route::get('findProduct', 'API\ProductController@search');
Route::get('findManufacturer', 'API\ManufacturerController@search');
Route::get('findGroup', 'API\GroupController@search');


