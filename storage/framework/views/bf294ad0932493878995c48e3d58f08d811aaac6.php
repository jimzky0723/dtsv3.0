<?php
use App\User;
use App\Http\Controllers\DocumentController as Doc;
use App\Http\Controllers\AccessController as Access;
use App\Tracking_Details;

$routed = Tracking_Details::where('route_no',$document->route_no)
            ->count();
$access = Access::access();
$user = User::find($document->prepared_by);
$filter = Doc::isIncluded($document->doc_type);
?>

<?php if(Auth::user()->id == $document->prepared_by): ?> <?php /* && $routed==1*/ ?>
    <?php $status = ''; ?>
<?php else: ?>
    <?php $status = 'disabled'; ?>
<?php endif; ?>
<style>
    .table-info tr td:first-child {
        font-weight:bold;
        color: #2b542c;
    }
</style>
<form action="<?php echo e(asset('document/update')); ?>" method="post" class="form-submit">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="currentID" value="<?php echo e($document->id); ?>" />
<table class="table table-hover table-striped table-info">

    <tr>
        <td class="text-right col-lg-4">Document Type :</td>
        <td class="col-lg-8"><?php echo e(Doc::docTypeName($document->doc_type)); ?></td>
    </tr>
    <tr>
        <td class="text-right">Prepared By :</td>
        <td><?php echo e($user->fname.' '.$user->mname.' '.$user->lname); ?></td>
    </tr>
    <tr>
        <td class="text-right">Prepared Date :</td>
        <td><?php echo e(date('M d, Y h:i:s A',strtotime($document->prepared_date))); ?></td>
    </tr>
    <tr class="<?php echo e($filter[0]); ?>">
        <td class="text-right">Remarks :</td>
        <td>
            <textarea name="description" <?php echo e($status); ?> class="form-control" rows="10" style="resize: vertical;"><?php echo ($document->description); ?></textarea>
        </td>
    </tr>
    <tr class="<?php echo e($filter[1]); ?>">
        <td class="text-right">Amount :</td>
        <td>
            <input type="text" name="amount" class="form-control" value="<?php echo e($document->amount); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[2]); ?>">
        <td class="text-right">PR # :</td>
        <td>
            <input type="text" name="pr_no" class="form-control" value="<?php echo e($document->pr_no); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[2]); ?>">
        <td class="text-right">Date :</td>
        <td>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="date" name="pr_date" class="form-control" value="<?php echo e(date('Y-m-d',strtotime($document->pr_date))); ?>" <?php echo e($status); ?>>
            </div>
        </td>
    </tr>
    <tr class="<?php echo e($filter[3]); ?>">
        <td class="text-right">PO # :</td>
        <td>
            <input type="text" name="po_no" class="form-control" value="<?php echo e($document->po_no); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[3]); ?>">
        <td class="text-right">Date :</td>
        <td>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="date" name="po_date" class="form-control" value="<?php echo e(date('Y-m-d',strtotime($document->po_date))); ?>" <?php echo e($status); ?>>
            </div>
        </td>
    </tr>
    <tr class="<?php echo e($filter[4]); ?>">
        <td class="text-right">Purpose:</td>
        <td>
            <input type="text" name="purpose" class="form-control" value="<?php echo e($document->purpose); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[5]); ?>">
        <td class="text-right">Source of Fund / Charge To :</td>
        <td>
            <input type="text" name="source_fund" class="form-control" value="<?php echo e($document->source_fund); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[6]); ?>">
        <td class="text-right">Requested By :</td>
        <td>
            <?php $user = \App\Users::find($document->requested_by);?>
            <?php if($user): ?>
                <input type="text" name="requested_by" class="form-control" value="<?php echo e($user->lname); ?>, <?php echo e($user->fname); ?>" disabled />
            <?php endif; ?>
        </td>
    </tr>
    <tr class="<?php echo e($filter[7]); ?>">
        <td class="text-right">Route To :</td>
        <td>
            <input type="text" name="route_to" class="form-control" value="<?php echo e($document->route_to); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[8]); ?>">
        <td class="text-right">Route From :</td>
        <td>
            <input type="text" name="route_from" class="form-control" value="<?php echo e($document->route_from); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[9]); ?>">
        <td class="text-right">Supplier :</td>
        <td>
            <input type="text" name="supplier" class="form-control" value="<?php echo e($document->supplier); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[10]); ?>">
        <td class="text-right">Date of Event :</td>
        <td>
            <input type="date" name="event_date" class="form-control" value="<?php echo e($document->event_date); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[11]); ?>">
        <td class="text-right">Location of Event :</td>
        <td>
            <input type="text" name="event_location" class="form-control" value="<?php echo e($document->event_location); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[12]); ?>">
        <td class="text-right">Participants :</td>
        <td>
            <input type="text" name="event_participant" class="form-control" value="<?php echo e($document->event_participant); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[13]); ?>">
        <?php if($filter[13]!='hide'): ?>
        <?php $applicant = User::find($document->cdo_applicant); ?>
        <td class="text-right">Applicant :</td>
        <td>
            <input type="text" name="cdo_applicant" class="form-control" value="<?php echo e($document->cdo_applicant); ?>" <?php echo e($status); ?> />
        </td>
        <?php endif; ?>
    </tr>
    <tr class="<?php echo e($filter[14]); ?>">
        <td class="text-right">Number of Days :</td>
        <td>
            <input type="text" name="cdo_day" class="form-control" value="<?php echo e($document->cdo_day); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[15]); ?>">
        <td class="text-right">Date Range :</td>
        <td>
            <input type="text" class="form-control daterange" name="event_daterange" value="<?php echo e($document->event_daterange); ?>" <?php echo e($status); ?>>
        </td>
    </tr>
    <tr class="<?php echo e($filter[16]); ?>">
        <td class="text-right">Payee :</td>
        <td>
            <input type="text" name="payee" class="form-control" value="<?php echo e($document->payee); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[17]); ?>">
        <td class="text-right">Item/s :</td>
        <td>
            <input type="text" name="item" class="form-control" value="<?php echo e($document->item); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <?php if($access=='accounting'): ?>
    <tr class="<?php echo e($filter[18]); ?>">
        <td class="text-right">DV Number :</td>
        <td>
            <input type="text" name="dv_no" class="form-control" value="<?php echo e($document->dv_no); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <?php endif; ?>
    <?php if($access=='budget'): ?>
    <tr class="<?php echo e($filter[19]); ?>">
        <td class="text-right">ORS Number :</td>
        <td>
            <input type="text" name="ors_no" class="form-control" value="<?php echo e($document->ors_no); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <tr class="<?php echo e($filter[20]); ?>">
        <td class="text-right">Fund Source :</td>
        <td>
            <input type="text" name="fund_source_budget" class="form-control" value="<?php echo e($document->fund_source_budget); ?>" <?php echo e($status); ?> />
        </td>
    </tr>
    <?php endif; ?>
</table>

<div class="modal-footer">
    <?php if(Session::get('doc_type') == 'PRR_S'): ?>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <a href="<?php echo e(asset('prr_supply_page')); ?>" class="btn btn-warning"><i class="fa fa-barcode"></i> View Document</a>
    <?php elseif(Session::get('doc_type') == 'PRR_M'): ?>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <a href="<?php echo e($asset); ?>" class="btn btn-warning"><i class="fa fa-barcode"></i> View Document</a>
    <?php else: ?>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <?php if(!$status): ?>
        <button type="submit" class="btn btn-info" name="submit" value="update"><i class="fa fa-upload"></i> Update</button>
        <?php if($routed < 2): ?>
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#deleteDocument"><i class="fa fa-trash"></i> Remove</button>
        <?php endif; ?>
        <?php endif; ?>
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#paperSize"><i class="fa fa-barcode"></i> Barcode v1</button>
        <a target="_blank" href="<?php echo e(asset('pdf/track')); ?>" class="btn btn-success"><i class="fa fa-barcode"></i> Barcode v2</a>
    <?php endif; ?>
</div>
</form>

<script>
    $('.daterange').daterangepicker();
</script>
