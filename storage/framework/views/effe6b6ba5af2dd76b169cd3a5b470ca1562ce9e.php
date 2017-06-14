<?php $__env->startSection('content'); ?>
    <span id="url" data-link="<?php echo e(asset('/designation')); ?>"></span>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Designations</h2>
        <form class="form-inline form-accept" action="<?php echo e(asset('search/designation')); ?>" id="search_designation" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-link="<?php echo e(asset('/designation/create')); ?>" href="#new">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php if(count($designations) > 0): ?>
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th width="20%">Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($designations as $d): ?>
                        <tr>
                            <td class="title-info"><?php echo e($d->description); ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-id="<?php echo e($d->id); ?>" onclick="edit_designation(this);"><i class="fa fa-pencil"></i> Update </button>
                                <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo e($d->id); ?>" onclick="delete_designation(this);"><i class="fa fa-trash"></i> Delete </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($designations->links()); ?>

        <?php else: ?>
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>Record is empty.</strong>
            </div>
        <?php endif; ?>
    </div>
    <span data-link="<?php echo e(asset('/remove/designation')); ?>" id="delete"></span>
    <span data-link="<?php echo e(asset('/edit/designation')); ?>" id="edit"></span>
    <span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin'); ?>
    <script src="<?php echo e(asset('resources/plugin/daterangepicker/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    @parent
    <script>
        $('#search_designation').submit(function(){
           $(this).submit();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>