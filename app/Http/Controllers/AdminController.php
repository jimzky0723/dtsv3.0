<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 11/18/2016
 * Time: 8:56 AM
 */

namespace App\Http\Controllers;


class AdminController extends Controler
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}