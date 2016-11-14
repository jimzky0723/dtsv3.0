<?php

Use App\Tracking;

Route::get('/', function () {
    //return view('auth.login');
    if(Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Route::auth();
//jimzky
Route::get('home', 'HomeController@index');
Route::get('document', 'DocumentController@index');
Route::get('document/accept', 'DocumentController@accept');
Route::get('form/salary','SalaryController@index');
Route::post('form/salary','SalaryController@store');
//endjimzky

//rusel
Route::get('prform','PurchaseRequestController@prform');
Route::post('prform','PurchaseRequestController@savePrform');
Route::get('document/prCreated','PurchaseRequestController@prCreated');

//traya
Route::get('/form/routing/slip', 'RoutingController@routing_slip');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');

Route::get('haha',function(){
    return Tracking::all();
});

