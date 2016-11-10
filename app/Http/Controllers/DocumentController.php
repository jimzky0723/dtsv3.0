<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('document.list');
    }

   
    public function accept(){
        return view('document.accept');   
    }
    
    public function salary(Request $request){
        if($request){
            return view('form.salary'); 
        }
                     
    }
    
    public function saveSalary(){
        //code for saving
        
        //
        return redirect('document');
    }
}
