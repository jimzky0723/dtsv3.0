
<form action="<?php echo e(asset('/form/routing/slip/')); ?>" method="POST" id="form_route">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="doctype" value="ROUTE" />
    <div class="modal-body">
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Prepared By</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" disabled value="<?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->mname); ?> <?php echo e(Auth::user()->lname); ?>" class="form-control"></td>
            </tr>
            <tr>
                <td class=""><label>Prepared Date</label></td>
                <td>:</td>
                <td><input type="text" disabled value="<?php echo e(date('m/d/Y h:i:s')); ?>" name="date_prepared" class="form-control"></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Routed from:</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="routed_from" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Routed to:</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="routed_to" class="form-control" required></td>
            </tr>
            <tr>
                <td class=""><label>Additional Information</label></td>
                <td>:</td>
                <td><textarea class="form-control" name="description" rows="10" style="resize:none;" required></textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>
