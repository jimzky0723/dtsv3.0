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
        $division = Division::paginate(5);
        return view('division.division',['division' => $division ]);
    }
    public function addDivision(){
        $user = Users::all();
        return view('division.addDivision',['user' => $user]);
    }
    public function addDivisionSave(Request $request){
        $division = new Division();
        $division->description = $request->get('description');
        $division->head = $request->get('head');
        $division->save();
        return redirect("division");
    }
    public function getHead($id){
        $user = Users::where('id',$id)->first();
        return $user->fname.' '.$user->mname.' '.$user->lname;
    }
}
