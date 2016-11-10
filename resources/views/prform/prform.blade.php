<table class="table table-hover table-form table-striped">
    <tr>
        <td class=""><label>Date</label></td>
        <td>:</td>
        <td><input name="date" value="{{ Carbon\Carbon::now() }}" class="form-control" disabled></td>
    </tr>
    <tr>
        <td class="col-sm-3"><label>PR #</label></td>
        <td class="col-sm-1">:</td>
        <td class="col-sm-8"><input type="text" name="prno" class="form-control"></td>
    </tr>
    <tr>
        <td class="col-sm-3"><label>Amount</label></td>
        <td class="col-sm-1">:</td>
        <td class="col-sm-8"><input type="number" name="amount" class="form-control"></td>
    </tr>
    <tr>
        <td class="col-sm-3"><label>Requested By</label></td>
        <td class="col-sm-1">:</td>
        <td class="col-sm-8"><input type="text" name="requestedby" class="form-control"></td>
    </tr>
    <tr>
        <td class="col-sm-3"><label>Charge to</label></td>
        <td class="col-sm-1">:</td>
        <td class="col-sm-8"><input type="text" name="chargeto" class="form-control"></td>
    </tr>
    <tr>
        <td class=""><label>Purpose</label></td>
        <td>:</td>
        <td><textarea class="form-control" rows="10" style="resize:none;"></textarea></td>
    </tr>
</table>