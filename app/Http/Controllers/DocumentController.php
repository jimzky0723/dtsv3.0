<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tracking;
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
}
