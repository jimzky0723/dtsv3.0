<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/14/2016
 * Time: 2:46 PM
 */

namespace App\Http\Controllers;


use App\Tracking;
use App\Http\Requests\ValidateSalaryForm;
use App\Tracking_Details;

class TEVController extends Controller
{
    public function index() {
        return view('form.tev');
    }
    public function create() {
        $tracking = new Tracking();
    }
    public function store(ValidateSalaryForm $request){
        $q = new Tracking();
        $q->route_no = date('Y-').$request->input('prepared_by').date('mdHis');
        $q->doc_type = $request->input('doc_type');
        $q->prepared_date = $request->input('prepared_date');
        $q->prepared_by = $request->input('prepared_by');
        $q->amount = $request->input('amount');
        $q->description = $request->input('description');
        $q->event_daterange = $request->input('daterange');
        $q->save();

        $q = new Tracking_Details();
        $q->route_no = date('Y-').$request->input('prepared_by').date('mdHis');
        $q->date_in = $request->input('prepared_date');
        $q->received_by = $request->input('prepared_by');
        $q->delivered_by = $request->input('prepared_by');
        $q->remarks = $request->input('description');
        $q->save();
        return redirect('document');
    }
}