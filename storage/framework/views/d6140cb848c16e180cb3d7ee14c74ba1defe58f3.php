<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User;
?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <?php if(session('status')): ?>
                <?php
                $status = session('status');
                ?>
                <?php if(isset($status['success'])): ?>
                    <div class="alert alert-success">
                        <ul>
                            <?php foreach($status['success'] as $success): ?>
                                <li><?php echo $success; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(isset($status['errors'])): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach($status['errors'] as $error): ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <h2 class="page-header">Pending Documents</h2>
            <form id="accept_form" method="post">
                <?php echo e(csrf_field()); ?>

                <?php if(count($pending)): ?>
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="30%">Route No / Barcode</th>
                        <th width="30%">Document Type</th>
                        <th>From</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pending as $doc): ?>
                        <tr>
                            <td>
                                <a class="title-info" data-route="<?php echo e($doc->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$doc->route_no.'/'.Auth::user()->id.'/'.$doc->doc_type)); ?>" href="#document_info" data-toggle="modal">
                                <?php echo e($doc->route_no); ?>

                                </a>
                            </td>
                            <td><?php echo e(Doc::docTypeName($doc->doc_type)); ?></td>
                            <?php
                                $user = User::find($doc->delivered_by);
                            ?>
                            <td><?php echo e($user->fname.' '.$user->lname); ?></td>
                            <td>
                                <?php echo e(Doc::timeDiff($doc->date_in)); ?>

                            </td>
                            <td>
                                <a href="#remove_pending" data-link="<?php echo e(asset('document/removepending/'.$doc->id)); ?>" data-id="<?php echo e($doc->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Done</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo e($pending->links()); ?>

                <?php else: ?>
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No pending document!
                </div>
                <?php endif; ?>
                <div class="clearfix"></div><br>
            </form>
            <hr />
            <div class="accepted-list">

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>