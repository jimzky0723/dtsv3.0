<form action="{{ asset('addSection') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal-body">
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Description</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="description" class="form-control" required></td>
            </tr>
            <tr>
                <td class=""><label>Head</label></td>
                <td>:</td>
                <td>
                    <select name="head" id="" class="form-control" required>
                        <option value="">Select Head</option>
                        @foreach($user as $head)
                            <option value="{{ $head['id'] }}">{{ $head['fname'].' '.$head['mname'].' '.$head['lname'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success" onclick="$('form').attr('taraget','');"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>

