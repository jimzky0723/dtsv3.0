<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Tracking_Details;
use App;
use App\Purchase_Request_RP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Users;
use App\Section;
use App\Division;
use App\Designation;
use App\Calendar;

class PurchaseRequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user_priv');
    }

    public function prCashAdvance(){
        return view('form.prCashAdvance');
    }

    public function savePrCashAdvance(Request $request){
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        $prepared_date = date('Y-m-d H:i:s');
        return $this->saveDatabase($route_no, $request->get('doctype'), $prepared_date, $request->get('preparedby'), $request->get('itemdescription'), $request->get('amount'), "", "", $request->get('chargeto'), $request->get('requestedby'), "", "", "", "", "", "", "", "", "", "", "", "", "");
    }

    public function prRegularPurchase(){
        $section = Section::all();
        foreach($section as $row){
            $user = Users::where('id','=',$row->head)->first();
            $section_head[] = $user;
        }
        $division = Division::all();
        foreach($division as $row){
            $user = Users::where('id','=',$row->head)->first();
            $division_head[] = $user;
        }
        return view('form.prRegularPurchase',['section_head' => $section_head, 'division_head' => $division_head]);
    }

    public function getDesignation($id){
        $designation_id = Users::find($id)->designation;
        return Designation::where('id','=',$designation_id)->first()->description;
    }

    public function savePrRegularPurchase(Request $request)
    {
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        Session::put('route_no', $route_no);
        $prepared_date = date('Y-m-d H:i:s');
        $count = 0;
        foreach($request->get('qty') as $pr){
            if($request->get('issue')[$count] && $request->get('description')[$count] && $request->get('unit_cost')[$count] && $request->get('estimated_cost')[$count] && $request->get('specification')[$count] != '') {
                $pr = new Purchase_Request_RP();
                $pr->route_no = $route_no;
                $pr->qty = $request->get('qty')[$count];
                $pr->issue = $request->get("issue")[$count];
                $pr->description = $request->get("description")[$count];
                $pr->specification = $request->get("specification")[$count];
                $pr->unit_cost = $request->get("unit_cost")[$count];
                $pr->estimated_cost = $request->get("estimated_cost")[$count];
                $pr->save();
            }
            $count++;
        }
        return $this->saveDatabase($route_no, $request->get('doc_type'), $prepared_date, $request->get('prepared_by'), $request->get('division_head'), $request->get('amount'), "", $request->get('purpose'), $request->get('charge_to'), $request->get('requested_by'), "", "", "", "", "", "", "", "", "", "", "", "", "");
    }

    public function saveDatabase($route_no, $doc_type, $prepared_date, $prepare_by, $description, $amount, $pr_no, $purpose, $source_fund, $requested_by, $route_to, $route_from, $supplier, $event_date, $event_location, $event_particpant, $cdo_applicant, $cdo_day, $event_daterange, $payee, $item, $dv_no, $remember_token)
    {
        $tracking = new Tracking();
        $tracking->route_no = $route_no;
        $tracking->doc_type = $doc_type;
        $tracking->prepared_date = $prepared_date;
        $tracking->prepared_by = $prepare_by;
        $tracking->description = $description;
        $tracking->amount = $amount;
        $tracking->pr_no = $pr_no;
        $tracking->purpose = $purpose;
        $tracking->source_fund = $source_fund;
        $tracking->requested_by = $requested_by;
        $tracking->route_to = $route_to;
        $tracking->route_from = $route_from;
        $tracking->supplier = $supplier;
        $tracking->event_date = $event_date;
        $tracking->event_location = $event_location;
        $tracking->event_participant = $event_particpant;
        $tracking->cdo_applicant = $cdo_applicant;
        $tracking->cdo_day = $cdo_day;
        $tracking->event_daterange = $event_daterange;
        $tracking->payee = $payee;
        $tracking->item = $item;
        $tracking->dv_no = $dv_no;
        $tracking->remember_token = $remember_token;
        $tracking->save();

        $q = new Tracking_Details();
        $q->route_no = $route_no;
        $q->date_in = $prepared_date;
        $q->received_by = $prepare_by;
        $q->delivered_by = $prepare_by;
        $q->action = $description;
        $q->save();

        if($doc_type == "PRR")
            return redirect("/pdf_pr");
        else
            return redirect("/document");
    }

    public function pdf_pr(){
        $item = Purchase_Request_RP::where('route_no','=',Session::get('route_no'))->get();
        $tracking = Tracking::where('route_no','=',Session::get('route_no'))->first();
        $user = Users::where('id','=',$tracking->prepared_by)->first();
        $section = Section::where('id','=',$user->section)->first();
        $division = Division::where('id','=',$user->division)->first();

        $display = view("pdf.PurchaseRequestPDF",['item' => $item,'tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division]);
        $pdf = App::make('dompdf.wrapper');
        /*$pdf->loadHTML($display)->setPaper('a4', 'landscape');*/
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }

    public function hello(){
        $data = DB::table('Purchase_Request')
            ->latest()
            ->first()
            ->id;
        return Response::json($data);
    }
    public function calendar(Request $request){
        $calendar = new Calendar();
        $calendar->title = $request->get('title');
        $calendar->start = $request->get('start');
        $calendar->backgroundColor = $request->get('background_color');
        $calendar->borderColor = $request->get('border_color');
        $calendar->save();

        return redirect('/calendar');
    }
}
