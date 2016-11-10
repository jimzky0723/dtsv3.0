<form action="{{ asset('document/salary') }}" method="POST">
{{ csrf_field() }}
    <div class="modal-body">                                                            
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Prepared By</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" disabled value="{{ Auth::user()->name }}" name="prepared_by" class="form-control"></td>

            </tr>
            <tr>
                <td class=""><label>Prepared Date</label></td>
                <td>:</td>
                <td><input type="text" disabled value="{{ date('m/d/Y h:i:s') }}" name="date_prepared" class="form-control"></td>

            </tr>
            <tr>
                <td class=""><label>Amount</label></td>
                <td>:</td>
                <td><input type="text" name="amount" class="form-control"></td>

            </tr>
            <tr>
                <td class=""><label>Additional Information</label></td>
                <td>:</td>
                <td><textarea class="form-control" rows="10" style="resize:none;"></textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
 </form>