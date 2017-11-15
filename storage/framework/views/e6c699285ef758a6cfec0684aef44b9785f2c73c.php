
<?php
use App\User;
use App\Http\Controllers\DocumentController as Doc;
use App\Http\Controllers\AccessController as Access;

$access = Access::access();
$user = User::find(Auth::user()->id);
$filter = Doc::isIncluded($doc_type);
?>
<style>
    table tr td:first-child {
        font-weight:bold;
        color: #2b542c;
    }
    .daterangepicker {
        margin-top:-50px;
    }
</style>

<form action="<?php echo e(asset('document/create')); ?>" method="POST" class="form-submit">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="doc_type" value="<?php echo e($doc_type); ?>" />
    <div class="modal-body">
        <table class="table table-hover table-striped">
            <tr>
                <td class="text-right col-lg-4">Document Type :</td>
                <td class="col-lg-8"><?php echo e(Doc::docTypeName($doc_type)); ?></td>
            </tr>
            <tr>
                <td class="text-right">Prepared By :</td>
                <td><?php echo e($user->fname.' '.$user->mname.' '.$user->lname); ?></td>
            </tr>
            <tr>
                <td class="text-right">Prepared Date :</td>
                <td><?php echo e(date('M d, Y h:i:s A')); ?></td>
            </tr>
            <?php if($filter[0]!='hide'): ?>
                <tr>
                    <td class="text-right">Remarks / Additional Information :</td>
                    <td>
                        <textarea name="description" class="form-control" rows="10" style="resize: vertical;"></textarea>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[15]!='hide'): ?>
                <tr>
                    <td class="text-right">Date Range :</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control daterange" name="event_daterange">
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[1]!='hide'): ?>
                <tr>
                    <td class="text-right">Amount :</td>
                    <td>
                        <input type="text" name="amount" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[2]!='hide'): ?>
                <tr>
                    <td class="text-right">PR # :</td>
                    <td>
                        <input type="text" name="pr_no" class="form-control"/>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Date :</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="pr_date" class="form-control">
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[3]!='hide'): ?>
                <tr>
                    <td class="text-right">PO # :</td>
                    <td>
                        <input type="text" name="po_no" class="form-control"/>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Date :</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="po_date" class="form-control">
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[4]!='hide'): ?>
                <tr>
                    <td class="text-right">Purpose:</td>
                    <td>
                        <input type="text" name="purpose" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[5]!='hide'): ?>
                <tr>
                    <td class="text-right">Source of Fund / Charge To :</td>
                    <td>
                        <input type="text" name="source_fund" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[6]!='hide'): ?>
                <tr>
                    <td class="text-right">Requested By :</td>
                    <td>
                        <input type="text" name="requested_by" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[7]!='hide'): ?>
                <tr>
                    <td class="text-right">Route To :</td>
                    <td>
                        <input type="text" name="route_to" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[8]!='hide'): ?>
                <tr>
                    <td class="text-right">Route From :</td>
                    <td>
                        <input type="text" name="route_from" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[9]!='hide'): ?>
                <tr>
                    <td class="text-right">Supplier :</td>
                    <td>
                        <input type="text" name="supplier" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[10]!='hide'): ?>
                <tr>
                    <td class="text-right">Date of Event :</td>
                    <td>
                        <input type="date" name="event_date" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[11]!='hide'): ?>
                <tr>
                    <td class="text-right">Location of Event :</td>
                    <td>
                        <input type="text" name="event_location" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[12]!='hide'): ?>
                <tr>
                    <td class="text-right">Participants :</td>
                    <td>
                        <input type="text" name="event_participant" class="form-control"/>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($filter[13]!='hide'): ?>
                <tr class="
                <?php if($filter[13]!='hide'): ?>
                        <td class="text-right">Applicant :</td>
                <td>
                    <input type="text" name="cdo_applicant" class="form-control"/>
                </td>
                <?php endif; ?>
                <?php endif; ?>
                </tr>
                <?php if($filter[14]!='hide'): ?>
                    <tr>
                        <td class="text-right">Number of Days :</td>
                        <td>
                            <input type="text" name="cdo_day" class="form-control"/>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if($filter[16]!='hide'): ?>
                    <tr>
                        <td class="text-right">Payee :</td>
                        <td>
                            <input type="text" name="payee" class="form-control" />
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if($filter[17]!='hide'): ?>
                    <tr>
                        <td class="text-right">Item/s :</td>
                        <td>
                            <input type="text" name="item" class="form-control"  />
                        </td>
                    </tr>
                <?php endif; ?>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-submit"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>

<script>
    $('.daterange').daterangepicker({
        orientation: "auto"
    });

    $('.form-submit').on('submit',function(){
        $('.btn-submit').attr("disabled", true);
    });
</script>