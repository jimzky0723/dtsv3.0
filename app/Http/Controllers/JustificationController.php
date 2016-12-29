<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/16/2016
 * Time: 10:09 AM
 */

namespace App\Http\Controllers;

use App\Tracking;
use App\Tracking_Details;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class JustificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        if($request->isMethod('get')) {
            $user = $request->user()->fname." ".$request->user()->mname." ".$request->user()->lname;
            return view('form.justification_letter')->with('user', $user);
        }

        if($request->isMethod('post')){
            return $request->all();
            $tracking = new Tracking();
            $tracking->route_no = date('Y')."-".$request->user()->id.date('mdHis');
            $tracking->prepared_by = $request->user()->id;
            $tracking->prepared_date = date('Y-m-d H:i:s');
            $tracking->description = $request->input('description');
            $tracking->doc_type = $request->input('doctype');
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
}