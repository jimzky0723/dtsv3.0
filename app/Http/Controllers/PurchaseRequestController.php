<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Session;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('document.list');
    }

    public function prCreated(){
        return view('prCreated');
    }
    public function prForm(){
        date_default_timezone_set('Asia/Singapore'); 
        return view('form.prform',['name' => 'rusel']);
    }

    public function savePrform(Request $request){
        $route_no = "doh7".date('ymdms').$request->user()->id;
        Session::put('route_no',$route_no);
        Session::put('doctype',$request->get('doctype'));
        Session::put('date',$request->get('date'));
        Session::put('preparedby',$request->get('preparedby'));
        Session::put('prno',$request->get('prno'));
        Session::put('amount',$request->get('amount'));
        Session::put('requestedby',$request->get('requestedby'));
        Session::put('chargeto',$request->get('chargeto'));
        Session::put('purpose',$request->get('purpose'));

        $tracking = new Tracking();
        $tracking->route_no = $route_no;
        $tracking->doc_type = $request->get('doctype');
        $tracking->prepared_date = $request->get('date');
        $tracking->prepared_by = $request->get('preparedby');
        $tracking->pr_no = $request->get('prno');
        $tracking->amount = $request->get('amount');
        $tracking->requested_by = $request->get('requestedby');
        $tracking->source_fund = $request->get('chargeto');
        $tracking->description = $request->get('purpose');
        $tracking->save();

        return redirect('/document/prCreated');
    }
}
