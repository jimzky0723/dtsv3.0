<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Session;
use App\Tracking_Details;
use App;

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

    public function savePrCashAdvance(Request $request)
    {
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        return $this->saveDatabase($route_no, $request->get('doctype'), $request->get('prepareddate'), $request->get('preparedby'), $request->get('itemdescription'), $request->get('amount'), "", "", $request->get('chargeto'), $request->get('requestedby'), "", "", "", "", "", "", "", "", "", "", "", "", "");
    }

    public function prRegularPurchase()
    {
        return view('form.prRegularPurchase', ['name' => 'rusel']);
    }

    public function savePrRegularPurchase(Request $request)
    {
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        return $this->saveDatabase($route_no, $request->get('doctype'), $request->get('prepareddate'), $request->get('preparedby'), $request->get('purpose'), $request->get('amount'), $request->get('pr_no'), "", $request->get('chargeto'), $request->get('requestedby'), "", "", "", "", "", "", "", "", "", "", "", "", "");
    }

    public function saveDatabase($route_no, $doc_type, $prepared_date, $prepare_by, $description, $amount, $pr_no, $purpose, $source_fund, $requested_by, $route_to, $route_from, $supplier, $event_date, $event_location, $event_particpant, $cdo_applicant, $cdo_day, $event_daterange, $payee, $item, $dv_no, $remember_token)
    {
        Session::put('route_no', $route_no);
        Session::put('doctype', $doc_type);
        Session::put('prepared_date', $prepared_date);
        Session::put('preparedby', $prepare_by);
        Session::put('description', $description);
        Session::put('amount', $amount);
        Session::put('pr_no', $pr_no);
        Session::put('purpose', $purpose);
        Session::put('source_fund', $source_fund);
        Session::put('requested_by', $requested_by);
        Session::put('route_to', $route_to);
        Session::put('route_from', $route_from);
        Session::put('supplier', $supplier);
        Session::put('event_date', $event_date);
        Session::put('event_location', $event_location);
        Session::put('event_participant', $event_particpant);
        Session::put('cdo_applicant', $cdo_applicant);
        Session::put('cdo_day', $cdo_day);
        Session::put('event_daterange', $event_daterange);
        Session::put('payee', $payee);
        Session::put('item', $item);
        Session::put('dv_no', $dv_no);
        Session::put('remember_token', $remember_token);

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

        return redirect("/pdf");
    }

    public function hello(){
        return "Hello World";
    }

}
