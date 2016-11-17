<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tracking;
use Illuminate\Support\Facades\Session;
use Milon\Barcode\DNS1D;
use Dompdf\Dompdf;
use App\Tracking_Details;
use App;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function connect(){
        return new PurchaseRequestController();
    }

    public function PurchaseOrder(){
        return view('form.PurchaseOrder');
    }

    public function PurchaseOrderSave(Request $request){
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        $description = 'PO '.$request->get('po_no').' dtd '.$request->get('po_date').'
                        PR '.$request->get('pr_no').' dtd '.$request->get('pr_date').'
                        <b>'.$request->get('aditionalinfo').'</b>';
        return $this->connect()->saveDatabase($route_no, $request->get('doctype'), $request->get('prepareddate'), $request->get('preparedby'), $description, "", "", "", "", "", "", "", $request->get("supplier"), "", "", "", "", "", "", "", "", "", "");
    }
}
