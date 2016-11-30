<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/18/2016
 * Time: 8:56 AM
 */

namespace App\Http\Controllers;
use App\Designation;
use App\Division;
use Illuminate\Http\Request;
use App\User;
use App\Section;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_priv');
        $this->middleware('auth');
    }
    public function users(Request $request) {
        $users = User::where('id','!=', $request->user()->id)->paginate(10);
        return view('users.users')
                ->with('users',$users);
    }
    public function user_create(Request $request){

        if($request->isMethod('get')){
            $div = Division::all();
            $dis = Designation::all();
            return view('users.new')
                ->with('div', $div)
                ->with('dis', $dis);
        }
        if($request->isMethod('post')){
            $user = User::where('username', $request->input('username'))->first();
            if(isset($user) and count($user) > 0) {
                return redirect('users')->with('used','Username is already used.');
            }
            $user = new User();
            $user->fname = $request->input('fname');
            $user->mname = $request->input('mname');
            $user->lname = $request->input('lname');
            $user->password = bcrypt($request->input('password'));
            $user->email = "dummy";
            $user->username = $request->input('username');
            $user->designation = $request->input('designation');
            $user->division = $request->input('division');
            $user->section = $request->input('section');
            $user->user_priv = $request->input('user_type');
            $user->save();
            return redirect('users');
        }
    }
    public function user_edit(Request $request){

        $user = User::find($request->input('id'));
        //GET
        if($request->isMethod('get')){
            if(isset($user) and count($user) > 0) {
                return view('users.edit')
                    ->with('user', $user)
                    ->with('section',Section::all())
                    ->with('division',Division::all())
                    ->with('designation',Designation::all());
            }
        }
        //POST
        if($request->isMethod('post')){
            $username = '';
            if($user->username == $request->input('username')) {
                $username = $request->input('username');
            } else {
                $user = User::where('username', $request->input('username'))->first();
                if(isset($user) and count($user) > 0) {
                    return redirect('users')->with('used','Username is already used.');
                }
            }

            $user = User::find($request->input('id'));
            $user->fname = $request->input('fname');
            $user->mname = $request->input('mname');
            $user->lname = $request->input('lname');
            $user->username = $username;
            $user->designation = $request->input('designation');
            $user->email = "dummy";
            $user->division = $request->input('division');
            $user->section = $request->input('section');
            $user->user_priv = $request->input('user_type');
            $user->save();
            return redirect('users');
        }
    }
    public function section(Request $request) {
        $section = Section::where('division',$request->input('id'))->get();
        if(isset($section) and count($section) > 0) {
            return view('users.tr')->with('section', $section);
        }
    }

    public function search(Request $request) {
        $user = User::where('fname','LIKE', "%". $request->input('search') ."%")
                    ->orWhere('mname', 'LIKE', "%". $request->input('search')."%")
                    ->orWhere('lname', 'LIKE', "%". $request->input('search'). "%")
                    ->orWhere('username' ,'LIKE', "%". $request->input('search'). "%")
                    ->paginate(10);
        if(isset($user) and count($user) > 0) {
            return view('users.users')->with('users',$user);
        }
        return view('users.users')->with('users', $user);
    }
    public function remove(Request $request){
        $user = User::find($request->input('id'));
        if(isset($user) and count($user) > 0){
            $user->delete();
            return json_encode(array('status' => 'ok'));
        }
    }
    public function check_user(Request $request)
    {
        $user = User::where('username', $request->input('username'))->first();
        if (isset($user) and count($user) > 0) {
            return json_encode(array('status' => 'ok'));
        }
        return json_encode(array('status' => 'false'));
    }
}