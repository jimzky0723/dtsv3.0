<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/16/2016
 * Time: 10:09 AM
 */

namespace App\Http\Controllers;

use App\Tracking;
use App\User;
use Symfony\Component\HttpFoundation\Request;

class JustificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        $user = $request->user()->fname." ".$request->user()->mname." ".$request->user()->lname;
        return view('form.justification_letter')->with('user', $user);
    }
    public function create(Request $request) {
        $tracking = new Tracking();
        $tracking->route_no = date('Y')."-".$request->user()->id.date('mdHis');
        $tracking->prepared_by = $request->user()->id;
        $tracking->prepared_date = date('Y-m-d H:i:s');
        $tracking->description = $request->input('description');
        $tracking->doc_type = $request->input('doctype');
        $tracking->save();
        return redirect('document');

    }
}