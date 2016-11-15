<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/10/2016
 * Time: 11:07 AM
 */

namespace App\Http\Controllers;
use App\Tracking;
use Illuminate\Routing\Controller;
use Milon\Barcode\DNS1D;
use App;
class RoutingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function routing_slip() {
        return view('form.routing_slip');
    }
    public function create(\Symfony\Component\HttpFoundation\Request $request) {
        $tracking = new Tracking();
        $route_no = "doh7".date('ymdms').$request->user()->id;
        $tracking->route_no = $route_no;
        $tracking->prepared_date = date('Y-m-d H:i:s');
        $tracking->prepared_by = $request->user()->id;
        $tracking->route_from = $request->input('routed_from');
        $tracking->route_to =   $request->input('routed_to');
        $tracking->doc_type = $request->input('doctype');
        $tracking->description = $request->input('description');
        $tracking->save();

        $pdf = App::make('dompdf.wrapper');
        $view =  view('pdf.routing_slip')->with('route_no', $route_no);
        $pdf->loadHTML($view);
        return $pdf->stream();



    }
}