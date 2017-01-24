<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Release;
use App\Section;

class ReleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addRelease(Request $req){
        $rel = new Release();
        $rel->route_no = $req->route_no;
        $rel->reported_by = Auth::user()->id;
        $rel->division_id = $req->division;
        $rel->section_id = $req->section;
        $rel->date_reported = date('Y-m-d H:i:s');
        $rel->save();

        $status='releaseAdded';
        return redirect()->back()->with('status',$status);
    }

    public function addReport($id)
    {
        Release::where('id',$id)
            ->update(['status'=> 1]);
        $status='reportAdded';
        return redirect()->back()->with('status',$status);
    }
    static function getSections($id){
        $sections = Section::where('division',$id)->orderBy('description','asc')->get();
        return $sections;
    }

    static function hourDiff($start_date,$end_date=null)
    {
        if(!$end_date)
        {
            $end_date = date('Y-m-d H:i:s');
        }

        $timeout = date('H:i',strtotime($end_date));
        $timein = date('H:i',strtotime($start_date));

        if(strtotime($timeout) > strtotime('17:00')){
            $end_date = date('Y-m-d 17:00:00',strtotime($end_date));
        }else if(strtotime($timeout) < strtotime('08:00')){
            $end_date = date('Y-m-d 08:00:00',strtotime($end_date));
        }

        if(strtotime($timein) < strtotime('08:00')){
            $start_date = date('Y-m-d 08:00:00',strtotime($start_date));
        }else if(strtotime($timein) > strtotime('17:00')){
            $start_date = date('Y-m-d 17:00:00',strtotime($start_date));
        }

        $time = self::timeDiffHours($start_date,$end_date);
        $times = $time['hours'] + ($time['days']*9);

        if($time['hours'] > 12){
            $tmp_end = date('Y-m-d 17:00:00',strtotime($start_date));

            $tmp1 = self::timeDiffHours($start_date,$tmp_end);

            $tmp_start = date('Y-m-d 08:00:00',strtotime($end_date));
            $tmp2 = self::timeDiffHours($tmp_start,$end_date);

            $times = $tmp1['hours'] + $tmp2['hours'];
        }

        return $times;
    }
    static function timeDiffHours($start_date,$end_date){
        $start_time = strtotime($start_date);
        $end_time = strtotime($end_date);
        $difference = $end_time - $start_time;

        $seconds = $difference % 60;            //seconds
        $difference = floor($difference / 60);

        $min = $difference % 60;              // min
        $difference = floor($difference / 60);

        $hours = $difference % 24;  //hours
        $difference = floor($difference / 24);

        $days = $difference % 30;  //days
        $difference = floor($difference / 30);

        $month = $difference % 12;  //month
        $difference = floor($difference / 12);

        $data['hours'] = $hours;
        $data['days'] = $days;
        $data['min'] = $min;
        return $data;
    }

    function viewReported(){
        $section = Auth::user()->section;
        $report = Release::where('status',1)
            ->where('section_id',$section)
            ->paginate(20);
        return view('document.reported',['reported'=>$report]);
    }
}
