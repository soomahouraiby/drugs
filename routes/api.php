<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('/', 'Api\SchemeController@index');
Route::get('/diseases', 'Api\DiseasesController@index');

Route::group(['middleware' => ['jwt.auth']], function (){
    Route::get('user/info', 'Api\UserController@userinfo');
    Route::get('user/diseases', 'Api\UserController@diseases');
    Route::post('user/diseases/update', 'Api\UserController@diseasesupdate');
    Route::post('user/update', 'Api\UserController@userupdate');
    Route::get('search/batchnumber/{batchnumber}', 'Api\SearchController@batchnumber');
    Route::get('search/barcode/{barcode}', 'Api\SearchController@barcode');
    Route::get('search/tradename/{tradename}', 'Api\SearchController@tradename');
    Route::get('search/scientificname/{scientificname}', 'Api\SearchController@scientificname');
    Route::get('search/alternate/{alternate}', 'Api\SearchController@alternate');
    Route::post('report/{type}', 'Api\ReportController@index');

    Route::post('logout', 'Api\UserController@logout');

});
