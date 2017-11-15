<?php
use App\Http\Controllers\DocumentController as Doc;
use App\User;
$pending = Doc::pendingDocuments();
$count = 0;
$duration="duration"."0";
$count_pending = count(Doc::countPendingDocuments());

$online = Doc::countOnlineUsers();
?>
<span id="url" data-link="<?php echo e(asset('date_in')); ?>"></span>
<span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">WHO'S ONLINE</h3>
        </div>
        <div class="panel-body text-success">
            <center>
                <a href="#online" data-toggle="modal" class="online text-success" data-url="<?php echo e(asset('online')); ?>"><i class="fa fa-users fa-3x"></i></a><br />
                <div style="margin-top:10px"></div>
                <font class="text-bold">
                    <a href="#online" data-toggle="modal" class="online text-success" data-url="<?php echo e(asset('online')); ?>">
                    <?php if($online<=1): ?>
                        <?php echo e($online); ?> Online User
                    <?php else: ?>
                        <?php echo e($online); ?> Online Users
                    <?php endif; ?>
                    </a>
                </font>
            </center>
        </div>
    </div>

    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">PENDING DOCUMENTS</h3>
            <?php if($count_pending>0): ?>
                <small><a href="<?php echo e(asset('document/pending')); ?>" style="color:#fff">[<?php echo e($count_pending); ?> Documents]</a></small>
            <?php endif; ?>
        </div>
        <div class="panel-body">
            <?php foreach($pending as $pend): ?>
                <table class="table table-hover table-<?php echo e($pend->id); ?> <?php echo e($pend->route_no); ?>">
                    <thead>
                    <tr><th><?php echo e(Doc::getDocType($pend->route_no)); ?></th></tr>
                    </thead>
                    <tbody>
                    <tr><td>Route #: <?php echo e($pend->route_no); ?></td></tr>
                    <?php
                    $user = User::find($pend->delivered_by);
                    Session::put('date_in',array($pend->date_in));
                    ?>
                    <tr><td>From:
                            <?php if($user): ?>
                                <?php echo e($user->fname); ?>

                                <?php echo e($user->lname); ?>

                                <br>
                                <em>(<?php echo e(\App\Section::find($user->section)->description); ?>)</em>
                            <?php else: ?>

                                <?php
                                $x = \App\Tracking_Details::where('received_by',0)
                                        ->where('id','<',$pend->id)
                                        ->where('route_no',$pend->route_no)
                                        ->first();
                                $string = $x->code;
                                $temp1   = explode(';',$string);
                                $temp2   = array_slice($temp1, 1, 1);
                                $section_id = implode(',', $temp2);
                                $x_section = \App\Section::find($section_id)->description;
                                ?>
                                <font class="text-bold text-danger">
                                    <?php echo e($x_section); ?><br />
                                    <em>(Unconfirmed)</em>
                                </font>
                            <?php endif; ?>
                        </td></tr>
                    <tr>
                        <td>
                           <?php echo e(Doc::timeDiff($pend->date_in)); ?>

                        </td>
                    </tr>
                    <tr><td>
                            <a data-route="<?php echo e($pend->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$pend->route_no.'/'.$pend->doc_type)); ?>" href="#document_info" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-bookmark"></i> Details</a>
                            <a href="#remove_pending" data-link="<?php echo e(asset('document/removepending/'.$pend->id)); ?>" data-id="<?php echo e($pend->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Done</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" value="<?php echo e(Doc::timeDiff($pend->date_in)); ?>" id="time">
            <?php endforeach; ?>
            <input type="hidden" value="<?php echo e($count); ?>" id="count">
            <script type="text/javascript">
                function refresh_c(){
                    var refresh=1000; // Refresh rate in milli seconds
                    mytime=setTimeout('display_duration()',refresh)
                }
                function display_duration() {
                    refresh_c();
                    var count = $("#count").val();
                    for(var i=count; i>0; i--) {
                        get_duration(i-1,i-1);
                    }
                }
                function get_duration(urlCount,durationCount){
                    var url = $("#url").data('link') + "/" + urlCount;
                    $.get(url, function (data) {
                        $("#duration" + durationCount).html(data);
                    });
                }
            </script>
            <?php if(!count($pending)): ?>
                <div class="alert alert-success text-center">
                    <h4><strong>Congrats!</strong><br>
                        <div style="margin-top:10px"></div>
                        You don't have pending documents.</h4>

                </div>

            <?php endif; ?>
        </div>
    </div>
</div>


