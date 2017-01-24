<?php
use App\Users;
use App\Section;
use App\Http\Controllers\DocumentController as Doc;
use App\Division;
use App\Release;
use App\Http\Controllers\ReleaseController as Rel;

$code = Session::get('doc_type_code');
?>
@extends('layouts.app')

@section('content')
    <style>
        .input-group {
            margin:5px 0;
        }
        label {
            padding:2px 0px;
        }
    </style>
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
        <h2 class="page-header">Print Document Logs</h2>
        <form class="form-inline" method="POST" action="{{ asset('document/logs') }}" onsubmit="return searchDocument()">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" class="form-control" name="keywordLogs" value="{{ isset($keywordLogs) ? $keywordLogs: null }}" placeholder="Input keyword...">
                </div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="daterange" value="{{ isset($daterange) ? $daterange: null }}" placeholder="Input date range here..." required>
                </div>
                <div class="input-group">
                    <select data-placeholder="Select Document Type" name="doc_type" class="chosen-select-static" tabindex="5" required>
                        <option value=""></option>
                        <option value="ALL" <?php if($code=='ALL') echo 'selected';?>>All Documents</option>
                        <optgroup label="Disbursement Voucher">
                            <option <?php if($code=='SAL') echo 'selected'; ?> value="SAL">Salary, Honoraria, Stipend, Remittances, CHT Mobilization</option>
                            <option <?php if($code=='TEV') echo 'selected'; ?> value="TEV">TEV</option>
                            <option <?php if($code=='BILLS') echo 'selected'; ?> value="BILLS">Bills, Cash Advance Replenishment, Grants/Fund Transfer</option>
                            <option <?php if($code=='PAYMENT') echo 'selected'; ?> value="PAYMENT">Supplier (Payment of Transactions with PO)</option>
                            <option <?php if($code=='INFRA') echo 'selected'; ?> value="INFRA">Infra - Contractor</option>
                        </optgroup>
                        <optgroup label="Letter/Mail/Communication">
                            <option value="INCOMING">Incoming</option>
                            <option>Outgoing</option>
                            <option>Service Record</option>
                            <option>SALN</option>
                            <option>Plans (includes Allocation List)</option>
                            <option value="ROUTE">Routing Slip</option>
                        </optgroup>
                        <optgroup label="Management System Documents">
                            <option>Memorandum</option>
                            <option>ISO Documents</option>
                            <option>Appointment</option>
                            <option>Resolutions</option>
                        </optgroup>
                        <optgroup label="Miscellaneous">
                            <option value="WORKSHEET">Activity Worksheet</option>
                            <option value="JUST_LETTER">Justification</option>
                            <option>Certifications</option>
                            <option>Certificate of Appearance</option>
                            <option>Certificate of Employment</option>
                            <option>Certificate of Clearance</option>
                        </optgroup>
                        <optgroup label="Personnel Related Documents">
                            <option <?php if($code=='OFFICE_ORDER') echo 'selected'; ?> value="OFFICE_ORDER">Office Order</option>
                            <option>DTR</option>
                            <option <?php if($code=='APP_LEAVE') echo 'selected'; ?> value="APP_LEAVE">Application for Leave</option>
                            <option>Certificate of Overtime Credit</option>
                            <option>Compensatory Time Off</option>
                        </optgroup>
                        <option <?php if($code=='PO') echo 'selected'; ?> value="PO">Purchase Order</option>
                        <option <?php if($code=='PRC') echo 'selected'; ?> value="PRC">Purchase Request - Cash Advance Purchase</option>
                        <option <?php if($code=='PRR') echo 'selected'; ?> value="PRR">Purchase Request - Regular Purchase</option>
                        <option>Reports</option>
                        <option <?php if($code=='GENERAL') echo 'selected'; ?> value="GENERAL">General Documents</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success" onclick="checkDocTye()"><i class="fa fa-search"></i> Filter</button>
                @if(count($documents))
                    <a target="_blank" href="{{ asset('pdf/logs/'.$doc_type) }}" class="btn btn-warning"><i class="fa fa-print"></i> Print Logs</a>
                @endif
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php $status = session('status'); ?>
        @if($status=='releaseAdded')
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Successfully released!
        </div>
        @endif

        @if($status=='reportAdded')
            <div class="alert alert-info">
                <i class="fa fa-warning"></i> Successfully reported!
            </div>
        @endif
        <div class="alert alert-danger error hide">
            <i class="fa fa-warning"></i> Please select Document Type!
        </div>
        @if(count($documents))
            <table class="table table-list table-hover table-striped">
                <thead>
                <tr>
                    <th width="8%"></th>
                    <th width="17%">Route # / Remarks</th>
                    <th width="15%">Received Date</th>
                    <th width="15%">Received From</th>
                    <th width="15%">Released Date</th>
                    <th width="15%">Released To</th>
                    <th width="20%">Document Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td>
                            <a href="#track" data-link="{{ asset('document/track/'.$doc->route_no) }}" data-route="{{ $doc->route_no }}" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a>
                        </td>
                        <td>
                            <a class="title-info" data-route="{{ $doc->route_no }}" data-link="{{ asset('/document/info/'.$doc->route_no) }}" href="#document_info" data-toggle="modal">{{ $doc->route_no }}</a>
                            <br>
                            {!! nl2br($doc->description) !!}
                        </td>
                        <td>{{ date('M d, Y',strtotime($doc->date_in)) }}<br>{{ date('h:i:s A',strtotime($doc->date_in)) }}</td>
                        <td>
                            <?php $user = Users::find($doc->delivered_by);?>
                            {{ $user->fname }}
                            {{ $user->lname }}
                            <br>
                            <em>({{ Section::find($user->section)->description }})</em>
                        </td>
                        <?php
                            $out = Doc::deliveredDocument($doc->route_no,$doc->received_by,$doc->doc_type);
                        ?>
                        @if($out)
                        <td>{{ date('M d, Y',strtotime($out->date_in)) }}<br>{{ date('h:i:s A',strtotime($out->date_in)) }}</td>
                        <td>
                            <?php $user = Users::find($out->received_by);?>
                            {{ $user->fname }}
                            {{ $user->lname }}
                            <br>
                            <em>({{ Section::find($user->section)->description }})</em>
                        </td>
                        @else
                            <?php $rel = Release::where('route_no', $doc->route_no)->where('status','!=',2)->orderBy('id','desc')->first(); ?>
                            @if($rel)
                                <?php
                                    $time = Rel::hourDiff($rel->date_reported);
                                ?>
                                <td class="text-info">
                                    {{ date('M d, Y',strtotime($rel->date_reported)) }}<br>
                                    {{ date('h:i:s A',strtotime($rel->date_reported)) }}<br>
                                </td>
                                <td class="text-info">
                                    {{ Section::find($rel->section_id)->description }}
                                    <br />
                                    @if($rel->status==0)
                                        <button data-toggle="modal" data-target="#releaseTo" data-route_no="{{ $doc->route_no }}" onclick="putRoute($(this))" type="button" class="btn btn-info btn-xs"><i class="fa fa-send"></i> Change</button>
                                    @endif
                                    @if($rel->status==0 && $time >= 2)
                                        <a href="{{ asset('document/report/'.$rel->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-warning"></i> Report</a>
                                    @elseif($rel->status==1)
                                        <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-info"></i> Reported</button>
                                    @endif
                                </td>
                            @else
                                <td colspan="2" class="text-center" style="vertical-align: middle;">
                                    <button data-toggle="modal" data-target="#releaseTo" data-route_no="{{ $doc->route_no }}" onclick="putRoute($(this))" type="button" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Release To</button>
                                </td>
                            @endif
                        @endif
                        <td>{{ \App\Http\Controllers\DocumentController::docTypeName($doc->doc_type) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $documents->links() }}
        @else
            <div class="alert alert-warning">
                <strong><i class="fa fa-warning fa-lg"></i> No documents found! </strong>
            </div>
        @endif
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="releaseTo" style="margin-top: 30px;z-index: 99999;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-success"><i class="fa fa-send"></i> Select Destination</h4>
                    <hr />
                    <form method="POST" action="{{ asset('document/release') }}" name="destinationForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="route_no" id="route_no">
                        <div class="form-group">
                            <label>Division</label>
                            <select name="division" class="chosen-select filter-division" required>
                                <option value="">Select division...</option>
                                <?php $division = Division::where('description','!=','Default')->orderBy('description','asc')->get(); ?>
                                @foreach($division as $div)
                                    <option value="{{ $div->id }}">{{ $div->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <select name="section" class="chosen-select filter_section" required>
                                <option value="">Select section...</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success" onclick="checkDestinationForm()"><i class="fa fa-send"></i> Submit</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('plugin')
    <script>
        $('.filter-division').show();
        $('#reservation').daterangepicker();
        $('.filter-division').on('change',function(){
            checkDestinationForm();
            var id = $(this).val();
            var url = "<?php echo asset('getsections/');?>";
            $('.loading').show();
            $('.filter_section').html('<option value="">Select section...</option>')
            $.ajax({
                url: url+'/'+id,
                type: "GET",
                success: function(sections){
                    jQuery.each(sections,function(i,val){
                        $('.filter_section').append($('<option>', {
                            value: val.id,
                            text: val.description
                        }));
                        $('.filter_section').chosen().trigger('chosen:updated');
                        $('.filter_section').siblings('.chosen-container').css({border:'2px solid red'});
                    });
                    $('.loading').hide();
                }
            })
        });
        $('.filter_section').on('change',function(){
            checkDestinationForm();
        });

        function putRoute(form)
        {
            var route_no = form.data('route_no');
            $('#route_no').val(route_no);
        }
        function checkDestinationForm(){
            var division = $('.filter-division').val();
            var section = $('.filter_section').val();
            if(division.length == 0){
                $('.filter-division').siblings('.chosen-container').css({border:'2px solid red'});
            }else{
                $('.filter-division').siblings('.chosen-container').css({border:'none'});
            }

            if(section.length == 0){
                $('.filter_section').siblings('.chosen-container').css({border:'2px solid red'});
            }else{
                $('.filter_section').siblings('.chosen-container').css({border:'none'});
            }
        }
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

@endsection

