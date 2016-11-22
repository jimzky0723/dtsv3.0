<?php
Use App\Tracking;
Route::auth();

//jimzky

Route::get('/','HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('document', 'DocumentController@index');
Route::post('document', 'DocumentController@search');

Route::get('document/accept', 'DocumentController@accept');
Route::get('document/destroy/{route_no}', 'DocumentController@cancelRequest');
Route::post('document/accept', 'DocumentController@saveDocument');
Route::get('document/{route}', 'DocumentController@show');
Route::get('document/removepending/{id}','DocumentController@removePending');
Route::get('document/track/{route_no}','DocumentController@track');


Route::get('form/salary','SalaryController@index');
Route::post('form/salary','SalaryController@store');

Route::get('form/tev', 'TevController@index');
Route::post('form/tev', 'TevController@store');

Route::get('pdf', function(){
    $display = view("pdf.pdf");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);

    return $pdf->stream();
});

Route::get('pdf/track', function(){
    $display = view("pdf.track");
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
Route::get('division','DivisionController@division');
Route::get('addDivision','DivisionController@addDivision');
Route::post('addDivision','DivisionController@addDivisionSave');
Route::get('section','SectionController@section');
Route::get('addSection','SectionController@addSection');
Route::post('addSection','SectionController@addSectionSave');
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
//JUSTIFICTION LETTER
Route::get('/form/justification/letter', 'JustificationController@index');
Route::post('/form/justification/letter','JustificationController@create');
//OFFICE ORDER
Route::get('/form/office-order','OfficeOrderController@index');
Route::post('/form/office-order','OfficeOrderController@create');
//ACTIVITY WORKSHEET
Route::get('/form/worksheet','ActivityWorksheetController@index');
Route::post('/form/worksheet', 'ActivityWorksheetController@create');
//CHANGE PASSWORD
Route::get('/change/password', 'PasswordController@change_password');
Route::post('/change/password', 'PasswordController@save_changes');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/session','DocumentController@session');

//ADMIN CONTROLLER
//users
Route::get('users', 'AdminController@users');
Route::get('user/new', 'AdminController@create');
Route::post('/user/new', 'AdminController@new_user');
Route::get('/user/edit', 'AdminController@edit');
Route::post('/user/edit', 'AdminController@handle_edit');
Route::get('/get/section', 'AdminController@section');
Route::post('/search/user','AdminController@search');
//designation
Route::get('/designation', 'DesignationController@index');
Route::get('/designation/create', 'DesignationController@create');
Route::post('/designation/create', 'DesignationController@save');
Route::get('/remove/designation', 'DesignationController@remove');
Route::get('/edit/designation', 'DesignationController@edit');
Route::post('/edit/designation', 'DesignationController@edit_save');


