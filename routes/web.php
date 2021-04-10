<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/staff', 'StaffController@index')->name('staff');
Route::get('/testing', 'StaffController@test')->name('staff');
Route::get('/clients', 'StaffController@clients')->name('clients');

Route::get('/communication', 'CommunicationController@index')->name('communication');
Route::prefix('communication')->group(function () {
    Route::get('chat', 'CommunicationController@chat')->name('communication/chat');
    Route::post('chatList', 'CommunicationController@chatList')->name('communication/chatList');
    Route::get('push', 'CommunicationController@index')->name('communication/push');
    Route::post('mail', 'CommunicationController@index')->name('communication/mail');
});

Route::post('clients/invite', 'StaffController@clientsInvite')->name('invite');
Route::get('/cases', 'CasesController@index')->name('cases');
Route::get('/cases/ajax', 'CasesController@ajax')->name('ajax');
Route::post('/case/{id}', 'CasesController@caseId')->name('caseId');
Route::post('/case/message/new', 'CasesController@message')->name('message');

Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog-list', 'BlogController@list')->name('blog-list');

Route::prefix('webhook')->group(function () {
    Route::get('dropbox', 'WebhookController@dropbox')->name('webhook-dropbox');
    Route::post('dropbox', 'WebhookController@dropboxData')->name('webhook-dropbox-data');
    Route::post('blog', 'WebhookController@blog')->name('webhook-blog-data');
});

Route::get('prueba', function() {
    event(new App\Events\Chat('Diego Fernando Soba Dominguez.'));
    //return view('welcome');
});