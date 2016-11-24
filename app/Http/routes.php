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
Route::get('document/info/{route}', 'DocumentController@show');
Route::get('document/removepending/{id}','DocumentController@removePending');
Route::get('document/track/{route_no}','DocumentController@track');

Route::get('document/delivered', 'DocumentController@deliveredDocument');
Route::post('document/delivered', 'DocumentController@deliveredDocument');

Route::get('document/received', 'DocumentController@receivedDocument');
Route::post('document/received', 'DocumentController@receivedDocument');

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

Route::get('pdf/logs/{doc_type}', function($doc_type){
    if($doc_type=='SAL' || $doc_type=='TEV'){
        $display = view("logs.salary");
    }else if($doc_type=='PO'){
        $display = view('logs.PurchaseOrder');
    }else if($doc_type=="PRC"){
        $display = view('logs.PurchaseRequestCA');
    }else if($doc_type=="PRR"){
        $display = view('logs.PurchaseRequestCA');
    }else if($doc_type=='ALL'){
        $display = view("logs.all");
    }else{
        return redirect('document/delivered');
    }

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display)->setPaper('a4', 'landscape');
    return $pdf->stream();
});

Route::get('pdf/pending/{doc_type}', function($doc_type){
    if($doc_type=='SAL' || $doc_type=='TEV' || $doc_type=='PO'){
        $display = view("pending.salary");
    }else if($doc_type=='ALL'){
        $display = view("pending.all");
    }else{
        return redirect('document/received');
    }
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display)->setPaper('a4', 'landscape');
    return $pdf->stream();
});
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

