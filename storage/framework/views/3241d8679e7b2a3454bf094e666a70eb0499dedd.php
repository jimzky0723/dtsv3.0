<?php
use App\Http\Controllers\ReleaseController as Rel;
use App\User;
?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-9 wrapper">
        <div class="alert alert-jim">
            <h2 class="page-header">Reported Documents</h2>
            <form id="accept_form" method="post">
                <?php echo e(csrf_field()); ?>

                <?php if(count($reported)): ?>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th width="8%"></th>
                            <th>Route No / Barcode</th>
                            <th>Delivered Date</th>
                            <th>Delivered By</th>
                            <th>Duration</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($reported as $doc): ?>
                            <tr>
                                <td>
                                    <a href="#track" data-link="<?php echo e(asset('document/track/'.$doc->route_no)); ?>" data-route="<?php echo e($doc->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a>
                                </td>
                                <td>
                                    <a class="title-info" data-route="<?php echo e($doc->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$doc->route_no.'/'.$doc->doc_type)); ?>" href="#document_info" data-toggle="modal">
                                        <?php echo e($doc->route_no); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php echo e(date('M d, Y',strtotime($doc->date_reported))); ?><br/>
                                    <?php echo e(date('h:i:s A',strtotime($doc->date_reported))); ?>

                                </td>
                                <?php
                                    $user = User::find($doc->reported_by);
                                ?>
                                <td><?php echo e($user->fname.' '.$user->lname); ?></td>
                                <td><?php echo e(Rel::duration($doc->date_reported)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php echo e($reported->links()); ?>

                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fa fa-info"></i> No reported document!
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div><br>
            </form>
            <hr />
            <div class="accepted-list">

            </div>
        </div>
    </div>
    <?php echo $__env->make('sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>