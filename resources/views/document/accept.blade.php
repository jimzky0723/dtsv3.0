@extends('layouts.app')

@section('content')
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">Accept Documents</h2>
        <form class="form-inline form-accept">
            <div class="form-group">
                <input type="text" class="form-control route_no" disabled placeholder="Enter route #" autofocus>
                <input type="text" class="form-control remarks" disabled placeholder="Enter remarks">
                <button type="submit" class="btn btn-success btn-accept"><i class="fa fa-plus"></i> Accept Document</button>
                <small class="text-danger error-accept hide text-italic text-bold">Please input route number!</small>
            </div>
        </form>
        <hr />
        <div class="accepted-list">

        </div>
    </div>
</div>
@include('sidebar')
@endsection
