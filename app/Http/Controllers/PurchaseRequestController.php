<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Tracking_Details;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Users;
use App\Section;
use App\Division;
use App\Designation;
use App\Calendar;
use App\prr_supply;
use App\prr_supply_logs;
use App\prr_meal_specs;
use App\prr_meal_logs;
use App\prr_meal_category;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prCashAdvance()
    {
        return view('form.prCashAdvance');
    }

    public function prr_supply_append()
    {
        return view('prr_supply.prr_supply_append');
    }

    public function savePrCashAdvance(Request $request)
    {
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

    public function prr_supply_form()
    {
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
        return view('prr_supply.prr_supply_form',['section_head' => $section_head, 'division_head' => $division_head]);
    }

    public function getDesignation($id)
    {
        $designation_id = Users::find($id)->designation;
        return Designation::where('id','=',$designation_id)->first()->description;
    }

    public function prr_supply_post(Request $request)
    {
        $prepared_date = $request->get("prepared_date");
        $prepared_date =  substr($prepared_date,6,4).'-'.substr($prepared_date,0,2).'-'.substr($prepared_date,3,2).' '.date('H:i:s');
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        Session::put('route_no', $route_no);

        //ADD PRR_LOGS
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');
        $prr_logs = new prr_supply_logs();
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
                $pr = new prr_supply();
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

        return redirect()->back();
    }

    public function prr_supply_pdf()
    {
        $prr_logs = prr_supply_logs::where('route_no',Session::get('route_no'))
                            ->where('status',1)
                            ->first()
                            ->prr_logs_key;
        $meal = prr_supply::where('route_no','=',Session::get('route_no'))
                            ->where('status',1)
                            ->where('prr_logs_key',$prr_logs)
                            ->get();

        $tracking = Tracking::where('route_no',Session::get('route_no'))->first();
        $user = Users::where('id',$tracking->prepared_by)->first();
        $section = Section::where('id',$user->section)->first();
        $division = Division::where('id',$user->division)->first();

        $display = view("prr_supply.prr_supply_pdf",['meal' => $meal,'tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division]);
        $pdf = App::make('dompdf.wrapper');
        /*$pdf->loadHTML($display)->setPaper('a4', 'landscape');*/
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }

    public function prr_supply_page()
    {
        $prr_logs = prr_supply_logs::where('route_no',Session::get('route_no'))
                    ->where('status',1)
                    ->first()
                    ->prr_logs_key;
        $item = prr_supply::where('route_no','=',Session::get('route_no'))
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
        return view('prr_supply.prr_supply_page',['section_head' => $section_head, 'division_head' => $division_head,'item' => $item,'tracking' => $tracking]);
    }

    public function prr_supply_update(Request $request)
    {

        $route_no = Session::get('route_no');

        //UPDATE PRR SUPPLY TABLE
        prr_supply::where("route_no",$route_no)
                            ->update(['status' => 0]);
        //UPDATE STATUS IN PRR SUPPLY LOGS
        prr_supply_logs::where("route_no",$route_no)
                ->update(['status' => 0]);

        //ADD PRR_LOGS
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');

        $prr_logs = new prr_supply_logs();
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
                $pr = new prr_supply();
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

        Session::put('updated',true);
        return redirect()->back();
    }

    public function prr_supply_history()
    {
        $route_no = Session::get('route_no');

        $tracking = Tracking::where('route_no','=',Session::get('route_no'))->first();
        $user = Users::where('id','=',$tracking->prepared_by)->first();
        $section = Section::where('id','=',$user->section)->first();
        $division = Division::where('id','=',$user->division)->first();
        $prr_logs = prr_supply_logs::where("route_no",$route_no)
                            ->where('status',0)
                            ->get();

        return view("prr_supply.prr_supply_history",['tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division,"prr_logs" => $prr_logs]);
    }


    /// PRR MEAL
    public function prr_meal_form()
    {
        $section = Section::all();
        foreach($section as $row){
            $user = Users::where('id',$row->head)->first();
            $section_head[] = $user;
        }
        $division = Division::all();
        foreach($division as $row){
            $user = Users::where('id',$row->head)->first();
            $division_head[] = $user;
        }
        return view('prr_meal.prr_meal_form',['section_head' => $section_head, 'division_head' => $division_head]);
    }

    public function prr_meal_append()
    {
        return view('prr_meal.prr_meal_append');
    }

    public function prr_meal_post(Request $request)
    {
        $prepared_date = $request->get("prepared_date");
        $prepared_date =  substr($prepared_date,6,4).'-'.substr($prepared_date,0,2).'-'.substr($prepared_date,3,2).' '.date('H:i:s');
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        Session::put('route_no', $route_no);

        //ADD PRR_LOGS MEAL
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');
        $prr_logs = new prr_meal_logs();
        $prr_logs->route_no = $route_no;
        $prr_logs->prr_logs_key = $prr_logs_key;
        $prr_logs->global_title = $request->get('global_title');
        $prr_logs->updated_date = $updated_date;
        $prr_logs->updated_by = Auth::user()->id;
        $prr_logs->status = 1;
        $prr_logs->save();

        //ADD PRR TABLE MEAL SPECS
        $count = 0;
        foreach($request->get('expected') as $pr)
        {
            /*if($request->get('description')[$count] && $request->get('expected')[$count] && $request->get('guaranteed')[$count] && $request->get('date_time')[$count] && $request->get('unit_cost')[$count] && $request->get('estimated_cost')[$count] != '') {
                $pr = new prr_meal_specs();
                $pr->route_no = $route_no;
                $pr->specification = $request->get("specification")[$count];
                $pr->expected = $request->get("expected")[$count];
                $pr->guaranteed = $request->get("guaranteed")[$count];
                $pr->date_time = $request->get("date_time")[$count];
                $pr->category_row = $count;
                $pr->prr_logs_key = $prr_logs_key;
                $pr->status = 1;
                $pr->save();
            }*/
            $pr = new prr_meal_specs();
            $pr->route_no = $route_no;
            $pr->specification = $request->get("specification")[$count];
            $pr->expected = $request->get("expected")[$count];
            $pr->guaranteed = $request->get("guaranteed")[$count];
            $pr->date_time = $request->get("date_time")[$count];
            $pr->category_row = $count;
            $pr->prr_logs_key = $prr_logs_key;
            $pr->status = 1;
            $pr->save();
            $count++;
        }

        //ADD PRR MEAL CATEGORY
        $array_keys = array_keys($request->get('category'));
        $count = 0;
        foreach($array_keys as $row)
        {
            $unit_cost_column = array_keys($request->get('unit_cost')[$row]);
            $estimated_cost_column = array_keys($request->get('estimated_cost')[$row]);
            foreach($request->get('category')[$row] as $category)
            {
                $category_tbl = new prr_meal_category();
                $category_tbl->route_no = $route_no;
                $category_tbl->category_desc = $category;
                $category_tbl->unit_cost = $request->get('unit_cost')[$row][$unit_cost_column[$count]];
                $category_tbl->estimated_cost = $request->get('estimated_cost')[$row][$estimated_cost_column[$count]];
                $category_tbl->category_row = $count;
                $category_tbl->prr_logs_key = $prr_logs_key;
                $category_tbl->status = 1;
                $category_tbl->save();
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

        return redirect()->back();
    }

    public function prr_meal_page()
    {
        $prr_meal_logs = prr_meal_logs::where('route_no',Session::get('route_no'))
                            ->where('status',1)
                            ->first();
        $meal = prr_meal_specs::where('route_no','=',Session::get('route_no'))
                            ->where('status',1)
                            ->where('prr_logs_key',$prr_meal_logs->prr_logs_key)
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
        return view('prr_meal.prr_meal_page',['section_head' => $section_head, 'division_head' => $division_head,'meal' => $meal,'tracking' => $tracking,'prr_meal_logs' => $prr_meal_logs]);
    }

    public function prr_meal_history()
    {
        $route_no = Session::get('route_no');

        $tracking = Tracking::where('route_no',Session::get('route_no'))->first();
        $user = Users::where('id',$tracking->prepared_by)->first();
        $section = Section::where('id',$user->section)->first();
        $division = Division::where('id',$user->division)->first();
        $prr_meal_logs = prr_meal_logs::where("route_no",$route_no)
            ->where('status',0)
            ->get();

        return view("prr_meal.prr_meal_history",['tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division,"prr_meal_logs" => $prr_meal_logs]);
    }

    public function prr_meal_update(Request $request)
    {
        $route_no = Session::get('route_no');

        //UPDATE PRR MEAL TABLE
        prr_meal_specs::where("route_no",$route_no)
            ->update(['status' => 0]);
        //UPDATE STATUS IN PRR MEAL LOGS
        prr_meal_logs::where("route_no",$route_no)
            ->update(['status' => 0]);
        prr_meal_category::where("route_no",$route_no)
            ->update(['status' => 0]);

        //ADD PRR MEAL LOGS
        $updated_date = date('Y-m-d H:i:s');
        $prr_logs_key = "logs".date('Y-') . $request->user()->id . date('mdHis');

        $prr_logs = new prr_meal_logs();
        $prr_logs->prr_logs_key = $prr_logs_key;
        $prr_logs->global_title = $request->get('global_title');
        $prr_logs->route_no = $route_no;
        $prr_logs->updated_date = $updated_date;
        $prr_logs->updated_by = Auth::user()->id;
        $prr_logs->status = 1;
        $prr_logs->save();

        //ADD PRR TABLE MEAL SPECS
        $count = 0;
        foreach($request->get('expected') as $pr)
        {
            $pr = new prr_meal_specs();
            $pr->route_no = $route_no;
            $pr->specification = $request->get("specification")[$count];
            $pr->expected = $request->get("expected")[$count];
            $pr->guaranteed = $request->get("guaranteed")[$count];
            $pr->date_time = $request->get("date_time")[$count];
            $pr->category_row = $count;
            $pr->prr_logs_key = $prr_logs_key;
            $pr->status = 1;
            $pr->save();
            $count++;
        }

        //ADD PRR MEAL CATEGORY
        $array_keys = array_keys($request->get('category'));
        $count = 0;
        foreach($array_keys as $row)
        {
            $unit_cost_column = array_keys($request->get('unit_cost')[$row]);
            $estimated_cost_column = array_keys($request->get('estimated_cost')[$row]);
            foreach($request->get('category')[$row] as $category)
            {
                $category_tbl = new prr_meal_category();
                $category_tbl->route_no = $route_no;
                $category_tbl->category_desc = $category;
                $category_tbl->unit_cost = $request->get('unit_cost')[$row][$unit_cost_column[$count]];
                $category_tbl->estimated_cost = $request->get('estimated_cost')[$row][$estimated_cost_column[$count]];
                $category_tbl->category_row = $count;
                $category_tbl->prr_logs_key = $prr_logs_key;
                $category_tbl->status = 1;
                $category_tbl->save();
            }
            $count++;
        }

        Session::put('updated',true);
        return redirect()->back();
    }

    public function prr_meal_pdf()
    {
        $prr_meal_logs = prr_meal_logs::where('route_no',Session::get('route_no'))
            ->where('status',1)
            ->first();
        $meal = prr_meal_specs::where('route_no',Session::get('route_no'))
            ->where('status',1)
            ->where('prr_logs_key',$prr_meal_logs->prr_logs_key)
            ->get();

        $tracking = Tracking::where('route_no',Session::get('route_no'))->first();
        $user = Users::where('id',$tracking->prepared_by)->first();
        $section = Section::where('id',$user->section)->first();
        $division = Division::where('id',$user->division)->first();

        $display = view("prr_meal.prr_meal_pdf",['meal' => $meal,'tracking' => $tracking,'user' => $user,'section' => $section,'division' => $division,'prr_meal_logs' => $prr_meal_logs]);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }

    public function prr_meal_category()
    {
        return view('prr_meal.prr_meal_category');
    }

}
