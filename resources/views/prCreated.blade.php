@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="alert alert-jim" id="inputText">
    <h2 class="page-header">Route # {{ Session::get('route_no') }}</h2>
    <form action="" method="POST">
        {{ csrf_field() }}
            <div class="modal-body">  
                <table class="table table-hover table-form table-striped">
                    <tr>
                        <td class=""><label>Prepared Date</label></td>
                        <td>:</td>
                        <td><input name="date" value="{{ Session::get('date') }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class=""><label>Prepared By</label></td>
                        <td>:</td>
                        <td><input type="hidden" name="preparedby" value="{{ Session::get('preparedby') }}"><input value="{{ Auth::user()->name }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class="col-sm-3"><label>PR #</label></td>
                        <td class="col-sm-1">:</td>
                        <td class="col-sm-8"><input type="text" name="prno" value="{{ Session::get('prno') }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class="col-sm-3"><label>Amount</label></td>
                        <td class="col-sm-1">:</td>
                        <td class="col-sm-8"><input type="number" name="amount" value="{{ Session::get('amount') }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class="col-sm-3"><label>Requested By</label></td>
                        <td class="col-sm-1">:</td>
                        <td class="col-sm-8"><input type="text" name="requestedby" value="{{ Session::get('requestedby') }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class="col-sm-3"><label>Charge to</label></td>
                        <td class="col-sm-1">:</td>
                        <td class="col-sm-8"><input type="text" name="chargeto" id="chargeto" value="{{ Session::get('chargeto') }}" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td class=""><label>Purpose</label></td>
                        <td>:</td>
                        <td><textarea class="form-control" name="purpose" id="purpose" rows="10" style="resize:none;" readonly>{{ Session::get('purpose') }}</textarea></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="button" onclick="save();" class="btn btn-success"><i class="fa fa-send"></i> Print</button>
            </div>
    </form>
</div>
@endsection
@section('plugin')
<script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
@endsection
<script type="text/javascript">
    function save(){
        alert($("#purpose").val());
    }
</script>
