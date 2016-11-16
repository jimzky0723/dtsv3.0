@extends('layouts.app')

@section('content')
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">Accept Documents</h2>
        <form class="form-inline form-accept" id="accept_form">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="route_no" class="form-control route_no" disabled placeholder="Enter route #" autofocus>
                <input type="text" name="remarks" class="form-control remarks" disabled placeholder="Enter remarks">
                <button type="submit" class="btn btn-success btn-accept"><i class="fa fa-plus"></i> Accept Document</button>
            </div>
            <div class="clearfix"></div><br>
            <div class="alert alert-danger error-accept hide">Please input route number!</div>
        </form>
        <hr />
        <div class="accepted-list">

        </div>
    </div>
</div>
@include('sidebar')
@endsection
