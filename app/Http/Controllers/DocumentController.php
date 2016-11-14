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
    
    public function index(){
        Session::put('tracking',Tracking::all());
        return view('document.list');
    }

   
    public function accept(){
        return view('document.accept');   
    }
}
