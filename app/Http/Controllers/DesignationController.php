<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/18/2016
 * Time: 10:27 AM
 */

namespace App\Http\Controllers;


use App\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        $d = Designation::paginate(10);
        return view('designation.list')->with('designations',$d);
    }
    public function create() {
        return view('designation.create');
    }
    public function save(Request $request){
        $d = new Designation();
        $d->description = $request->input('designation');
        $d->save();
        return redirect('designation');
    }
    public function remove(Request $request) {

        $d = Designation::find($request->input('id'));
        if(isset($d) and count($d) > 0) {
            $d->delete();
            return json_encode(array('status' => 'ok'));
        }
        return json_encode(array('status' => 'failed'));
    }
    public function edit(Request $request) {
        $d = Designation::find($request->input('id'));
        if(isset($d) and count($d) > 0) {
            return view('designation.edit_designation')->with('d', $d);
        }
    }
    public function edit_save(Request $request){
        $d = Designation::find($request->input('id'));
        if(isset($d) and count($d) > 0) {
            $d->description = $request->input('designation');
            $d->save();
            return redirect('designation');
        }
    }
}