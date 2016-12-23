<form action="{{ asset('/form/justification/letter') }}" method="POST" id="form_route"
      xmlns="http://www.w3.org/1999/html">
    {{ csrf_field() }}
    <input type="hidden" name="doctype" value="JUST_LETTER" />
    <div class="modal-body">
        <table>
            <tr>
                <td class="col-md-1"><img height="130" width="130" src="{{ asset('resources/img/ro7.png') }}" /></td>
                <td class="col-lg-10" style="text-align: center;">
                    Repulic of the Philippines <br />
                    <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br />
                    Osmeña Boulevard, Cebu City, 6000 Philippines <br />
                    Regional Director's Office Tel. No. (032) 253-635-6355 Fax No. (032) 254-0109 <br />
                    Official Website:<a target="_blank" href="http://www.ro7.doh.gov.ph"><u>http://www.ro7.doh.gov.ph</u></a> Email Address: dohro7{{ '@' }}gmail.com
                </td>
                <td class="col-md-10"><img height="130" width="130" src="{{ asset('resources/img/ro7.png') }}" /> </td>
            </tr>
        </table>
        <hr style="border: 1px solid #333;" />
        <div class="container-fluid">
            <div class="row">
                <label class="col-md-2">Prepared by :</label>
                <label class="col-md-6" style="font-weight: bolder;font-size: medium;color: #985f0d;">{{ $user }}</label>
            </div>
            <div class="row">
                <div class="col-md-2"><strong>To</strong></div>
                <div class="col-md-10">
                    <div class="row">
                        <span class="col-md-4">Name</span>
                        <span class="col-md-4">Designation</span>
                    </div>
                    <div class="row">
                        <span class="col-md-4">
                            <span class="form-group">
                                <input type="text" name="name_to[]" class="form-control" id="to-name-1" />
                            </span>
                        </span>
                        <span class="col-md-4">
                            <span class="form-group">
                                <input type="text" name="desig_to[]" class="form-control" id="to-dis-1" />
                            </span>
                        </span>
                        <span class="col-md-1">
                            <span class="glyphicon glyphicon-plus btn btn-success" onclick="add_to_field(this);" aria-hidden="true"></span>
                        </span>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-2"><strong>Thru</strong></div>
                <div class="col-md-10">
                    <div class="row">
                        <span class="col-md-4">Name</span>
                        <span class="col-md-4">Designation</span>
                    </div>
                    <div class="row">
                        <span class="col-md-4">
                            <span class="form-group">
                                <input type="text" name="name_thru[]" class="form-control has-error" id="thru-name-1" />
                            </span>
                        </span>
                        <span class="col-md-4">
                            <span class="form-group">
                                <input type="text" name="desig_thru[]" class="form-control has-error" id="thru-des-1" />
                            </span>
                        </span>
                        <span class="col-md-1">
                            <span class="glyphicon glyphicon-plus btn btn-success" onclick="add_thru_field(this);" aria-hidden="true"></span>
                        </span>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-2"><strong>Message/Remarks</strong></div>
                <div class="col-md-10">
                    <textarea class="form-control" name="description" rows="10" style="resize:none;" required></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>
<script>

    var to_name = 1;
    var to_des = 1;
    var thru_name = 1;
    var thru_des = 1;
    var error = false;
    function add_to_field(el){
        var before_el = $(el).before();
        var to = $('#to-name-' + to_name);
        var des = $('#to-dis-' + to_des);
        if(to.val() == "" || to.val() == null) {
            to.parent().addClass(' has-error');
            to.parent().append("<label style='color:red;'>Required</label>");
            error = true;
        }
        if(des.val() == "" || des.val() == null){
            des.parent().addClass(' has-error');
            des.parent().append("<label style='color:red;'>Required</label>");
            error = true;
        }
        if(! error){

        }

        $(el).parent().parent().after('' +
                '<div class="row"> ' +
                '<br />' +
                '<span class="col-md-4"> ' +
                '<input type="text" name="name_to[]" class="form-control" /> ' +
                '</span> '+
                '<span class="col-md-4"> ' +
                '<input type="text" name="desig_to[]" class="form-control" /> ' +
                '</span> ' +
                '<span class="col-md-1"> ' +
                '<span class="glyphicon glyphicon-minus btn btn-danger" onclick="remove_field(this);" aria-hidden="true"></span>' +
                '</span>' +
                '</div>');

    }
    function remove_field(el){
        $(el).parent().parent().remove();
    }

    function add_thru_field(el){
        $(el).parent().parent().after('' +
                '<div class="row"> ' +
                '<br />' +
                '<span class="col-md-4"> ' +
                '<input type="text" name="name_thru[]" class="form-control" /> ' +
                '</span> '+
                '<span class="col-md-4"> ' +
                '<input type="text" name="desig_thru[]" class="form-control" /> ' +
                '</span> ' +
                '<span class="col-md-1"> ' +
                '<span class="glyphicon glyphicon-minus btn btn-danger" onclick="remove_field(this);" aria-hidden="true"></span>' +
                '</span>' +
                '</div>');
    }
</script>