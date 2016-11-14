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
Route::get('/change/password', 'PasswordController@change_password');
Route::post('/change/password', 'PasswordController@save_changes');


Route::get('haha',function(){
    return Tracking::all();
});

Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/session','DocumentController@session');
Route::get('/pdf', function(){
    date_default_timezone_set('Asia/Singapore');
    $routeNumber = "doh7".date('Ymdhms');
    $bc = DNS1D::getBarcodeHTML($routeNumber,"C39E",1,33);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($bc.'<h1>Test</h1>');
    return $pdf->stream();
});

