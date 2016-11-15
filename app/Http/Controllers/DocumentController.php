<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Tracking;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Tracking_Filter;
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
            ->get();
        return view('document.list',['documents' => $documents ]);

    }

    public function accept(Request $request){
        if($request->user()->user_priv == 1) {
            return view('document.accept');
        }
    }

    public function session(Request $request){
        Session::put('name','Lourence Rex');
        return Session::get('name');
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

    public function show($route){
        $document = Tracking::where('route_no',$route)
                        ->first();
        return view('document.info',['document' => $document]);
    }

}
