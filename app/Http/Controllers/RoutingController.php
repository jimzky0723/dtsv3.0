<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/10/2016
 * Time: 11:07 AM
 */

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

class RoutingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function routing_slip() {
        return view('form.routing_slip');
    }
}