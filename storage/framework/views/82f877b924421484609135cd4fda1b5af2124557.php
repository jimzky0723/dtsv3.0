<?php if($_GET['type'] == 'category'): ?>
    <div id="<?php echo e($_GET['category_count']); ?>" style="margin-top:2%;">
        <strong><i>Meal Type:</i></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="category[<?php echo e($_GET['row']); ?>][<?php echo e($_GET['category_count']); ?>]" id="category1" class="form-control" style="width: 50%;display: inline;" required>
            <option value="">Select Category</option>
            <option value="AM Snacks">AM Snacks</option>
            <option value="PM Snacks">PM Snacks</option>
            <option value="Buffet Lunch">Buffet Lunch</option>
        </select>
        <a href="#" data-value="<?php echo e($_GET['row'].$_GET['category_count']); ?>" type="button" onclick="remove_category($(this))" style="display:inline;color: red;"><i class="fa fa-remove"> Remove</i></a>
    </div>
<?php elseif($_GET['type'] == 'unit_cost'): ?>
    <div id="<?php echo e('parent_unit_cost'.$_GET['row'].$_GET['category_count']); ?>" style="margin-bottom: 9%;">
        <input type="text" name="unit_cost[<?php echo e($_GET['row']); ?>][<?php echo e($_GET['category_count']); ?>]" id="<?php echo e('unit_cost'.$_GET['row'].$_GET['category_count']); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" required>
    </div>
<?php elseif($_GET['type'] == 'estimated_cost'): ?>
    <div id="<?php echo e('parent_estimated_cost'.$_GET['row'].$_GET['category_count']); ?>" style="margin-bottom: 25%;">
        <input type="hidden" name="estimated_cost[<?php echo e($_GET['row']); ?>][<?php echo e($_GET['category_count']); ?>]" id="<?php echo e('estimated_cost'.$_GET['row'].$_GET['category_count']); ?>" class="form-control">
        <strong style="color:green;">&#x20b1;</strong><strong style="color:green" id="<?php echo e('e_cost'.$_GET['row'].$_GET['category_count']); ?>"></strong>
    </div>
<?php endif; ?>