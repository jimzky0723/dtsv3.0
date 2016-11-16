<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tracking;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Tracking_Filter;
use App\Tracking_Details;
use Illuminate\Support\Facades\Session;


class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $id = $user->id;

        $documents = Tracking::where('prepared_by',$id)
            ->orderBy('id','desc')
            ->paginate(10);

        return view('document.list',['documents' => $documents ]);

    }

    public function accept(Request $request){
//        if($request->user()->user_priv == 1) {
//            return view('document.accept');
//        }
        return view('document.accept');
    }

    public function saveDocument(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $route_no = $request->route_no;
        $last = 0;

        $document = Tracking_Details::where('route_no',$route_no)
                ->orderBy('id','desc')
                ->first();

        if($document){
            Tracking_Details::where('route_no',$route_no)
                ->where('received_by',$document->received_by)
                ->update(['status'=> 1]);

            $q = new Tracking_Details();
            $q->route_no = $route_no;
            $q->date_in = date('Y-m-d H:i:s');
            $q->received_by = $id;
            $q->delivered_by = $document->received_by;
            $q->remarks = $request->remarks;
            $q->save();
            return json_encode(array('message' => 'SUCCESS'));
        }else{
            return json_encode(array('message' => 'ERROR'));
        }
    }

    public function cancelRequest($route_no){
        $user = Auth::user();
        $id = $user->id;

        Tracking_Details::where('route_no',$route_no)
                        ->where('received_by',$id)
                        ->orderBy('id','desc')
                        ->first()
                        ->delete();
    }
    public function session(Request $request){
        Session::put('name','Lourence Rex');
        return Session::get('name');
    }

    public static function getDocType($route_no)
    {
        $doc = Tracking::where('route_no',$route_no)->first();;
        return self::docTypeName($doc->doc_type);
    }
    public static function docTypeName($type)
    {
        switch($type){
            case "SAL":
                return "Salary, Honoraria, Stipend, Remittances, CHT Mobilization";
                break;
            case "ROUTE" :
                return "Routing Slip";
                break;
            case "PRC":
                return "Purchase Request - Cash Advance Purchase";
                break;
<<<<<<< HEAD
            case "PRR":
                return "Purchase Request - Regular Purchase";
=======
            case "CDO" :
                return "Application for CDO, Leave";
>>>>>>> 72359f95caa2b1641ff8cabbdfc4beb07028d000
                break;
            default:
                return "N/A";
        }
    }
    public static function isIncluded($doc_type)
    {
        $filter = array(
            'description',
            'amount',
            'pr_no',
            'po_no',
            'purpose',
            'source_fund',
            'requested_by',
            'route_to',
            'route_from',
            'supplier',
            'event_date',
            'event_location',
            'event_participant',
            'cdo_applicant',
            'cdo_day',
            'event_daterange',
            'payee',
            'item',
            'dv_no');
        for($i=0;$i<count($filter);$i++){
            if(!Tracking_Filter::where($filter[$i],1)
                            ->where('doc_type',$doc_type)
                            ->first()){
                $filter[$i] = 'hide';
            }
        }
        return $filter;
    }

    public function show($route_no){
        $document = Tracking::where('route_no',$route_no)
                        ->first();
        Session::put('route_no', $route_no);
        return view('document.info',['document' => $document]);
    }

    public static function pendingDocuments()
    {
        $user = Auth::user();
        $id = $user->id;

        $documents = Tracking_Details::where('received_by',$id)
            ->where('status',0)
            ->orderBy('id','asc')
            ->limit(7)
            ->get();
        return $documents;
    }

    public static function timeDiff($date_in)
    {
        $date_now = date('Y-m-d H:i:s');

        $start_time = strtotime($date_in);
        $end_time = strtotime($date_now);
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

        $year = $difference % 1;  //month
        $difference = floor($difference / 1);

        $result = null;
        if($year!=0) {
            if($year == 1){
                $result.=$year.' Year ';
            }else{
                $result.=$year.' Years ';
            }
        }
        if($month!=0) {
            if($month == 1){
                $result.=$month.' Month ';
            }else{
                $result.=$month.' Months ';
            }
        }
        if($days!=0) {
            if($days == 1){
                $result.=$days.' Day ';
            }else{
                $result.=$days.' Days ';
            }
        }
        if($hours!=0) {
            if($hours == 1){
                $result.=$hours.' Hour ';
            }else{
                $result.=$hours.' Hours ';
            }
        }
        if($min!=0) {
            if($min == 1){
                $result.=$min.' Minute ';
            }else{
                $result.=$min.' Minutes ';
            }
        }
        if($seconds!=0) {
            if($seconds == 1){
                $result.=$seconds.' Second ';
            }else{
                $result.=$seconds.' Seconds ';
            }
        }

        return $result;

    }
    public static function duration($start_date)
    {
        $end_date=date('Y-m-d H:i:s');

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

        $tmp = ($days * 24) + ($month * 24 * 30);
        $hours+=$tmp;
        return $hours;
    }

    public function removePending($id)
    {
        Tracking_Details::where('id',$id)
            ->update(['status'=> 1]);
    }
}
