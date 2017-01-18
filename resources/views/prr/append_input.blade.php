<tr id="{{ $_GET['count'] }}">
    <td id="border-bottom" class="align-top"><button type="button" value="{{ $_GET['count'] }}" onclick="erase($(this))" class="btn-sm"><small><i class="glyphicon glyphicon-remove"></i></small></button></td>
    <td id="border-bottom" class="{{ 'qty'.$_GET['count'] }} align-top"><input type="text" name="qty[]" id="{{ 'qty'.$_GET['count'] }}" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" required><small id="{{ 'E_qty'.$_GET['count'] }}">required!</small></td>
    <td id="border-bottom" class="{{ 'issue'.$_GET['count'] }} align-top"><input type="text" name="issue[]" id="{{ 'issue'.$_GET['count'] }}" class="form-control" onkeyup="trapping()" required><small id="{{ 'E_issue'.$_GET['count'] }}">required!</small></td>
    <td id="border-bottom" class="{{ 'description'.$_GET['count'] }} align-top">
        <input type="text" name="description[]" id="{{ 'description'.$_GET['count'] }}" class="form-control" onkeyup="trapping()" required><small id="{{ 'E_description'.$_GET['count'] }}">required!</small>
        <br><strong><i>Specification(s)</i></strong>
        <textarea type="text" name="specification[]" id="{{ 'specification'.$_GET['count'] }}" class="ckeditor" onkeyup="trapping()" required></textarea><small id="{{ 'E_specification'.$_GET['count'] }}">required!</small>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bootstrap WYSIHTML5
                    <small>Simple and fast</small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                <form>
                    <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </form>
            </div>
        </div>
    </td>
    <td id="border-bottom"></td>
    <td id="border-bottom" class="{{ 'unit_cost'.$_GET['count'] }} align-top">
        <input type="text" name="unit_cost[]" id="{{ 'unit_cost'.$_GET['count'] }}" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" required><small id="{{ 'E_unit_cost'.$_GET['count'] }}">required!</small>
    </td>
    <td id="border-bottom" class="{{ 'estimated_cost'.$_GET['count'] }} align-top">
        <input type="hidden" name="estimated_cost[]" id="{{ 'estimated_cost'.$_GET['count'] }}" class="form-control">
        <strong style="color:green;" class="align-top">&#x20b1;</strong><strong style="color:green" id="{{ 'e_cost'.$_GET['count'] }}"></strong>
    </td>
</tr>
<script>
    $(function () {
        $(".textarea").wysihtml5();
    });
</script>
