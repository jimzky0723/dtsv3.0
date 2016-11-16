<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/15/2016
 * Time: 4:25 PM
 */

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Request;
use App\User;
use App\Tracking;
class AppLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = User::find($request->user()->id);
        return view('form.application_cdo')->with('user', $user);
    }

    public function create(Request $request) {
        $tracking = new Tracking();
        $tracking->route_no = date('Y')."-".$request->user()->id.date('mdHis');
        $tracking->cdo_applicant = $request->input('applicant_name');
        $tracking->cdo_day = $request->input('days_leave');
        $tracking->event_daterange = $request->input('daterange');
        $tracking->doc_type = $request->input('doctype');
        $tracking->prepared_date = date('Y-m-d H:i:s');
        $tracking->prepared_by = $request->user()->id;
        $tracking->description = $request->input('description');
        $tracking->save();
        return redirect('document');

    }
}