<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Tracking;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

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

   
    public function accept(Request $request){
        if($request->user()->user_priv == 1) {
            return view('document.accept');
        }
    }

    public function session(Request $request){
        Session::put('name','Lourence Rex');
        return Session::get('name');
    }
}
