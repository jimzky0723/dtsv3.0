<form action="<?php echo e(asset('form/tev')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" name="prepared_by">
    <input type="hidden" value="<?php echo e(date('Y-m-d H:i:s')); ?>" name="prepared_date">
    <input type="hidden" value="TEV" name="doc_type">
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
                <td><input type="text" disabled value="<?php echo e(date('m/d/Y h:i:s A')); ?>"  class="form-control"></td>

            </tr>
            <tr>
                <td class=""><label>Amount</label></td>
                <td>:</td>
                <td><input type="text" name="amount" class="form-control" required onkeyup="acceptNumber($(this));"></td>

            </tr>
            <tr>
                <td class=""><label>Date Range</label></td>
                <td>:</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="reservation" name="daterange" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=""><label>Additional Information</label></td>
                <td>:</td>
                <td><textarea class="form-control" rows="10" style="resize:none;" name="description" required></textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success" onclick="$('form').attr('target','');"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>

<?php /*<table class="table table-bordered">*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td class="text-center" colspan="4">*/ ?>
            <?php /*Republic of the Philippines<br>*/ ?>
            <?php /*<strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO.VII</strong><br>*/ ?>
            <?php /*Osmeña Boulevard, Cebu City, 6000 Philippines<br>*/ ?>
            <?php /*Regional Director's Office Tel. No (032) 253-6355 Fax No. (032) 254-0109<br>*/ ?>
            <?php /*Official Website <a href="http://www.dohro7.gov.ph">www.dohro7.gov.ph</a> / Email Address dohro7@gmail.com*/ ?>
        <?php /*</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td class="text-center" colspan="4">*/ ?>
            <?php /*<strong>DISBURSEMENT VOUCHER</strong>*/ ?>
        <?php /*</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td class="col-sm-9 text-center" colspan="3">*/ ?>
            <?php /*<strong>MODE OF PAYMENT</strong><br>*/ ?>
            <?php /*<label class="col-sm-3">*/ ?>
                <?php /*<input type="radio" name="payment"> MDS Check*/ ?>
            <?php /*</label>*/ ?>
            <?php /*<label class="col-sm-3">*/ ?>
                <?php /*<input type="radio" name="payment"> Commercial Check*/ ?>
            <?php /*</label>*/ ?>
            <?php /*<label class="col-sm-3">*/ ?>
                <?php /*<input type="radio" name="payment"> ADA*/ ?>
            <?php /*</label>*/ ?>
            <?php /*<label class="col-sm-3">*/ ?>
                <?php /*<input type="radio" name="payment"> Other*/ ?>
            <?php /*</label>*/ ?>
        <?php /*</td>*/ ?>
        <?php /*<td class="col-sm-3">*/ ?>
            <?php /*No.:<br>*/ ?>
            <?php /*Date:*/ ?>
        <?php /*</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td class="col-sm-6" rowspan="2" colspan="2">*/ ?>
            <?php /*Payee / Office:<br>*/ ?>
            <?php /*<input type="text" class="form-control" name="payee">*/ ?>
        <?php /*</td>*/ ?>
        <?php /*<td class="col-sm-3" rowspan="2">*/ ?>
            <?php /*TIN/Employee No.:<br>*/ ?>
            <?php /*<input type="text" name="tin" class="form-control">*/ ?>
        <?php /*</td>*/ ?>
        <?php /*<td class="col-sm-3">OS/BUS No.:</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td>Date:</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td class="col-sm-6" rowspan="2" colspan="2">*/ ?>
            <?php /*Address:<br>*/ ?>
            <?php /*<textarea name="address" class="col-sm-12"></textarea>*/ ?>
        <?php /*</td>*/ ?>
        <?php /*<td class="col-sm-3" colspan="2">*/ ?>
            <?php /*Responsibility Center*/ ?>
        <?php /*</td>*/ ?>
    <?php /*</tr>*/ ?>
    <?php /*<tr>*/ ?>
        <?php /*<td>Title:</td>*/ ?>
    <?php /*</tr>*/ ?>
<?php /*</table>*/ ?>