<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemLogs;
use App\Http\Requests;
use App\Users;
use App\Tracking;
use Illuminate\Support\Facades\Auth;

class SystemController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_priv');
    }

    static function logDocument($user_id,$id)
    {
        $description = Tracking::find($id)->route_no;
        $user = Users::find($user_id);
        $activity = "Updated";
        $q = new SystemLogs();
        $q->user_id = $user_id;
        $q->name = $user->fname.' '.$user->lname;
        $q->activity = $activity;
        $q->description = $description;
        $q->save();

        return true;
    }

    static function logDefault($act,$desc="")
    {
        $user = Users::find(Auth::user()->id);
        $q = new SystemLogs();
        $q->user_id = $user->id;
        $q->name = $user->fname.' '.$user->lname;
        $q->activity = $act;
        $q->description = $desc;
        $q->save();

        return true;
    }

}
