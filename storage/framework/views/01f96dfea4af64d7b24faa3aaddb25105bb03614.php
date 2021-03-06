<?php
use App\Users;
use App\Section;
use App\Http\Controllers\DocumentController as Doc;
use App\Division;
use App\Release;
use App\Http\Controllers\ReleaseController as Rel;

$code = Session::get('doc_type_code');
?>


<?php $__env->startSection('content'); ?>
    <style>
        .input-group {
            margin:5px 0;
        }
        label {
            padding:2px 0px;
        }
    </style>
    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Print Document Logs</h2>
        <form class="form-inline" method="POST" action="<?php echo e(asset('document/logs')); ?>" onsubmit="return searchDocument()">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" class="form-control" name="keywordLogs" value="<?php echo e(isset($keywordLogs) ? $keywordLogs: null); ?>" placeholder="Input keyword...">
                </div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="daterange" value="<?php echo e(isset($daterange) ? $daterange: null); ?>" placeholder="Input date range here..." required>
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
                <?php if(count($documents)): ?>
                    <a target="_blank" href="<?php echo e(asset('pdf/logs/'.$doc_type)); ?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Logs</a>
                <?php endif; ?>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php $status = session('status'); ?>
        <?php if($status=='releaseAdded'): ?>
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Successfully released!
        </div>
        <?php endif; ?>

        <?php if($status=='reportAdded'): ?>
            <div class="alert alert-info">
                <i class="fa fa-warning"></i> Successfully reported!
            </div>
        <?php endif; ?>

        <?php if($status=='reportCancelled'): ?>
            <div class="alert alert-success">
                <i class="fa fa-check"></i> Successfully cancelled!
            </div>
        <?php endif; ?>
        <div class="alert alert-danger error hide">
            <i class="fa fa-warning"></i> Please select Document Type!
        </div>
        <?php if(count($documents)): ?>
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
                <?php foreach($documents as $doc): ?>
                    <tr>
                        <td>
                            <a href="#track" data-link="<?php echo e(asset('document/track/'.$doc->route_no)); ?>" data-route="<?php echo e($doc->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a>
                        </td>
                        <td>
                            <a class="title-info" data-route="<?php echo e($doc->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$doc->route_no)); ?>" href="#document_info" data-toggle="modal"><?php echo e($doc->route_no); ?></a>
                            <br>
                            <?php echo nl2br($doc->description); ?>

                        </td>
                        <td><?php echo e(date('M d, Y',strtotime($doc->date_in))); ?><br><?php echo e(date('h:i:s A',strtotime($doc->date_in))); ?></td>
                        <td>
                            <?php $user = Users::find($doc->delivered_by);?>
                            <?php echo e($user->fname); ?>

                            <?php echo e($user->lname); ?>

                            <br>
                            <em>(<?php echo e(Section::find($user->section)->description); ?>)</em>
                        </td>
                        <?php
                            $out = Doc::deliveredDocument($doc->route_no,$doc->received_by,$doc->doc_type);
                        ?>
                        <?php if($out): ?>
                        <td><?php echo e(date('M d, Y',strtotime($out->date_in))); ?><br><?php echo e(date('h:i:s A',strtotime($out->date_in))); ?></td>
                        <td>
                            <?php $user = Users::find($out->received_by);?>
                            <?php echo e($user->fname); ?>

                            <?php echo e($user->lname); ?>

                            <br>
                            <em>(<?php echo e(Section::find($user->section)->description); ?>)</em>
                        </td>
                        <?php else: ?>
                            <?php $rel = Release::where('route_no', $doc->route_no)->where('status','!=',2)->orderBy('id','desc')->first(); ?>
                            <?php if($rel): ?>
                                <?php
                                    $now = date('Y-m-d H:i:s');
                                    $time = Rel::hourDiff($rel->date_reported,$now);
                                ?>
                                <td class="text-info">
                                    <?php echo e(date('M d, Y',strtotime($rel->date_reported))); ?><br>
                                    <?php echo e(date('h:i:s A',strtotime($rel->date_reported))); ?><br>
                                </td>
                                <td class="text-info">
                                    <?php echo e(Section::find($rel->section_id)->description); ?>

                                    <br />
                                    <?php if($rel->status==0): ?>
                                        <button data-toggle="modal" data-target="#releaseTo" data-route_no="<?php echo e($doc->route_no); ?>" onclick="changeRoute($(this), '<?php echo $rel->id ?>')" type="button" class="btn btn-info btn-xs"><i class="fa fa-send"></i> Change</button>
                                    <?php endif; ?>
                                    <?php if($rel->status==0 && $time >= 2): ?>
                                        <a href="<?php echo e(asset('document/report/'.$rel->id)); ?>" class="btn btn-danger btn-xs"><i class="fa fa-warning"></i> Report</a>
                                    <?php elseif($rel->status==1): ?>
                                        <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-info"></i> Reported</button>
                                        <a href="<?php echo e(asset('document/report/'.$rel->id .'/cancel')); ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Cancel</a>
                                    <?php endif; ?>
                                </td>
                            <?php else: ?>
                                <td colspan="2" class="text-center" style="vertical-align: middle;">
                                    <button data-toggle="modal" data-target="#releaseTo" data-route_no="<?php echo e($doc->route_no); ?>" onclick="putRoute($(this))" type="button" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Release To</button>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <td><?php echo e(\App\Http\Controllers\DocumentController::docTypeName($doc->doc_type)); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo e($documents->links()); ?>

        <?php else: ?>
            <div class="alert alert-warning">
                <strong><i class="fa fa-warning fa-lg"></i> No documents found! </strong>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="releaseTo" style="margin-top: 30px;z-index: 99999;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(asset('document/release')); ?>" name="destinationForm">
                <div class="modal-body">
                    <h4 class="text-success"><i class="fa fa-send"></i> Select Destination</h4>
                    <hr />
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="route_no" id="route_no">
                        <input type="hidden" name="op" id="op" value="0">
                        <div class="form-group">
                            <label>Division</label>
                            <select name="division" class="chosen-select filter-division" required>
                                <option value="">Select division...</option>
                                <?php $division = Division::where('description','!=','Default')->orderBy('description','asc')->get(); ?>
                                <?php foreach($division as $div): ?>
                                    <option value="<?php echo e($div->id); ?>"><?php echo e($div->description); ?></option>
                                <?php endforeach; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin'); ?>
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
            $('#op').val(0);
        }

        function changeRoute(form,id)
        {
            var route_no = form.data('route_no');
            $('#route_no').val(route_no);
            $('#op').val(id);
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>