
<form action="" method="POST" id="create">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="id" value="<?php echo e($user->id); ?>" />
    <div class="modal-body">
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>First name</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="fname" value="<?php echo e($user->fname); ?>" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Middle name</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="mname" value="<?php echo e($user->mname); ?>" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Last name</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="lname" value="<?php echo e($user->lname); ?>" class="form-control" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Username</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <input type="text" name="username" value="<?php echo e($user->username); ?>" class="form-control" onblur="checkUser(this);" data-link="<?php echo e(asset('check/user')); ?>"required>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>User Type</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <select name="user_type" required id="user_type" class="form-control">
                        <option value="" disabled selected>Select user type</option>
                        <option <?php echo e(($user->user_priv == 1 ? 'selected' : '')); ?> value="1">Admin</option>
                        <option <?php echo e(($user->user_priv == 0 ? 'selected' : '')); ?> value="0">Standard</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Designation</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <select name="designation" required id="select_dis" class="chosen-select form-control" data-link="<?php echo e(asset('/get/section')); ?>">
                        <option value="" selected disabled>Select Designation</option>
                        <?php foreach($designation as $a): ?>
                            <option <?php echo e(($user->designation == $a->id ? 'selected' : '')); ?> value="<?php echo e($a->id); ?>"><?php echo e($a->description); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Division</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <select name="division" required id="select_div" onchange="loadDivision(this);" class="chosen-select form-control" data-link="<?php echo e(asset('/get/section')); ?>">
                        <option value="" selected disabled>Select division</option>
                        <?php foreach($division as $d): ?>
                            <option <?php echo e(($user->division == $d->id ? 'selected' : '')); ?> value="<?php echo e($d->id); ?>"><?php echo e($d->description); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Section</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <select name="section" required id="select_div" onchange="loadDivision(this);" class="chosen-select form-control" data-link="<?php echo e(asset('/get/section')); ?>">
                        <option value="" selected disabled>Select section</option>
                        <?php foreach($section as $d): ?>
                            <option <?php echo e(($user->section == $d->id ? 'selected' : '')); ?> value="<?php echo e($d->id); ?>"><?php echo e($d->description); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success user_add" id="update_user" name="update" value="update"><i class="fa fa-send"></i>Update</button>
    </div>
</form>
<script>
    $('.chosen-select').chosen();
</script>
