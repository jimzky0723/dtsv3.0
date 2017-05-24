<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Calendar;
use App;

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
        $request_start = $request->get('start');
        $calendar = Calendar::where('event_id',$request->get('event_id'))->first();
        $difference = strtotime($calendar->end) - strtotime($calendar->start);
        $day_range = floor($difference / (60 * 60 * 24));
        $end = date_create($request_start);
        date_add($end, date_interval_create_from_date_string($day_range.'days'));
        $day_end = date_format($end, 'Y-m-d');
        if($request->get('type') == 'drop') {
            if($day_range >= 2)
            {
                return Calendar::where('event_id', $request->get('event_id'))
                    ->update(['start' => $request_start,'end' => $day_end]);
            } else
            {
                return Calendar::where('event_id', $request->get('event_id'))
                    ->update(['start' => $request_start]);
            }
        }
        else
            return Calendar::where('event_id',$request->get('event_id'))
                ->update(['end' => $request->get('end')]);
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

    public function calendar_pdf()
    {
        $event = $users = DB::table('calendar')
            ->orderBy('start', 'asc')
            ->get();
        $display = view("calendar.calendar_pdf",['event' => $event]);
        $pdf = App::make('dompdf.wrapper');
        /*$pdf->loadHTML($display)->setPaper('a4', 'landscape');*/
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }

    public function calendar_img()
    {
        $event = $users = DB::table('calendar')
            ->orderBy('start', 'asc')
            ->get();
        $display = view("calendar.calendar_picture");
        $pdf = App::make('dompdf.wrapper');
        /*$pdf->loadHTML($display)->setPaper('a4', 'landscape');*/
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }

}
