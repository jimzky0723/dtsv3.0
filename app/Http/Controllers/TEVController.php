<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/14/2016
 * Time: 2:46 PM
 */

namespace App\Http\Controllers;


use App\Tracking;

class TEVController extends Controller
{
    public function index() {
        return view('form.tev');
    }
    public function create() {
        $tracking = new Tracking();
    }
}