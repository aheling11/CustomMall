<?php


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

use Illuminate\Support\Facades\Route;

Route::middleware('apiMidd')->group(function () {
    Route::post('/user', 'UserController@login');
    Route::get('/user', 'UserController@index');
    Route::post('/user/register', 'UserController@store');
    Route::post('/commodity', 'CommodityController@create');
    Route::get('/commodity', 'CommodityController@show');
    Route::get('/commodity/{id}', 'CommodityController@index');
    Route::put('/commodity/{id}', 'CommodityController@edit');
    Route::delete('/commodity/{id}', 'CommodityController@destroy');

    Route::post('/bill', 'BillController@create');
    Route::get('/bill', 'BillController@show');
    Route::get('/bill/{id}', 'BillController@index');
    Route::put('/bill/{id}', 'BillController@edit');
    Route::delete('/bill/{id}', 'BillController@destroy');
    Route::get('/bill', 'NeedController@list');

    Route::post('/need', 'NeedController@create');
    Route::get('/need', 'NeedController@show');
    Route::get('/need/{id}', 'NeedController@index');
    Route::put('/need/{id}', 'NeedController@edit');
    Route::delete('/need/{id}', 'NeedController@destroy');
    Route::get('/need', 'NeedController@list');

    Route::post('/tag', 'TagController@create');
    Route::get('/tag', 'TagController@show');
    Route::get('/tag/{id}', 'TagController@index');
    Route::put('/tag/{id}', 'TagController@edit');
    Route::delete('/tag/{id}', 'TagController@destroy');
    Route::get('/tag/allcommodities/{id}', 'TagController@allcommodities');


});
//Auth::routes();