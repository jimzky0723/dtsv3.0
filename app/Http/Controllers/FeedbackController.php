<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/10/2017
 * Time: 10:30 AM
 */

namespace App\Http\Controllers;


use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $name = $request->user()->fname." ".$request->user()->mname." ".$request->user()->lname;
        if($request->isMethod('get')){
            return view('feedback.feedback')->with('name',$name);
        }
        if($request->isMethod('post')){
            $feedback = new Feedback();
            $feedback->userid = $request->user()->id;
            $feedback->subject = $request->input('subject');
            $feedback->telno = $request->input('telno');
            $feedback->message = $request->input('message');
            $feedback->save();
            return redirect('feedback_ok')->with('name',$name);
        }
    }
    public function view_feedback(Request $request){
        if($request->isMethod('get')) {
            $feedbacks = Feedback::paginate(20);
            return view('feedback.list')->with('feedbacks',$feedbacks);
        }
    }
    public function message(Request $request)
    {
        $feedback = Feedback::where('id', $request->input('id'))->first();
        return view('feedback.message')->with('feedback',$feedback);
    }
}