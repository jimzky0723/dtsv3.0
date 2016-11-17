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
    <h2 class="page-header">Documents</h2>    
    <form class="form-inline form-accept">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Quick Search" autofocus>
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
            <div class="btn-group">
                <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-plus"></i>  Add New
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a href="#" data-toggle="dropdown">Disbursement Voucher</a>
                        <ul class="dropdown-menu">
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('form/salary') }}">Salary, Honoraria, Stipend, Remittances, CHT Mobilization</a></li>
                            <li><a href="#">TEV</a></li>
                            <li><a href="#">Bills, Cash Advance Replenishment, Grants/Fund Transfer</a></li>
                            <li><a href="#">Supplier (Payment of Transactions with PO)</a></li>
                            <li><a href="#">Infra - Contractor</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" data-toggle="dropdown">Letter/Mail/Communication</a>
                        <ul class="dropdown-menu">
                            <li><a href="#document_form" data-link="{{ asset('/form/incoming/letter') }}">Incoming</a></li>
                            <li><a href="#">Outgoing</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Service Record</a></li>
                            <li><a href="#">SALN</a></li>
                            <li><a href="#">Plans (includes Allocation List)</a></li>
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('/form/routing/slip') }}">Routing Slip</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Memorandum</a></li>
                    <li class="dropdown-submenu">
                        <a href="#" data-toggle="dropdown">Management System Documents</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Memorandum</a></li>
                            <li><a href="#">ISO Documents</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Appointment</a></li>
                            <li><a href="#">Resolutions</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" data-toggle="dropdown">Miscellaneous</a>
                        <ul class="dropdown-menu">
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('/form/worksheet') }}">Activity Worksheet</a></li>
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('/form/justification/letter') }}">Justification</a></li>
                            <li><a href="#">Certifications</a></li>
                            <li><a href="#">Certificate of Appearance</a></li>
                            <li><a href="#">Certificate of Employment</a></li>
                            <li><a href="#">Certificate of Clearance</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" data-toggle="dropdown">Personnel Related Documents</a>
                        <ul class="dropdown-menu">
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('/form/office-order') }}">Office Order</a></li>
                            <li><a href="#">DTR</a></li>
                            <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('/form/application/leave') }}">Application for Leave</a></li>
                            <li><a href="#">Certificate of Overtime Credit</a></li>
                            <li><a href="#">Compensatory Time Off</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Purchase Order</a></li>
                    <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('prCashAdvance') }}">Purchase Request - Cash Advance Purchase</a></li>
                    <li><a href="#document_form" data-toggle="modal" data-link="{{ asset('prRegularPurchase') }}">Purchase Request - Regular Purchase</a></li>
                    <li><a href="#">Reports</a></li>
                </ul>
            </div>
        </div>
    </form>  
    <div class="clearfix"></div>
    <div class="page-divider"></div>
    @if(count($documents))
    <div class="table-responsive">
        <table class="table table-list table-hover table-striped">
            <thead>
                <tr>
                    <th width="8%"></th>
                    <th width="20%">Route #</th>
                    <th width="15%">Prepared Date</th>
                    <th width="20%">Document Type</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                <tr>
                    <td><a href="#track" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a></td>
                    <td><a class="title-info" data-route="{{ $doc->route_no }}" data-link="{{ asset('/document/'.$doc->route_no) }}" href="#document_info" data-toggle="modal">{{ $doc->route_no }}</a></td>
                    <td>{{ date('M d, Y',strtotime($doc->prepared_date)) }}<br>{{ date('h:i:s A',strtotime($doc->prepared_date)) }}</td>
                    <td>{{ \App\Http\Controllers\DocumentController::docTypeName($doc->doc_type) }}</td>
                    <td><p>{{ $doc->description }}</p>
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $documents->links() }}
    @else
        <div class="alert alert-danger">
            <strong><i class="fa fa-times fa-lg"></i> No documents found! </strong>
        </div>
    @endif
</div>

@endsection
@section('plugin')
<script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
@endsection



@section('css')
<link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

