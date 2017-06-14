

<tr>
    <td class="col-sm-3"><label>Section</label></td>
    <td class="col-sm-1">:</td>
    <td class="col-sm-8">
        <select name="section" id="section" class="form-control" required>
            <option value="" selected disabled>Select section</option>
            <?php foreach($section as $sec): ?>
                <option value="<?php echo e($sec->id); ?>"><?php echo e($sec->description); ?></option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
