<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 12/8/2016
 * Time: 8:26 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class PrintLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delivered_docs(Request $request, $doc_type){
        if($doc_type =='SAL' || $doc_type=='TEV'){
            $display = view("logs.salary");
        }else if($doc_type=='PO'){
            $display = view('logs.PurchaseOrder');
        }else if($doc_type=="PRC"){
            $display = view('logs.PurchaseRequestCA');
        }else if($doc_type=="PRR"){
            $display = view('logs.PurchaseRequestCA');
        }else if($doc_type=='ALL'){
            $display = view("logs.all");
        } else if($doc_type == 'ROUTE') {
            $display = view('logs.routing_slip');
        } else if($doc_type == 'APPLEAVE'){
            $display = view('logs.app_leave');
        } else if($doc_type == 'INCOMING'){
            $display = view('logs.incoming');
        } else if($doc_type == 'SO'){
            $display = view('logs.office_order');
        } else if($doc_type == 'WORKSHEET') {
            $display = view('logs.worksheet');
        } else if($doc_type == 'JUST_LETTER') {
            $display = view('logs.just_letter');
        } else if($doc_type == 'GENERAL'){
            $display = view('logs.general');
        }else{
            return redirect('document/delivered');
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function received_docs(Request $request, $doc_type) {

        if($doc_type=='SAL' || $doc_type=='TEV'){
            $display = view("pending.salary");
        }else if($doc_type=='ALL'){
            $display = view("pending.all");
        }else if($doc_type=='PO'){
            $display = view('pending.PurchaseOrder');
        }else if($doc_type=="PRC"){
            $display = view('pending.PurchaseRequestCA');
        }else if($doc_type=="PRR") {
            $display = view('pending.PurchaseRequestCA');
        } else if($doc_type == 'INCOMING') {
            $display = view('pending.incoming');
        } else if($doc_type == 'ROUTE'){
            $display = view('pending.routing');
        } else if($doc_type == 'WORKSHEET') {
            $display = view('pending.worksheet');
        } else if($doc_type == 'SO') {
            $display = view('pending.office_order');
        } else if($doc_type == 'JUST_LETTER'){
            $display = view('pending.justification');
        } else if($doc_type == 'GENERAL'){
            $display = view('pending.general');
        } else if($doc_type == 'APPLEAVE'){
            $display = view('pending.app_leave');
        }
        else{
            return redirect('document/received');
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    
    function printTrack(){
        $display = view("pdf.track");
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display);
        return $pdf->stream();
    }
}