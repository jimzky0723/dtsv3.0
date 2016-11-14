<form action="{{ asset('prform') }}" method="POST">
<input type="hidden" name="doctype" value="PRC">
{{ csrf_field() }}
    <div class="modal-body">  
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class=""><label>Prepared Date</label></td>
                <td>:</td>
                <td><input name="date" value="{{ Carbon\Carbon::now() }}" class="form-control" readonly></td>
            </tr>
            <tr>
                <td class=""><label>Prepared By</label></td>
                <td>:</td>
                <td><input type="hidden" name="preparedby" value="{{ Auth::user()->id }}"><input value="{{ Auth::user()->name }}" class="form-control" readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>PR #</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="prno" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Amount</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="number" name="amount" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Requested By</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="requestedby" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Charge to</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="chargeto" class="form-control" required></td>
            </tr>
            <tr>
                <td class=""><label>Purpose</label></td>
                <td>:</td>
                <td><textarea class="form-control" name="purpose" rows="10" style="resize:none;"></textarea></td>
                <?php echo DNS1D::getBarcodeHTML("4445645656", "C39"); ?>
            </tr>
        </table>   
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>