<?php $__env->startSection('content'); ?>
    <span id="url" data-link="<?php echo e(asset('users')); ?>"></span>
    <span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">System Users</h2>
        <form class="form-inline form-accept" action="<?php echo e(asset('/search/user')); ?>" method="GET">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-link="<?php echo e(asset('user/new')); ?>" href="#new">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php if(Session::has('used')): ?>
            <div class="alert alert-danger">
                <strong><?php echo e(Session::get('used')); ?></strong>
            </div>
        <?php endif; ?>
        <?php if(count($users) > 0): ?>
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name </th>
                        <th>Designation</th>
                        <th>Section / Division</th>
                        <th width="20%">Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <?php $section = \App\Section::where('id', $user->section)->pluck('description')->first(); ?>
                        <?php $division = \App\Division::where('id', $user->division)->pluck('description')->first(); ?>
                        <?php $designation = \App\Designation::where('id', $user->designation)->pluck('description')->first(); ?>

                        <tr>
                            <td><a href="#user" data-id="<?php echo e($user->id); ?>" data-link="<?php echo e(asset('user/edit')); ?>" class="title-info"><?php echo e($user->username); ?></a></td>
                            <td><a href="#user" data-id="<?php echo e($user->id); ?>" data-link="<?php echo e(asset('user/edit')); ?>" class="text-bold"><?php echo e($user->fname ." ". $user->mname." ".$user->lname); ?></a></td>
                            <td><?php echo e($designation); ?></td>
                            <td>
                                <?php echo e($section); ?><br>
                                <em>(<?php echo e($division); ?>)</em>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="#user" class="btn btn-sm btn-info" data-toggle="modal" data-link="<?php echo e(asset('user/edit')); ?>" data-id="<?php echo e($user->id); ?>">
                                        <i class="fa fa-pencil"></i>  Update
                                    </a>
                                </div>
                                <button type="button" data-id="<?php echo e($user->id); ?>" data-link="<?php echo e(asset('user/remove')); ?>" class="btn btn-danger" id="delete_user" onclick="del_user(this);" name="delete" value="delete" ><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($users->links()); ?>

        <?php else: ?>
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>No users found.</strong>
            </div>
        <?php endif; ?>
    </div>

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
        (function($){
            $('.form-accept').submit(function(event){
                $(this).submit();
            });
        })($);

    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>