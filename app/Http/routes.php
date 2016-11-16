<?php

Use App\Tracking;

Route::auth();
//jimzky
Route::get('home', 'HomeController@index');
Route::get('document', 'DocumentController@index');

Route::get('document/accept', 'DocumentController@accept');

Route::get('document/destroy/{route_no}', 'DocumentController@cancelRequest');
Route::post('document/accept', 'DocumentController@saveDocument');

Route::get('document/{route}', 'DocumentController@show');
Route::get('document/removepending/{id}','DocumentController@removePending');


Route::get('form/salary','SalaryController@index');
Route::post('form/salary','SalaryController@store');

Route::get('pdf', function(){
    $display = view("pdf.pdf");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);

    return $pdf->stream();
});
//endjimzky

//rusel
Route::get('prform','PurchaseRequestController@prform');
Route::post('prform','PurchaseRequestController@savePrform');
Route::get('document/prCreated','PurchaseRequestController@prCreated');
Route::get('haha',function(){
    return Tracking::all();
});


//traya
Route::get('/form/routing/slip', 'RoutingController@routing_slip');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/change/password', 'PasswordController@change_password');
Route::post('/change/password', 'PasswordController@save_changes');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/session','DocumentController@session');
Route::get('/pdf1', function(){
    $routeNumber = "doh7".date('Ymdhms').Auth::user()->id;
    $bc = DNS1D::getBarcodeHTML($routeNumber,"C39E",1,33);
    $pdf = App::make('dompdf.wrapper');

    $tmp = '<img src="data:image/png;base64,{{DNS1D::getBarcodePNG(\'11\', \'C39\')}}" alt="barcode" />';
    $pdf->loadHTML('<h2>'.$tmp.'</h2>');
    $pdf->loadHTML($bc.$routeNumber);
    return $pdf->stream();
});
Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

