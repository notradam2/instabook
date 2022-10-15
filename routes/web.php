<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::resource('contacts', ContactController::class);

    Route::group(['prefix'=>'mails','as'=>'mails.'], function () {
        Route::get('/create/{contact_id}', ['as' => 'create', 'uses' => 'MailController@createMail']);
        Route::post('/send/{contact_id}', ['as' => 'send', 'uses' => 'MailController@sendMail']);
    });
});
