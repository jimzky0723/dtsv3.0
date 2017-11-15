<?php
    use App\Http\Controllers\SectionController as Sec;
    use App\Http\Controllers\AdminController as Admin;
?>


<?php $__env->startSection('content'); ?>

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
        <h2 class="page-header">Print Report</h2>
        <form class="form-inline" method="POST" action="<?php echo e(asset('document/report')); ?>" onsubmit="return searchDocument()">
            <?php echo e(csrf_field()); ?>

            <?php foreach($division as $div): ?>
            <?php
                $sections = Sec::getSections($div->id);
                $totalAccepted = 0;
                $totalCreated = 0;
            ?>
            <table class="table table-striped table-hover" style="border: 1px solid #d6e9c6">
                <thead>
                    <tr>
                        <th colspan="3" class="bg-success text-bold text-success text-uppercase" style="padding: 15px 10px;"><?php echo e($div->description); ?></th>
                    </tr>
                    <tr>
                        <th class="col-sm-6">Sections</th>
                        <th class="col-sm-3">Created Documents</th>
                        <th class="col-sm-3">Accepted Documents</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sections as $sect): ?>
                    <?php
                        $accepted = Admin::countAccepted($sect->id);
                        $created = Admin::countCreated($sect->id);

                        $totalAccepted += $accepted;
                        $totalCreated += $created;
                    ?>
                    <tr>
                        <td><?php echo e($sect->description); ?></td>
                        <td>
                            <?php if($created==0): ?>
                                Nothing
                            <?php elseif($created==1): ?>
                                1 Document
                            <?php else: ?>
                                <?php echo e($created); ?> Documents
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($accepted==0): ?>
                                Nothing
                            <?php elseif($accepted==1): ?>
                                1 Document
                            <?php else: ?>
                                <?php echo e($accepted); ?> Documents
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="bg-warning text-bold text-uppercase">TOTAL</td>
                        <td class="bg-warning text-bold text-uppercase"><?php echo e($totalCreated); ?></td>
                        <td class="bg-warning text-bold text-uppercase"><?php echo e($totalAccepted); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php endforeach; ?>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <div class="alert alert-danger error hide">
            <i class="fa fa-warning"></i> Please select Document Type!
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>