<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Section;
use App\Users;
use App;

class SectionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function section(){
        $section = Section::orderBy('description','asc')->paginate(20);
        return view('section.section',['section' => $section ]);
    }
    public function addsection(){
        $user = Users::all();
        return view('section.addSection',['user' => $user ]);
    }
    public function addsectionSave(Request $request){
        $section = new Section();
        $section->description = $request->get('description');
        $section->head = $request->get('head');
        $section->save();
        return redirect("section");
    }
    public static function getHead($id){
        $user = Users::find($id);
        return $user['fname'].' '.$user['mname'].' '.$user['lname'];
    }
}
