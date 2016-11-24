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
use Illuminate\Support\Facades\DB;


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
        $keyword = Session::get('keyword');

        $documents = Tracking::where('prepared_by',$id)
            ->where(function($q) use ($keyword){
                $q->where('route_no','like',"%$keyword%")
                  ->orwhere('description','like',"%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);

        return view('document.list',['documents' => $documents ]);

    }

    public function search(Request $request){
        Session::put('keyword',$request->keyword);
        return self::index();
//        return $request->keyword;
    }

    public function accept(Request $request){
        return view('document.accept');
    }

    public function saveDocument(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $route_no = $request->route_no;
        $last = 0;

        $doc = Tracking::where('route_no',$route_no)
                ->orderBy('id','desc')
                ->first();

        if($doc){
            $document = Tracking_Details::where('route_no',$route_no)
                ->orderBy('id','desc')
                ->first();
            if($document):
                Tracking_Details::where('route_no',$route_no)
                    ->where('received_by',$document->received_by)
                    ->update(['status'=> 1]);
                $received_by = $document->received_by;
            else:
                $received_by = $doc->prepared_by;
            endif;
            $q = new Tracking_Details();
            $q->route_no = $route_no;
            $q->date_in = date('Y-m-d H:i:s');
            $q->received_by = $id;
            $q->delivered_by = $received_by;
            $q->action = $request->remarks;
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
            case "ROUTE" :
                return "Routing Slip";
            case "PRC":
                return "Purchase Request - Cash Advance Purchase";
            case "TEV":
                return "Traveling Expense Voucher";
            case "PRR":
                return "Purchase Request - Regular Purchase";
            case "CDO" :
                return "Application for CDO, Leave";
            case "PO":
                return "Purchase Order";
            case "JUST_LETTER" :
                return "Justification Letter";
            case "OFFICE_ORDER":
                return "Office Order";
            case "WORKSHEET" :
                return "Activity Worksheet";
            case "ALL" :
                return "All Documents";
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

    public function track($route_no)
    {
        $document = Tracking_Details::where('route_no',$route_no)
            ->orderBy('id','asc')
            ->get();
        Session::put('route_no', $route_no);
        return view('document.track',['document' => $document]);
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

    public static function timeDiff($date_in,$date_out=null)
    {
        $date_now = isset($date_out) ? $date_out : date('Y-m-d H:i:s');

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

    public static function checkLastRecord($route_no)
    {
        $document = Tracking_Details::where('route_no',$route_no)
                        ->orderBy('id','desc')
                        ->first();
        return $document->id;
    }

    public static function getNextRecord($route_no,$id)
    {
        $document = DB::table('tracking_details')
                ->where('id', ( DB::raw("(SELECT min(id) FROM tracking_details WHERE id > $id)")) )
                ->get();
        $new_array[] = json_decode(json_encode($document), true);
        return $new_array[0];
    }



    function deliveredDocument(Request $request){
        $doc_type = $request->doc_type;
        $id = Auth::user()->id;

        $str = $request->daterange;
        $temp1 = explode('-',$str);
        $temp2 = array_slice($temp1, 0, 1);
        $tmp = implode(',', $temp2);
        $startdate = date('Y-m-d H:i:s',strtotime($tmp));

        $temp3 = array_slice($temp1, 1, 1);
        $tmp = implode(',', $temp3);
        $enddate = date('Y-m-d H:i:s',strtotime($tmp));

        Session::put('startdate',$startdate);
        Session::put('enddate',$enddate);
        Session::put('doc_type',self::docTypeName($doc_type));
        Session::put('doc_type_code',$doc_type);
        if($doc_type!='ALL'){
            $documents = DB::table('tracking_details')
                ->leftJoin('tracking_master', 'tracking_details.route_no', '=', 'tracking_master.route_no')
                ->where('doc_type',$doc_type)
                ->where('delivered_by',$id)
                ->where('received_by','!=',$id)
                ->where('date_in','>=',$startdate)
                ->where('date_in','<=',$enddate)
                ->orderBy('date_in','asc')
                ->get();
        }else{
            $documents = DB::table('tracking_details')
                ->leftJoin('tracking_master', 'tracking_details.route_no', '=', 'tracking_master.route_no')
                ->where('delivered_by',$id)
                ->where('received_by','!=',$id)
                ->where('date_in','>=',$startdate)
                ->where('date_in','<=',$enddate)
                ->orderBy('date_in','asc')
                ->get();
        }

        Session::put('deliveredDocuments',$documents);
        return view('document.delivered',['documents' => $documents, 'doc_type' => $doc_type, 'daterange' => $request->daterange]);
    }

    function receivedDocument(Request $request){
        $doc_type = $request->doc_type;
        $id = Auth::user()->id;

        $str = $request->daterange;
        $temp1 = explode('-',$str);
        $temp2 = array_slice($temp1, 0, 1);
        $tmp = implode(',', $temp2);
        $startdate = date('Y-m-d H:i:s',strtotime($tmp));

        $temp3 = array_slice($temp1, 1, 1);
        $tmp = implode(',', $temp3);
        $enddate = date('Y-m-d H:i:s',strtotime($tmp));

        Session::put('startdate',$startdate);
        Session::put('enddate',$enddate);
        Session::put('doc_type',self::docTypeName($doc_type));
        Session::put('doc_type_code',$doc_type);
        if($doc_type!='ALL'){
            $documents = DB::table('tracking_details')
                ->leftJoin('tracking_master', 'tracking_details.route_no', '=', 'tracking_master.route_no')
                ->where('doc_type',$doc_type)
                ->where('received_by',$id)
                ->where('delivered_by','!=',$id)
                ->where('date_in','>=',$startdate)
                ->where('date_in','<=',$enddate)
                ->orderBy('date_in','asc')
                ->get();
        }else{
            $documents = DB::table('tracking_details')
                ->leftJoin('tracking_master', 'tracking_details.route_no', '=', 'tracking_master.route_no')
                ->where('received_by',$id)
                ->where('delivered_by','!=',$id)
                ->where('date_in','>=',$startdate)
                ->where('date_in','<=',$enddate)
                ->orderBy('date_in','asc')
                ->get();
        }

        Session::put('receivedDocuments',$documents);
        return view('document.received',['documents' => $documents, 'doc_type' => $doc_type, 'daterange' => $request->daterange]);
    }

}
