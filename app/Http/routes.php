<?php

Use App\Tracking;

Route::auth();
//jimzky
Route::get('/', 'HomeController@index');
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
Route::get('document/prCreated','PurchaseRequestController@prCreated');
Route::get('prRegularPurchase','PurchaseRequestController@prRegularPurchase');
Route::post('prRegularPurchase','PurchaseRequestController@savePrRegularPurchase');
Route::get('prCashAdvance','PurchaseRequestController@prCashAdvance');
Route::post('prCashAdvance','PurchaseRequestController@savePrCashAdvance');
Route::get('PurchaseOrder','PurchaseOrderController@PurchaseOrder');
Route::post('PurchaseOrder','PurchaseOrderController@PurchaseOrderSave');
Route::get('haha',function(){
    return Tracking::all();
});


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

