<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/16/2016
 * Time: 10:55 AM
 */

namespace App\Http\Controllers;

use App\Tracking;
use Symfony\Component\HttpFoundation\Request;

class OfficeOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $user = $request->user()->fname." ".$request->user()->mname." ".$request->user()->lname;
        return view('form.office_order')->with('user',$user);
    }
    public function craete(Request $request){
        $tracking = new Tracking();
        $tracking->route_no = date('Y')."-".$request->user()->id.date('mdHis');
        $tracking->prepared_by = $request->user()->id;
        $tracking->prepared_date = date('Y-m-d H:i:s');
        $tracking->doc_type = $request->input('doctype');
        $tracking->description = $request->input('descripition');
        $tracking->save();

        $a = new Tracking_Details();
        $a->route_no = $tracking->route_no;
        $a->date_in = $tracking->prepared_date;
        $a->received_by = $request->user()->id;
        $a->delivered_by = $request->user()->id;
        $a->action = $request->input('description');
        $a->save();
        return redirect('document');
    }
}