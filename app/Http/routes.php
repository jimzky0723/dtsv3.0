<?php
Use App\Tracking;
Route::auth();

//jimzky
Route::get('/','HomeController@index');

Route::get('home', 'HomeController@index');
Route::get('home/chart', 'HomeController@chart');

Route::get('document', 'DocumentController@index');
Route::post('document', 'DocumentController@search');

Route::get('document/accept', 'DocumentController@accept')->middleware('access');
Route::get('document/destroy/{route_no}', 'DocumentController@cancelRequest');
Route::post('document/accept', 'DocumentController@saveDocument');
Route::get('document/info/{route}', 'DocumentController@show');
Route::get('document/removepending/{id}','DocumentController@removePending');
Route::get('document/track/{route_no}','DocumentController@track');

// FOR ACCOUNTING SECTION
Route::get('accounting/accept','AccountingController@accept');
Route::post('accounting/accept','AccountingController@save');

//FOR BUDGET SECTION
Route::get('budget/accept','BudgetController@accept');
Route::post('budget/accept','BudgetController@save');


Route::get('document/filter', 'FilterController@index');
Route::post('document/filter', 'FilterController@update');

Route::get('document/delivered', 'DocumentController@deliveredDocument');
Route::post('document/delivered', 'DocumentController@deliveredDocument');

Route::get('document/received', 'DocumentController@receivedDocument');
Route::post('document/received', 'DocumentController@receivedDocument');

Route::get('form/salary','SalaryController@index');
Route::post('form/salary','SalaryController@store');

Route::get('form/tev', 'TevController@index');
Route::post('form/tev', 'TevController@store');

Route::get('form/bills','BillsController@index');
Route::post('form/bills','BillsController@store');

Route::get('pdf', function(){
    $display = view("pdf.pdf");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);

    return $pdf->stream();
});

//PRINT LOGS
Route::get('pdf/track','PrintLogsController@printTrack');
Route::get('pdf/logs/{doc_type}', 'PrintLogsController@delivered_docs');
Route::get('pdf/pending/{doc_type}', 'PrintLogsController@received_docs');

Route::get('tayong',function(){
   return view('logs.PurchaseRequestR');
});
//endjimzky

//rusel
//PURCHASE REQUEST/REGULAR
Route::get('document/prCreated','PurchaseRequestController@prCreated');
Route::get('prRegularPurchase','PurchaseRequestController@prRegularPurchase');
Route::post('prRegularPurchase','PurchaseRequestController@savePrRegularPurchase');
//PURCHASE REQUEST/ADVANCE
Route::get('prCashAdvance','PurchaseRequestController@prCashAdvance');
Route::post('prCashAdvance','PurchaseRequestController@savePrCashAdvance');
//PURCHASE ORDER
Route::get('PurchaseOrder','PurchaseOrderController@PurchaseOrder');
Route::post('PurchaseOrder','PurchaseOrderController@PurchaseOrderSave');
//DIVISION
Route::get('division','DivisionController@division');
Route::get('addDivision','DivisionController@addDivision');
Route::post('addDivision','DivisionController@addDivisionSave');
Route::get('deleteDivision/{id}','DivisionController@deleteDivision');
Route::get('updateDivision/{id}/{head}','DivisionController@updateDivision');
Route::post('updateDivisionSave','DivisionController@updateDivisionSave');
Route::post('searchDivision','DivisionController@searchDivision');
Route::get('searchDivision','DivisionController@searchDivisionSave');
//SECTION
Route::get('section','SectionController@section');
Route::get('addSection','SectionController@addSection');
Route::post('addSection','SectionController@addSectionSave');
Route::get('deleteSection/{id}','SectionController@deleteSection');
Route::get('updateSection/{id}/{division}/{head}','SectionController@updateSection');
Route::post('updateSectionSave','SectionController@updateSectionSave');
Route::post('searchSection','SectionController@searchSection');
Route::get('searchSection','SectionController@searchSectionSave');
//CHECK SECTION
Route::get('checkSection','SectionController@checkSection');
Route::get('checkSectionUpdate','SectionController@checkSectionUpdate');
//CHECK DIVISION
Route::get('checkDivision','DivisionController@checkDivision');
Route::get('checkDivisionUpdate','DivisionController@checkDivisionUpdate');
Route::get('date_in/{count}','DocumentController@get_date_in');
Route::get('haha',function(){
    return Session::get("date_in");
});

//traya
//routing slip
Route::get('/form/routing/slip', 'RoutingController@routing_slip');
Route::post('/form/routing/slip', 'RoutingController@create');
//incoming letter
Route::match(['get','post'],'/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
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
//GENERAL DOC
Route::match(['get','post'],'general', 'GeneralDocument@create');
//CHANGE PASSWORD
Route::get('/change/password', 'PasswordController@change_password');
Route::post('/change/password', 'PasswordController@save_changes');
Route::get('/form/incoming/letter', 'MailLetterIncomingController@incoming_letter');
Route::get('/session','DocumentController@session');

//ADMIN CONTROLLER
//users
Route::get('users', 'AdminController@users');
Route::match(['get','post'],'user/new','AdminController@user_create');
Route::match(['get','post'],'user/edit','AdminController@user_edit');
Route::get('/get/section', 'AdminController@section');
Route::get('/search/user','AdminController@search');
Route::post('/user/remove','AdminController@remove');
Route::get('/check/user','AdminController@check_user');
//designation
Route::get('/designation', 'DesignationController@index');
Route::match(['get','post'],'/designation/create','DesignationController@create');
Route::match(['get','post'],'/edit/designation', 'DesignationController@edit');
Route::get('/search/designation', 'DesignationController@search');
Route::post('/remove/designation', 'DesignationController@remove');

Route::get('clear', function(){
   Session::flush();
    return redirect('/');
});

Route::get('modal',function(){
return view('users.modal');
});
