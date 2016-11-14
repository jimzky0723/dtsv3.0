<div class="modal fade" tabindex="-1" role="dialog" id="track">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-line-chart"></i> Track Document</h4>
            </div>
        <div class="modal-body">             
            <table class="table table-hover table-form table-striped">
                <tr>
                    <td class="col-sm-3"><label>Route Number</label></td>
                    <td class="col-sm-1">:</td>
                    <td class="col-sm-8"><input type="text" disabled value="D1234679" class="form-control"></td>

                </tr>
                <tr>
                    <td class=""><label>Prepared Date</label></td>
                    <td>:</td>
                    <td><input type="text" disabled value="10/26/2016" class="form-control"></td>
                </tr>                    
            </table>
            <hr />                
            <div class="track_history">
                <table class="table table-hover table-striped">
                    <caption>Tracking History</caption>
                    <thead>
                        <tr>
                            <th width="25%">Date / Time In</th>
                            <th width="25%">Received By</th>
                            <th width="25%">Remarks</th>
                            <th width="25%">Duration</th>
                        </tr>
                    </thead>
                    <tbody class="content_history">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="button" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="document_form">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Create Document</h4>
                </div>
            <div class="modal_content"></div>
                        
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->