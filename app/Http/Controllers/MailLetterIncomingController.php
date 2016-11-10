<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/10/2016
 * Time: 1:58 PM
 */

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

class MailLetterIncomingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function incoming_letter() {
        return view('form.incoming_letter');
    }
}