<?php
use Illuminate\Support\Facades\Session;

?>
@extends('layouts.app')

@section('content')
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Your feedback is sent.</h2>
        <h2>Thank you {{ (Session::has('name') ? Session::get('name') : "" ) }} for submitting to us your feedback about our system.</h2>
    </div>
@endsection


