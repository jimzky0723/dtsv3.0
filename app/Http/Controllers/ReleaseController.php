<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Release;
use App\Section;
use DateTime;

class ReleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addRelease(Request $req){
        if($req->op > 0){
            $id = $req->op;
            $update = array(
                'division_id' => $req->division,
                'section_id' => $req->section
            );
            Release::where('id',$id)->update([
                'division_id' => $req->division,
                'section_id' => $req->section
            ]);

            $status='releaseUpdated';
            return redirect()->back()->with('status',$status);
        }
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

    public function addReport($id,$cancel=null)
    {
        if($cancel)
        {
            Release::where('id',$id)
                ->update(['status'=> 0]);
            $status='reportCancelled';
            return redirect()->back()->with('status',$status);
        }

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
        if(!$end_date){
            $end_date = date('Y-m-d H:i:s');
        }
        $now = new DateTime();
        $initialDate =  $start_date;    //start date and time in YMD format
        $finalDate = $end_date;    //end date and time in YMD format
        $holiday = array();   //holidays as array
        $noofholiday  = sizeof($holiday);     //no of total holidays

        //create all required date time objects
        $firstdate = $now::createFromFormat('Y-m-d H:i:s',$initialDate);
        $lastdate = $now::createFromFormat('Y-m-d H:i:s',$finalDate);
        if($lastdate > $firstdate)
        {
            $first = $firstdate->format('Y-m-d');
            $first = $now::createFromFormat('Y-m-d H:i:s',$first." 00:00:00" );
            $last = $lastdate->format('Y-m-d');
            $last = $now::createFromFormat('Y-m-d H:i:s',$last." 23:59:59" );
            $workhours = 0;   //working hours

            for ($i = $first;$i<=$last;$i->modify('+1 day') )
            {
                $holiday = false;
                for($k=0;$k<$noofholiday;$k++)   //excluding holidays
                {
                    if($i == $holiday[$k])
                    {
                        $holiday = true;
                        break;
                    }   }
                $day =  $i->format('l');
                if($day === 'Saturday' || $day === 'Sunday')  //excluding saturday, sunday
                    $holiday = true;

                if(!$holiday)
                {
                    $ii = $i->format('Y-m-d');
                    $f = $firstdate->format('Y-m-d');
                    $l = $lastdate->format('Y-m-d');
                    if($l == $f )
                    {
                        $workhours +=self::sameday($firstdate,$lastdate);
                    }
                    else if( $ii===$f){
                        $workhours +=self::firstday($firstdate);
                    }
                    else if ($l ===$ii){
                        $workhours +=self::lastday($lastdate);
                    }
                    else {
                        $workhours +=8;
                    }

                }
            }

            return $workhours;   //echo the hours
        }else{
            return 0;
        }
    }

    static function duration($start_date,$end_date=null)
    {
        if(!$end_date){
            $end_date = date('Y-m-d H:i:s');
        }
        $now = new DateTime();
        $initialDate =  $start_date;    //start date and time in YMD format
        $finalDate = $end_date;    //end date and time in YMD format
        $holiday = array();   //holidays as array
        $noofholiday  = sizeof($holiday);     //no of total holidays

        //create all required date time objects
        $firstdate = $now::createFromFormat('Y-m-d H:i:s',$initialDate);
        $lastdate = $now::createFromFormat('Y-m-d H:i:s',$finalDate);
        if($lastdate > $firstdate)
        {
            $first = $firstdate->format('Y-m-d');
            $first = $now::createFromFormat('Y-m-d H:i:s',$first." 00:00:00" );
            $last = $lastdate->format('Y-m-d');
            $last = $now::createFromFormat('Y-m-d H:i:s',$last." 23:59:59" );
            $workhours = 0;   //working hours
            $count = 0;
            for ($i = $first;$i<=$last;$i->modify('+1 day') )
            {
                $holiday = false;
                for($k=0;$k<$noofholiday;$k++)   //excluding holidays
                {
                    if($i == $holiday[$k])
                    {
                        $holiday = true;
                        break;
                    }   }
                $day =  $i->format('l');
                if($day === 'Saturday' || $day === 'Sunday')  //excluding saturday, sunday
                    $holiday = true;
                if(!$holiday)
                {
                    $count++;
                    $ii = $i->format('Y-m-d');
                    $f = $firstdate->format('Y-m-d');
                    $l = $lastdate->format('Y-m-d');
                    if($l == $f )
                    {
                        $workhours +=self::sameday($firstdate,$lastdate);
                    }
                    else if( $ii===$f){
                        $workhours +=self::firstday($firstdate);
                    }
                    else if ($l ===$ii){
                        $workhours +=self::lastday($lastdate);
                    }
                    else {
                        $workhours +=8;
                    }

                }
            }
            //return $workhours;
            $obj = self::secondsToTime($workhours * 3600);
            $day = $obj['d'];
            $hour = $obj['h'];
            $min = $obj['m'];
            $result = '';
            if($hour > 24 || $day > 0){
                return $count-1 . ' days';
            }
            if($day!=0) {
                if($day == 1){
                    $result.=$day.' day ';
                }else{
                    $result.=$day.' days ';
                }
            }


            if($hour!=0) {
                if($hour == 1){
                    $result.=$hour.' hour ';
                }else{
                    $result.=$hour.' hours ';
                }
            }
            if($hour != 0 && $min > 0)
            {
                $result .= 'and ';
            }

            if($min!=0) {
                if($min == 1){
                    $result.=$min.' minute ';
                }else{
                    $result.=$min.' minutes ';
                }
            }

            if($min<1 && $hour==0){
                $result = 'Less than a minute';
            }

            return $result;

        }else{
            return 0;
        }
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

    static function sameday($firstdate,$lastdate)
    {
        $fmin = $firstdate->format('i');
        $fhour = $firstdate->format('H');
        $lmin = $lastdate->format('i');
        $lhour = $lastdate->format('H');
        if($fhour >=12 && $fhour <13)
            $fhour = 13;
        if($fhour < 8)
            $fhour = 8;
        if($fhour >= 17)
            $fhour =17;
        if($lhour<8)
            $lhour=8;
        if($lhour>=12 && $lhour<13)
            $lhour = 13;
        if($lhour>=17)
            $lhour = 17;
        if($lmin == 0)
            $min = ((60-$fmin)/60)-1;
        else {
            $min = ($lmin-$fmin)/60;
        }
        $left = ($lhour-$fhour) + $min;

        if($fhour >=8 && $fhour <=12 && $lhour >= 13 && $lhour <= 17){
            return $left-1;
        }
        return $left;
    }

    static function firstday($firstdate)   //calculation of hours of first day
    {
        $stmin = $firstdate->format('i');
        $sthour = $firstdate->format('H');
        if($sthour<8)   //time before morning 8
            $lochour = 8;
        else if($sthour>17)
            $lochour = 0;
        else if($sthour >=12 && $sthour<13)
            $lochour = 4;
        else
        {
            $lochour = 17-$sthour;
            if($sthour<=13)
                $lochour-=1;
            if($stmin == 0)
                $locmin =0;
            else
                $locmin = 1-( (60-$stmin)/60);   //in hours
            $lochour -= $locmin;
        }
        return $lochour;
    }

    static function lastday($lastdate)   //calculation of hours of last day
    {
        $stmin = $lastdate->format('i');
        $sthour = $lastdate->format('H');
        if ($sthour >= 17)   //time after 18
            $lochour = 8;
        else if ($sthour < 8)   //time before morning 8
            $lochour = 0;
        else if ($sthour >= 12 && $sthour < 13)
            $lochour = 4;
        else {
            $lochour = $sthour - 8;
            $locmin = $stmin / 60;   //in hours
            if ($sthour > 13)
                $lochour -= 1;
            $lochour += $locmin;
        }

        return $lochour;
    }

    static function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj;
    }

        function viewReported(){
        $section = Auth::user()->section;
        $report = Release::where('status',1)
            ->where('section_id',$section)
            ->paginate(20);
        return view('document.reported',['reported'=>$report]);
    }
}
