<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/18/2016
 * Time: 8:56 AM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function users(Request $request) {
        $users = User::where('id','<>', $request->user()->id)->paginate(10);
        return view('users.users')->with('users',$users);
    }
    public function create(Request $request) {
        return view('users.new');
    }
}