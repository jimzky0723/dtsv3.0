<tr id="<?php echo e($_GET['count']); ?>">
    <td id="border-bottom" class="align-top">
        <button type="button" value="<?php echo e($_GET['count']); ?>" onclick="erase($(this))" class="btn-sm"><small><i class="glyphicon glyphicon-remove"></i></small></button>
    </td>
    <td id="border-bottom">

    </td>
    <td id="border-bottom">

    </td>
    <td id="border-bottom" class="<?php echo e('description'.$_GET['count']); ?> align-top">
        <div class="<?php echo e('specification'.$_GET['count']); ?>">
            <strong><i>Description</i></strong>
            <textarea class="<?php echo e('textarea'.$_GET['count']); ?>" placeholder="Place some text here" style="width: 100%;" name="specification[]" id="<?php echo e('specification'.$_GET['count']); ?>" class="ckeditor" onkeyup="trapping()" required></textarea>
            <small id="<?php echo e('E_specification'.$_GET['count']); ?>"></small>
        </div>
        <div class="<?php echo e('expected'.$_GET['count']); ?>">
            <strong><i>Expected:</i></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="expected[]" id="<?php echo e('expected'.$_GET['count']); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" style="width: 20%;display: inline" required>
            <strong><i>Guaranteed:</i></strong> &nbsp;&nbsp;&nbsp;
            <input type="text" name="guaranteed[]" id="<?php echo e('guaranteed'.$_GET['count']); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" style="width: 20%;display: inline" required>
        </div>
        <div class="<?php echo e('date_time'.$_GET['count']); ?>" style="margin-top: 2%">
            <strong><i>Date and Time:</i></strong> &nbsp;&nbsp;&nbsp;
            <input type="text" name="date_time[]" id="<?php echo e('date_time'.$_GET['count']); ?>" class="form-control" onkeyup="trapping(event,true)" style="width: 70%;display: inline" required>
        </div>
        <div id="<?php echo e('category_append'.$_GET['count']); ?>">
            <div style="margin-top: 2%">
                <strong><i>Meal Type:</i></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="category[<?php echo e($_GET['count']); ?>][<?php echo e($_GET['category_count']); ?>]" id="<?php echo e('category'.$_GET['count'].$_GET['category_count']); ?>" class="form-control" style="width: 50%;display: inline;" required>
                    <option value="">Select Category</option>
                    <option value="AM Snacks">AM Snacks</option>
                    <option value="PM Snacks">PM Snacks</option>
                    <option value="Buffet Lunch">Buffet Lunch</option>
                </select>
            </div>
        </div>
        <a onclick="add_category($(this));" data-value="<?php echo e($_GET['count']); ?>" class="pull-left" href="#" style="margin-top: 2%;"><i class="fa fa-plus"></i> Add Category</a>
    </td>
    <td id="border-bottom"></td>
    <td id="border-bottom" class="<?php echo e('unit_cost'.$_GET['count']); ?> align-bottom">
        <div id="<?php echo e('unit_cost_append'.$_GET['count']); ?>" style="margin-bottom: 30%">
            <div style="margin-bottom: 10%;">
                <input type="text" name="unit_cost[<?php echo e($_GET['count']); ?>][<?php echo e($_GET['category_count']); ?>]" id="<?php echo e('unit_cost'.$_GET['count'].$_GET['category_count']); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" required>
            </div>
        </div>
    </td>
    <td id="border-bottom" class="<?php echo e('estimated_cost'.$_GET['count']); ?> align-bottom">
        <div id="<?php echo e('estimated_cost_append'.$_GET['count']); ?>" style="margin-bottom: 30%">
            <div style="margin-bottom: 25%;">
                <input type="hidden" name="estimated_cost[<?php echo e($_GET['count']); ?>][<?php echo e($_GET['category_count']); ?>]" id="<?php echo e('estimated_cost'.$_GET['count'].$_GET['category_count']); ?>" class="form-control">
                <strong style="color:green;" class="align-top">&#x20b1;</strong><strong style="color:green" id="<?php echo e('e_cost'.$_GET['count'].$_GET['category_count']); ?>"></strong>
            </div>
        </div>
    </td>
</tr>
<script>
    var textarea_count = '<?php echo $_GET['count']; ?>';
    $(".textarea"+textarea_count).wysihtml5();
</script>
