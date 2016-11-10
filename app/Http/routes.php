<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('auth.login');
    if(Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Route::auth();

Route::get('home', 'HomeController@index');
Route::controller('document', 'DocumentController');
Route::controller('contract', 'ContractController');
Route::controller('prform','PurchaseRequestController');

