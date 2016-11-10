<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ValidateSalaryForm;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Tracking;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function index()
    {
        return view('form.salary');
    }
    
    public function store(ValidateSalaryForm $request){
        $q = new Tracking();
        $q->route_no = 'DOH'.date('Ymdhis').$request->input('prepared_by');
        $q->doc_type = $request->input('doc_type');
        $q->prepared_date = date('Y-m-d H:i:s');
        $q->prepared_by = $request->input('prepared_by');
        $q->amount = $request->input('amount');
        $q->description = $request->input('description');
        $q->dv_no = $request->input('dv_no');
        $q->save();
        
        return redirect('document');
    }

    
}
