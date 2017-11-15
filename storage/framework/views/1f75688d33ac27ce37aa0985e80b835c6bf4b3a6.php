<?php
use App\Http\Controllers\DocumentController as Doc;
use App\User;
use App\Http\Controllers\ReleaseController as Rel;
?>

<?php $__env->startSection('content'); ?>
    <style>
        .panel-incoming .panel-heading{
            background: #7ABA7A;
        }
        .panel-incoming {
            border-color: #7ABA7A;
        }

        .panel-unconfirmed .panel-heading{
            background: #028482;
        }
        .panel-unconfirmed {
            border-color: #028482;
        }
        #incomingInput, #outgoingInput, #uncofirmInput {
            background-image: url('<?php echo e(url('resources/img/searchicon.png')); ?>'); /* Add a search icon to input */
            background-position: 9px 8px ; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }
        .table-jim tr td:first-child {
            width:30%;
            text-align: right;
            font-weight: bold;
            font-size: 0.9em;
        }
        .table-jim {
            width: 100%;
            max-width: 100%;
        }
        .table-jim td {
            padding:3px 5px;
            vertical-align: top;
        }
        .title {
            font-size: 0.9em;
            width:30%;
            text-align: right;
            padding:0px;
        }
        .panel-title .badge {
            background: #fff;
            color: #00a7d0;
        }
    </style>
    <link rel="stylesheet" href="<?php echo asset('resources/plugin/dataTable/css/dataTables.bootstrap.min.css');?>" type="text/css" />
    <div class="col-sm-4 wrapper">
        <div class="panel panel-jim panel-incoming">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Incoming Documents
                    <?php if(count($data['incoming'])): ?>
                    <span class="badge badgeIncoming"><?php echo e(count($data['incoming'])); ?></span>
                    <?php endif; ?>
                </h3>
            </div>
            <?php if(count($data['incoming'])): ?>
            <div class="panel-body">
                <input type="text" id="incomingInput" class="form-control" onkeyup="incomingFunction()" placeholder="Search for route # or keyword..">
            </div>

            <ul class="list-group" id="incomingUL">
                <?php foreach($data['incoming'] as $row): ?>
                <li class="list-group-item" data-id="<?php echo e($row->id); ?>">
                    <table class="table-jim">
                        <tr>
                            <td>Route No.:</td>
                            <td><a data-route="<?php echo e($row->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$row->route_no.'/'.$row->doc_type)); ?>" href="#document_info" data-toggle="modal"><?php echo e($row->route_no); ?></a></td>
                        </tr>
                        <tr>
                            <?php
                                $user = User::find($row->delivered_by);
                                $section = \App\Section::find($user->section)->description;
                            ?>
                            <td>Delivered By:</td>
                            <td><?php echo e($user->fname); ?> <?php echo e($user->lname); ?><br /><small>(<?php echo e($section); ?>)</small></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td><?php echo e(Doc::getDocType($row->route_no)); ?></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td><?php echo e(Rel::duration($row->date_in)); ?></td>
                        </tr>
                        <tr>
                            <td>Remarks:</td>
                            <td><?php echo $row->action; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="#track" data-link="<?php echo e(asset('document/track/'.$row->route_no)); ?>" data-route="<?php echo e($row->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-info">Track</a>
                                <a href="#" class="btn btn-sm btn-success btn-accept">Accept</a>
                                <?php
                                    $diff = Rel::hourDiff($row->date_in);
                                ?>
                                <?php if($diff>=0.5): ?>
                                    <a href="#" class="btn btn-warning btn-sm btn-return" data-id="<?php echo e($row->id); ?>">Return</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-warning">
                        <div class="text-center text-bold">
                            <i class="fa fa-check"></i> No incoming documents...
                        </div>
                    </li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-4 wrapper">
        <div class="panel panel-jim panel-outgoing">
            <div class="panel-heading">
                <h3 class="panel-title">Outgoing / Returned Documents
                    <?php if(count($data['outgoing'])): ?>
                        <span class="badge badgeOutgoing"><?php echo e(count($data['outgoing'])); ?></span>
                    <?php endif; ?>
                </h3>
            </div>
            <?php if(count($data['outgoing'])): ?>
            <div class="panel-body">
                <input type="text" id="outgoingInput" class="form-control" onkeyup="outgoingFunction()" placeholder="Search for route # or keyword..">
            </div>

            <ul class="list-group" id="outgoingUL">
                <?php foreach($data['outgoing'] as $row): ?>
                <?php
                    $code = $row->code;
                    $string = explode(';',$code);
                    $status = $string[0];
                    $class = '';
                    if($status==='return'){
                        $class ='list-group-item-danger';
                    }
                ?>
                <li class="list-group-item <?php echo e($class); ?>" data-id="<?php echo e($row->id); ?>">
                    <table class="table-jim">
                        <tr>
                            <td>Route No.:</td>
                            <td><a data-route="<?php echo e($row->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$row->route_no.'/'.$row->doc_type)); ?>" href="#document_info" data-toggle="modal"><?php echo e($row->route_no); ?></a></td>
                        </tr>
                        <?php if($status!='return'): ?>
                        <tr>
                            <?php
                                $user = User::find($row->received_by);
                                $name = $user->fname.' '.$user->lname;
                            ?>
                            <td>Received By:</td>
                            <td><?php echo e($name); ?></td>
                        </tr>
                        <tr>
                            <?php
                            $user = User::find($row->delivered_by);
                            ?>
                            <td>Delivered By:</td>
                            <td>
                                <?php if($user): ?>
                                    <?php echo e($user->fname); ?> <?php echo e($user->lname); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php else: ?>
                            <tr>
                                <td>Status:</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td>Remarks:</td>
                                <td><?php echo $row->action; ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Type:</td>
                            <td><?php echo e(Doc::getDocType($row->route_no)); ?></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td><?php echo e(Rel::duration($row->date_in)); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="#track" data-link="<?php echo e(asset('document/track/'.$row->route_no)); ?>" data-route="<?php echo e($row->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-info">Track</a>
                                <button data-toggle="modal" data-target="#releaseTo" data-id="<?php echo e($row->id); ?>" data-route_no="<?php echo e($row->route_no); ?>" onclick="putRoute($(this))" type="button" class="btn btn-success btn-sm">Release</button>
                                <button type="button" data-link="<?php echo e(asset('document/removepending/'.$row->id)); ?>" data-id="<?php echo e($row->id); ?>" class="btn btn-sm btn-warning btn-end">Cycle End</button>
                            </td>
                        </tr>
                    </table>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-warning">
                        <div class="text-center text-bold">
                            <i class="fa fa-check"></i> No outgoing or returned documents...
                        </div>
                    </li>
                    <ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-4 wrapper">
        <div class="panel panel-jim panel-unconfirmed">
            <div class="panel-heading">
                <h3 class="panel-title">Unconfirmed Documents
                    <?php if(count($data['unconfirm'])): ?>
                        <span class="badge badgeUnconfirm"><?php echo e(count($data['unconfirm'])); ?></span>
                    <?php endif; ?>
                </h3>
            </div>
            <?php if(count($data['unconfirm'])): ?>
            <div class="panel-body">
                <input type="text" id="uncofirmInput" class="form-control" onkeyup="uncofirmFunction()" placeholder="Search for route # or keyword..">
            </div>

            <ul class="list-group" id="uncofirmUL">
                <?php foreach($data['unconfirm'] as $row): ?>

                <li class="list-group-item" data-id="<?php echo e($row->id); ?>">
                    <table class="table-jim">
                        <tr>
                            <td>Route No.:</td>
                            <td><a data-route="<?php echo e($row->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$row->route_no.'/'.$row->doc_type)); ?>" href="#document_info" data-toggle="modal"><?php echo e($row->route_no); ?></a></td>
                        </tr>
                        <tr>
                            <?php
                            $user = User::find($row->delivered_by);
                            ?>
                            <td>Delivered By:</td>
                            <td><?php echo e($user->fname); ?> <?php echo e($user->lname); ?></td>
                        </tr>
                        <tr>
                            <?php
                                $temp = explode(';',$row->code);
                                $section = \App\Section::find($temp[1])->description;
                            ?>
                            <td>Delivered To:</td>
                            <td><?php echo e($section); ?></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td><?php echo e(Doc::getDocType($row->route_no)); ?></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td>
                                <?php if(Rel::duration($row->date_in)==null): ?>
                                    Just Now
                                <?php endif; ?>
                                <?php echo e(Rel::duration($row->date_in)); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="#track" data-link="<?php echo e(asset('document/track/'.$row->route_no)); ?>" data-route="<?php echo e($row->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-info">Track</a>
                                <button type="button" class="btn btn-sm btn-default btn-cancel">Cancel</button>
                                <?php if(($row->alert == 0)&&(Rel::hourDiff($row->date_in)>=4)): ?>
                                <button type="button" class="btn btn-sm btn-warning btn-alert">Alert</button>
                                <?php endif; ?>

                                <?php if(($row->alert == 1)&&(Rel::hourDiff($row->date_in)>=8)): ?>
                                <button type="button" class="btn btn-sm btn-warning btn-alert2">Warning</button>
                                <?php endif; ?>

                                <?php if(($row->alert == 2)&&(Rel::hourDiff($row->date_in)>=12)): ?>
                                <button type="button" class="btn btn-sm btn-danger btn-report">Report</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-warning">
                        <div class="text-center text-bold">
                            <i class="fa fa-check"></i> No unconfirmed documents...
                        </div>
                    </li>
                <ul>
            <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('modal.release_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo asset('resources/plugin/dataTable/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo asset('resources/plugin/dataTable/js/dataTables.bootstrap.min.js');?>"></script>
    <?php echo $__env->make('js.release_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>