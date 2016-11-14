<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('document.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStore(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUpdate(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id)
    {
        //
    }
    
    public function prForm(){
        date_default_timezone_set('Asia/Singapore'); 
        return view('form.prform',['name' => 'rusel']);
    }
    public function savePrform(Request $request){
        $tracking = new Tracking();
        $tracking->doc_type = $request->get('doctype');
        $tracking->prepared_date = $request->get('date');
        $tracking->prepared_by = $request->get('preparedby');
        $tracking->pr_no = $request->get('prno');
        $tracking->amount = $request->get('amount');
        $tracking->requested_by = $request->get('requestedby');
        $tracking->source_fund = $request->get('chargeto');
        $tracking->description = $request->get('purpose');
        $tracking->save();

    }
}
