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
//jimzky
Route::get('document', 'DocumentController@index');
Route::get('document/accept', 'DocumentController@accept');
Route::get('document/salary', 'DocumentController@salary');
Route::post('document/salary', 'DocumentController@saveSalary');


//rusel
Route::get('prform','PurchaseRequestController@prform');
Route::post('prform','PurchaseRequestController@savePrform');


//traya
Route::get('/form/routing/slip', 'RoutingController@routing_slip');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
