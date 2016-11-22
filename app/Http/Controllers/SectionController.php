<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Section;
use App\Division;
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
    public function addSection(){
        $division = Division::all();
        $user = Users::all()->sortBy("fname");
        return view('section.addSection',['user' => $user,'division' => $division ]);
    }
    public function addSectionSave(Request $request){
        $section = new Section();
        $section->division = $request->get('division');
        $section->description = $request->get('description');
        $section->head = $request->get('head');
        $section->save();
        return redirect("section");
    }
    public function deleteSection($id){
        $section = Section::find($id);
        $section->delete();
    }
    public function updateSection($id,$divisionId,$headId,$description){
        //DIVISION INFO
        $divisionAll = Division::all();
        $division = Division::where('id','=',$divisionId)->first();
        $divisionId = $division['id'];
        $divisionName = $division['description'];
        //HEAD INFORMATION
        $head = Users::where('id', '=', $headId)->first();
        $headId = $head['id'];
        $headName  = $head['fname'].' '.$head['mname'].' '.$head['lname'];
        $user = Users::all()->sortBy("fname");
        return view('section.updateSection',['id' => $id ,'user' => $user,'divisionAll' => $divisionAll,'headId' => $headId,'headName' => $headName,'description' => $description,'divisionId' => $divisionId, 'divisionName' => $divisionName] );
    }
    public function updateSectionSave(Request $request){
        $section = Section::find($request->get('id'));
        $section->division=$request->get('division');
        $section->description=$request->get('description');
        $section->head=$request->get('head');
        $section->save();
        return redirect('section');
    }
    public static function getHead($id){
        $user = Users::find($id);
        return $user['fname'].' '.$user['mname'].' '.$user['lname'];
    }
}
