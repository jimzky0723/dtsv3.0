<div class="modal fade" tabindex="-1" role="dialog" id="track">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class=""><i class="fa fa-line-chart"></i> Track Document</h4>
            </div>
        <div class="modal-body">             
            <table class="table table-hover table-form table-striped">
                <tr>
                    <td class="col-sm-3"><label>Route Number</label></td>
                    <td class="col-sm-1">:</td>
                    <td class="col-sm-8"><input type="text" readonly id="track_route_no" value="" class="form-control"></td>
                </tr>
            </table>
            <hr />                
            <div class="track_history"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="button" class="btn btn-success" onclick="window.open('<?php echo e(asset('pdf/track')); ?>')"><i class="fa fa-print"></i> Print</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="trackDoc">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class=""><i class="fa fa-line-chart"></i> Track Document</h4>
            </div>
            <div class="modal-body">
                <table class="table table-form">
                    <tr>
                        <form action="<?php echo e(asset('document/track')); ?>" id="trackForm" onsubmit="return trackDocument(event);">
                            <?php echo e(csrf_field()); ?>

                            <td class="col-sm-4"><label>Route Number</label></td>
                            <td class="col-sm-7"><input type="text" placeholder="Enter route number..." id="track_route_no2" class="form-control"></td>
                            <td class="col-sm-1"><button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Track</button> </td>
                        </form>
                    </tr>
                </table>
                <hr />
                <div class="track_history"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="button" class="btn btn-success btn-print hide" onclick="window.open('<?php echo e(asset('pdf/track')); ?>')"><i class="fa fa-print"></i> Print</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="document_form">
    <div id="my_modal" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Create Document</h4>
            </div>
        <div class="modal_content"><center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center></div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="general_form">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <fieldset style="padding: 0px;margin:0px;">
                    <legend id="general_form_title">Create Document</legend>
                </fieldset>
                <div id="general_form_content">
                    <center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="document_info">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Document</h4>
            </div>
            <div class="modal-body">
                <div class="modal_content"><center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="paperSize" style="z-index:999991;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4><i class="fa fa-file-pdf-o"></i> Select Paper Size</h4>
            </div>
            <div class="modal-body text-center">
                <div class="col-xs-4">
                    <a href="<?php echo e(asset('pdf/v1/letter')); ?>" class="text-success" target="_blank">
                        <i class="fa fa-file-pdf-o fa-5x"></i><br>
                        Letter
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="<?php echo e(asset('pdf/v1/a4')); ?>" class="text-info" target="_blank">
                        <i class="fa fa-file-pdf-o fa-5x"></i><br>
                        A4
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="<?php echo e(asset('pdf/v1/legal')); ?>" class="text-warning" target="_blank">
                        <i class="fa fa-file-pdf-o fa-5x"></i><br>
                        Legal
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <br />

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="document_info_pending" style="z-index: 999999">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Document</h4>
            </div>
            <div class="modal_content"><center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="confirmation">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> DTS Says:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong>Are you sure you want to remove <p style="display: inline;" id="nametoDelete"></p>?</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                <button type="button" class="btn btn-danger" id="confirm" data-dismiss="modal"><i class="fa fa-trash"></i> Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="calendar_modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Document</h4>
            </div>
            <div class="modal_content"><center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="online" style="margin-top: 30px;z-index: 99999;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <table class="table table-hover">
                    <caption style="font-weight: bold" class="text-success">Who's Online</caption>
                    <tbody class="onlineContent">
                        <tr>
                            <td>
                                <center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="infoPending" style="margin-top: 30px;z-index: 99999;">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <table class="table table-hover">
                <caption style="font-weight: bold" class="text-success"><i class="fa fa-bookmark"></i> Details</caption>
            </table>
            <div class="pendingInfo">
                
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteDocument">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> DTS Says:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong>Are you sure you want to delete this document?</strong>
                </div>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(asset('document/update')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    <button type="submit" name="delete" class="btn btn-danger" ><i class="fa fa-trash"></i> Yes</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->