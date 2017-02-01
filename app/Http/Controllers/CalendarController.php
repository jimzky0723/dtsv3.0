<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Calendar;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar(Request $request)
    {
        $calendar = new Calendar();
        $calendar->event_id = $request->get('event_id');
        $calendar->prepared_by = Auth::user()->id;
        $calendar->title = $request->get('title');
        $calendar->start = $request->get('start');
        $calendar->end = $request->get('end');
        $calendar->backgroundColor = $request->get('backgroundColor');
        $calendar->borderColor = $request->get('borderColor');
        $calendar->save();

        return redirect('/calendar');
    }

    public function calendar_update(Request $request)
    {
        if($request->get('type') == 'drop') {
            return Calendar::where('event_id', $request->get('event_id'))
                ->update(['start' => $request->get('start')]);
        }
        else
            return Calendar::where('event_id',$request->get('event_id'))
                ->update(['end' => $request->get('end')]);

        /*return $request->get('start');*/
    }

    public function calendar_event()
    {
        return Calendar::all();
    }

    public function calendar_id($event_id)
    {
        return Calendar::where('event_id',$event_id)->first()->id;
    }

    public function calendar_last_id()
    {
        return Calendar::all()->last()->id;
    }
    public function calendar_delete($event_id)
    {
        Calendar::where('event_id',$event_id)->delete();
    }
}
