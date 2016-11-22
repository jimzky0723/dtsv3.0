<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Division;
use App\Users;
use App;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function division(){
        $division = Division::orderBy('description','asc')->paginate(10);
        return view('division.division',['division' => $division ]);
    }
    public function addDivision(){
        $user = Users::all()->sortBy("fname");
        return view('division.addDivision',['user' => $user]);
    }
    public function addDivisionSave(Request $request){
        $division = new division();
        $division->description = $request->get('description');
        $division->head = $request->get('head');
        $division->save();
        return redirect("division");
    }
    public function deleteDivision($id){
        $division = division::find($id);
        $division->delete();
    }
    public function updateDivision($id,$headId){
        $division = Division::where('id','=',$id)->first();
        $description = $division['description'];
        $head = Users::where('id', '=', $headId)->first();
        $headId = $head['id'];
        $headName  = $head['fname'].' '.$head['mname'].' '.$head['lname'];
        $user = Users::all()->sortBy("fname");
        return view('division.updatedivision',['id' => $id ,'user' => $user,'headId' => $headId,'headName' => $headName,'description' => $description] );
    }
    public function updateDivisionSave(Request $request){
        $division = division::find($request->get('id'));
        $division->description=$request->get('description');
        $division->head=$request->get('head');
        $division->save();
        return redirect('division');
    }
    public static function getHead($id){
        $user = Users::find($id);
        return $user['fname'].' '.$user['mname'].' '.$user['lname'];
    }
}
