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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'UserController@login');
Route::group(['middleware'=>'auth:api'], function() {
    Route::get('user', 'UserController@user');
    Route::get('staff', 'StaffController@list');
    Route::get('cases', 'CasesController@show');
    Route::get('cases/message', 'CasesController@message');
    Route::get('cases/files/{case}', 'CasesController@files');
    Route::post('cases/files/upload', 'CasesController@uploadFile');
    Route::post('staff/message', 'SatffController@newMessage');
    Route::post('refers', 'HomeController@referal');
    Route::post('support', 'HomeController@support');
    Route::post('logout', 'UserController@logout');
});