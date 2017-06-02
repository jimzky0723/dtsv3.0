<?php use \App\Http\Controllers\SectionController as Section; ?>

<?php $__env->startSection('content'); ?>
    <span id="url" data-link="<?php echo e(asset('searchSection')); ?>"></span>
    <span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Sections</h2>
        <form class="form-inline form-accept">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Quick Search" id="search" autofocus>
                <button type="submit" class="btn btn-default" onclick="searchSection($(this));" data-link="<?php echo e(asset('searchSection')); ?>"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a href="#document_form" class="btn btn-success" data-toggle="modal" data-link="<?php echo e(asset('addSection')); ?>">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php if(count($section)): ?>
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="40%">Description</th>
                        <th width="40%">Head</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($section as $sec): ?>
                        <tr>
                            <td><a class="title-info"><?php echo e($sec->description); ?></a></td>
                            <td><?php echo e(Section::getHead($sec->head)); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="#document_form" class="btn btn-sm btn-info" data-toggle="modal" data-link="<?php echo e(asset('updateSection/'.$sec->id.'/'.$sec->division.'/'.$sec->head.'/')); ?>">
                                        <i class="fa fa-pencil"></i>  Update
                                    </a>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger" value="<?php echo e($sec->description); ?>" data-link="<?php echo e(asset('deleteSection/'.$sec->id)); ?>" id="deleteValue" data-toggle="modal" data-target="#confirmation" onclick="deleteSection($(this));"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($section->links()); ?>

        <?php else: ?>
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i> No documents found! </strong>
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


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>