<?php
    use App\Users;
    use App\Section;
?>
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
        <h2 class="page-header">Delivered Documents</h2>
        <form class="form-inline" method="POST" action="{{ asset('document/delivered') }}" onsubmit="return searchDocument()">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="daterange" value="{{ isset($daterange) ? $daterange: null }}" placeholder="Input date range here..." required>
                </div>
                <div class="input-group">
                    <select data-placeholder="Select Document Type" name="doc_type" class="chosen-select" tabindex="5" required>
                        <option value=""></option>
                        <optgroup label="Disbursement Voucher">
                            <option value="SAL">Salary, Honoraria, Stipend, Remittances, CHT Mobilization</option>
                            <option value="TEV">TEV</option>
                            <option value="BILLS">Bills, Cash Advance Replenishment, Grants/Fund Transfer</option>
                            <option value="PAYMENT">Supplier (Payment of Transactions with PO)</option>
                            <option value="INFRA">Infra - Contractor</option>
                        </optgroup>
                        <optgroup label="Letter/Mail/Communication">
                            <option>Incoming</option>
                            <option>Outgoing</option>
                            <option>Service Record</option>
                            <option>SALN</option>
                            <option>Plans (includes Allocation List)</option>
                            <option>Routing Slip</option>
                        </optgroup>
                        <option>Memorandum</option>
                        <optgroup label="Management System Documents">
                            <option>Memorandum</option>
                            <option>ISO Documents</option>
                            <option>Appointment</option>
                            <option>Resolutions</option>
                        </optgroup>
                        <optgroup label="Miscellaneous">
                            <option>Activity Worksheet</option>
                            <option>Justification</option>
                            <option>Certifications</option>
                            <option>Certificate of Appearance</option>
                            <option>Certificate of Employment</option>
                            <option>Certificate of Clearance</option>
                        </optgroup>
                        <optgroup label="Personnel Related Documents">
                            <option>Office Order</option>
                            <option>DTR</option>
                            <option>Application for Leave</option>
                            <option>Certificate of Overtime Credit</option>
                            <option>Compensatory Time Off</option>
                        </optgroup>
                        <option value="PO">Purchase Order</option>
                        <option>Purchase Request - Cash Advance Purchase</option>
                        <option>Purchase Request - Regular Purchase</option>
                        <option>Reports</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success" onclick="checkDocTye()"><i class="fa fa-search"></i> Submit</button>
                @if(count($documents))
                    <a target="_blank" href="{{ asset('pdf/logs/'.$doc_type) }}" class="btn btn-warning"><i class="fa fa-print"></i> Print Logs</a>
                @endif
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <div class="alert alert-danger error hide">
            <i class="fa fa-warning"></i> Please select Document Type!
        </div>
        @if(count($documents))
            <table class="table table-list table-hover table-striped">
                <thead>
                <tr>
                    <th width="8%"></th>
                    <th width="20%">Route #</th>
                    <th width="15%">Delivered Date</th>
                    <th width="15%">Delivered To</th>
                    <th width="20%">Document Type</th>
                    <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td><a href="#track" data-link="{{ asset('document/track/'.$doc->route_no) }}" data-route="{{ $doc->route_no }}" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a></td>
                        <td><a class="title-info" data-route="{{ $doc->route_no }}" data-link="{{ asset('/document/info/'.$doc->route_no) }}" href="#document_info" data-toggle="modal">{{ $doc->route_no }}</a></td>
                        <td>{{ date('M d, Y',strtotime($doc->prepared_date)) }}<br>{{ date('h:i:s A',strtotime($doc->prepared_date)) }}</td>
                        <td>
                            <?php $user = Users::find($doc->received_by);?>
                            {{ $user->fname }}
                            {{ $user->lname }}
                            <br>
                            <em>({{ Section::find($user->section)->description }})</em>
                        </td>
                        <td>{{ \App\Http\Controllers\DocumentController::docTypeName($doc->doc_type) }}</td>
                        <td>
                            {!! nl2br($doc->action) !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                <strong><i class="fa fa-warning fa-lg"></i> No documents found! </strong>
            </div>
        @endif
    </div>

@endsection
@section('plugin')
    <script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('resources/plugin/chosen/chosen.jquery.js') }}"></script>
    <script>
        $('#reservation').daterangepicker();
        $('.chosen-select').chosen();

        function checkDocTye(){
            var doc = $('select[name="doc_type"]').val();
            if(doc.length == 0){
                $('.error').removeClass('hide');
            }
        }
    </script>
    <script>
        function searchDocument(){
            $('.loading').show();
            setTimeout(function(){
                return true;
            },2000);
        }
    </script>
@endsection

@section('css')
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/plugin/chosen/chosen.css') }}" rel="stylesheet">
@endsection

