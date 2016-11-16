<?php

Use App\Tracking;

Route::auth();
//jimzky
Route::get('home', 'HomeController@index');
Route::get('document', 'DocumentController@index');
Route::get('document/accept', 'DocumentController@accept');
Route::get('document/{route}', 'DocumentController@show');
Route::get('form/salary','SalaryController@index');
Route::post('form/salary','SalaryController@store');
//endjimzky

//rusel
Route::get('prform','PurchaseRequestController@prform');
Route::post('prform','PurchaseRequestController@savePrform');
Route::get('document/prCreated','PurchaseRequestController@prCreated');
Route::get('haha',function(){
    return Tracking::all();
});
Route::get('pdf','PurchaseRequestController@pdf');

//traya
//routing slip
Route::get('/form/routing/slip', 'RoutingController@routing_slip');
Route::post('/form/routing/slip', 'RoutingController@create');
//incoming letter
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
//APP LEAVE CDO
Route::get('/form/application/leave', 'AppLeaveController@index');
Route::post('/form/application/leave', 'AppLeaveController@create');
Route::get('/change/password', 'PasswordController@change_password');
Route::post('/change/password', 'PasswordController@save_changes');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/session','DocumentController@session');




Route::get('/pdf1', function(){

    date_default_timezone_set('Asia/Singapore');
    $routeNumber = "doh7".date('Ymdhms').Auth::user()->id;
    $bc = DNS1D::getBarcodeHTML($routeNumber,"C39E",1,33);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($bc.$routeNumber);
    return $pdf->stream();
});

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/home');
    }
    return view('auth.login');
});
