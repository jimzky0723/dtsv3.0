<form action="{{ asset('form/salary') }}" method="POST">
{{ csrf_field() }}
    <input type="hidden" value="{{ Auth::user()->id }}" name="prepared_by">
    <input type="hidden" value="SAL" name="doc_type">
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
                <td><input type="text" disabled value="{{ date('m/d/Y') }}" name="date_prepared" class="form-control"></td>

            </tr>
            <tr>
                <td class=""><label>DV No.</label></td>
                <td>:</td>
                <td><input type="text" name="dv_no" class="form-control" required onkeyup="acceptNumber($(this));"></td>

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
                        <input type="text" class="form-control" id="reservation" name="daterange" value="" onclick="dateRange($(this))">
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
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
 </form>