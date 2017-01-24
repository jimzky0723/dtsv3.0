<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Tracking_Details;
use App;
use App\prr_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Users;
use App\Section;
use App\Division;
use App\Designation;
use App\Calendar;
use App\prr_logs;

class PurchaseRequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function prCashAdvance(){
        return view('form.prCashAdvance');
    }

    public function append(){
        return view('prr.append_input');
    }

    public function savePrCashAdvance(Request $request){
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        $prepared_date = date('Y-m-d H:i:s');

        //ADD TRACKING MASTER
        $tracking = new Tracking();
        $tracking->route_no = $route_no;
        $tracking->doc_type = $request->get('doc_type');
        $tracking->prepared_date = $prepared_date;
        $tracking->prepared_by = $request->get('prepared_by');
        $tracking->amount = $request->get('amount');
        $tracking->description = $request->get('description');
        $tracking->source_fund = $request->get('charge_to');
        $tracking->requested_by = $request->get('requested_by');
        $tracking->save();

        //ADD TRACKING DETAILS
        $q = new Tracking_Details();
        $q->route_no = $route_no;
        $q->date_in = $prepared_date;
        $q->received_by = $request->get('prepared_by');
        $q->delivered_by = $request->get('prepared_by');
        $q->action = $request->get('description');
        $q->save();

        return redirect("/document");
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
        return view('prr.prr_form',['section_head' => $section_head, 'division_head' => $division_head]);
    }

    public function getDesignation($id){
        $designation_id = Users::find($id)->designation;
        return Designation::where('id','=',$designation_id)->first()->description;
    }

    public function savePrRegularPurchase(Request $request)
    {
        $prepared_date = $request->get("prepared_date");
        $prepared_date =  substr($prepared_date,6,4).'-'.substr($prepared_date,0,2).'-'.substr($prepared_date,3,2).' '.date('H:i:s');
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        Session::put('route_no', $route_no);

        //ADD PRR_LOGS
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');
        $prr_logs = new prr_logs();
        $prr_logs->prr_logs_key = $prr_logs_key;
        $prr_logs->route_no = $route_no;
        $prr_logs->updated_date = $updated_date;
        $prr_logs->updated_by = Auth::user()->id;
        $prr_logs->status = 1;
        $prr_logs->save();

        //ADD PRR TABLE
        $count = 0;
        foreach($request->get('qty') as $pr){
            if($request->get('issue')[$count] && $request->get('description')[$count] && $request->get('unit_cost')[$count] && $request->get('estimated_cost')[$count] && $request->get('specification')[$count] != '') {
                $pr = new prr_item();
                $pr->route_no = $route_no;
                $pr->prr_logs_key = $prr_logs_key;
                $pr->qty = $request->get('qty')[$count];
                $pr->issue = $request->get("issue")[$count];
                $pr->description = $request->get("description")[$count];
                $pr->specification = $request->get("specification")[$count];
                $pr->unit_cost = $request->get("unit_cost")[$count];
                $pr->estimated_cost = $request->get("estimated_cost")[$count];
                $pr->status = 1;
                $pr->save();
            }
            $count++;
        }

        //ADD TRACKING MASTER
        $tracking = new Tracking();
        $tracking->route_no = $route_no;
        $tracking->doc_type = $request->get('doc_type');
        $tracking->prepared_date = $prepared_date;
        $tracking->prepared_by = $request->get('prepared_by');
        $tracking->division_head = $request->get('division_head');
        $tracking->amount = $request->get('amount');
        $tracking->purpose = $request->get('purpose');
        $tracking->source_fund = $request->get('charge_to');
        $tracking->requested_by = $request->get('requested_by');
        $tracking->save();

        //ADD TRACKING DETAILS
        $q = new Tracking_Details();
        $q->route_no = $route_no;
        $q->date_in = $prepared_date;
        $q->received_by = $request->get('prepared_by');
        $q->delivered_by = $request->get('prepared_by');
        $q->action = $request->get('purpose');
        $q->save();

        Session::put('added',true);
        return redirect("/document");
    }

    public function prr_pdf(){
        $prr_logs = prr_logs::where('route_no',Session::get('route_no'))
                            ->where('status',1)
                            ->first()
                            ->prr_logs_key;
        $item = prr_item::where('route_no','=',Session::get('route_no'))
                            ->where('status',1)
                            ->where('prr_logs_key',$prr_logs)
                            ->get();

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

    public function prr(){
        $prr_logs = prr_logs::where('route_no',Session::get('route_no'))
                    ->where('status',1)
                    ->first()
                    ->prr_logs_key;
        $item = prr_item::where('route_no','=',Session::get('route_no'))
                                    ->where('status',1)
                                    ->where('prr_logs_key',$prr_logs)
                                    ->get();

        $tracking = Tracking::where('route_no',Session::get('route_no'))->first();

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
        return view('prr.prr',['section_head' => $section_head, 'division_head' => $division_head,'item' => $item,'tracking' => $tracking]);
    }

    public function update_prr(Request $request){

        $route_no = Session::get('route_no');

        //UPDATE PRR TABLE
        prr_item::where("route_no",$route_no)
                            ->update(['status' => 0]);
        //UPDATE STATUS IN PRR LOGS
        prr_logs::where("route_no",$route_no)
                ->update(['status' => 0]);

        //ADD PRR_LOGS
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');

        $prr_logs = new prr_logs();
        $prr_logs->prr_logs_key = $prr_logs_key;
        $prr_logs->route_no = $route_no;
        $prr_logs->updated_date = $updated_date;
        $prr_logs->updated_by = Auth::user()->id;
        $prr_logs->status = 1;
        $prr_logs->save();

        //ADD ANOTHER IN PRR TABLE
        $count = 0;
        foreach($request->get('qty') as $pr){
            if($request->get('issue')[$count] && $request->get('description')[$count] && $request->get('unit_cost')[$count] && $request->get('estimated_cost')[$count] && $request->get('specification')[$count] != '') {
                $pr = new prr_item();
                $pr->route_no = $route_no;
                $pr->prr_logs_key = $prr_logs_key;
                $pr->qty = $request->get('qty')[$count];
                $pr->issue = $request->get("issue")[$count];
                $pr->description = $request->get("description")[$count];
                $pr->specification = $request->get("specification")[$count];
                $pr->unit_cost = $request->get("unit_cost")[$count];
                $pr->estimated_cost = $request->get("estimated_cost")[$count];
                $pr->status = 1;
                $pr->save();
            }
            $count++;
        }

        return redirect("/prr");
    }

    public function update_history(){
        $route_no = Session::get('route_no');

        $tracking = Tracking::where('route_no','=',Session::get('route_no'))->first();
        $user = Users::where('id','=',$tracking->prepared_by)->first();
        $section = Section::where('id','=',$user->section)->first();
        $division = Division::where('id','=',$user->division)->first();
        $prr_logs = prr_logs::where("route_no",$route_no)
                            ->where('status',0)
                            ->get();


        return view("prr.update_history",['tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division,"prr_logs" => $prr_logs]);
    }
}
