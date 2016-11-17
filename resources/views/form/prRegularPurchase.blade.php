<form action="{{ asset('prRegularPurchase') }}" method="POST" target="_blank">
    <input type="hidden" name="doctype" value="PRR">
    <input type="hidden" value="{{ Auth::user()->id }}" name="preparedby">
{{ csrf_field() }}
    <div class="modal-body">  
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class=""><label>Prepared Date</label></td>
                <td>:</td>
                <td><input name="prepareddate" value="{{ date('Y-m-d H:i:s') }}" class="form-control" readonly></td>
            </tr>
            <tr>
                <td class=""><label>Prepared By</label></td>
                <td>:</td>
                <td><input type="text" value="{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}" class="form-control" disabled></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>PR #</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="pr_no" name="pr_no" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Amount</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="number" id="amount" name="amount" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Requested By</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="requestedby" name="requestedby" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Charge to</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="chargeto" name="chargeto" class="form-control" required></td>
            </tr>
            <tr>
                <td class=""><label>Purpose</label></td>
                <td>:</td>
                <td><textarea class="form-control" id="purpose" name="purpose" rows="10" style="resize:none;" required></textarea></td>
            </tr>
        </table>   
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" onclick="PRR_reload();" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>