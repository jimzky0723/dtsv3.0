<?php
    use App\Users;
    use App\Section;
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
    <h2 class="page-header">All Documents</h2>
    <form class="form-inline" method="POST" action="<?php echo e(asset('document/list')); ?>" onsubmit="return searchDocument();" id="searchForm">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Quick Search" name="keyword" value="<?php echo e(Session::get('keywordAll')); ?>" autofocus>
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="page-divider"></div>
    <?php if(count($documents)): ?>
    <div class="table-responsive">
        <table class="table table-list table-hover table-striped">
            <thead>
            <tr>
                <th width="8%"></th>
                <th width="20%">Route #</th>
                <th width="15%">Prepared Date</th>
                <th width="15%">Prepared By</th>
                <th width="20%">Document Type</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($documents as $doc): ?>
            <tr>
                <td><a href="#track" data-link="<?php echo e(asset('document/track/'.$doc->route_no)); ?>" data-route="<?php echo e($doc->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-success col-sm-12"><i class="fa fa-line-chart"></i> Track</a></td>
                <td><a class="title-info" data-route="<?php echo e($doc->route_no); ?>" data-link="<?php echo e(asset('/document/info/'.$doc->route_no.'/'.$doc->doc_type)); ?>" href="#document_info" data-toggle="modal"><?php echo e($doc->route_no); ?></a></td>
                <td><?php echo e(date('M d, Y',strtotime($doc->prepared_date))); ?><br><?php echo e(date('h:i:s A',strtotime($doc->prepared_date))); ?></td>
                <td>
                    <?php $user = Users::find($doc->prepared_by);?>
                    <?php echo e($user->fname); ?>

                    <?php echo e($user->lname); ?>

                    <br>
                    <em>(<?php echo e(Section::find($user->section)->description); ?>)</em>
                </td>
                <td><?php echo e(\App\Http\Controllers\DocumentController::docTypeName($doc->doc_type)); ?></td>
                <td>
                    <?php if($doc->doc_type == 'PRR_S'): ?>
                        <?php echo nl2br($doc->purpose); ?>

                    <?php else: ?>
                        <?php echo nl2br($doc->description); ?>

                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($documents->links()); ?>

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
<script>
    function searchDocument(){
        $('.loading').show();
        setTimeout(function(){
            return true;
        },2000);
    }

    function putAmount(amount){
        $('.amount').html(amount.val());
        if(amount.valueOf()==null){
            $('.amount').html('0');
        }
    }

    function preparedBy(input)
    {
        var name = input.val();
        $('input[name="fullNameC"]').val(name);
        $('input[name="fullNameD"]').val(name);
        $('input[name="fullNameE"]').val(name);
        $('input[name="fullNameH"]').val(name);
        console.log(name);
    }

    function position(input)
    {
        var name = input.val();
        $('input[name="positionC"]').val(name);
        $('input[name="positionD"]').val(name);
        console.log(name);
    }

    function pad (str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }

    function append()
    {
        var hr='';
        var mn = '';

        for(i=0;i<=12;i++){
            var tmp = pad(i,2);
            hr += '<option>'+tmp+'</option>';
        }
        for(i=0;i<60;i++){
            var tmp = pad(i,2);
            mn += '<option>'+tmp+'</option>';
        }
        $('#append').append('<tr>' +
            '<td><input type="date" name="date[]" class="form-control"></td>' +
            '<td colspan="2"><input type="text" name="visited[]" class="form-control"></td>' +
            '<td><select name="hourA[]" class="form-control append">' +
            hr +
            '</select>'+
            '<select name="minA[]" class="form-control">' +
            mn +
            '</select>'+
            '<select name="ampmA[]" class="form-control">' +
            '<option>AM</option>' +
            '<option>PM</option>' +
            '</select>'+
            '</td>' +
            '<td><select name="hourB[]" class="form-control append">' +
            hr +
            '</select>'+
            '<select name="minB[]" class="form-control">' +
            mn +
            '</select>'+
            '<select name="ampmB[]" class="form-control">' +
            '<option>AM</option>' +
            '<option>PM</option>' +
            '</select>'+
            '</td>' +
            '<td><input type="text" name="trans[]" class="form-control"></td>'+
            '<td><input type="text" name="transAllow[]" class="form-control"></td>'+
            '<td><input type="text" name="dailyAllow[]" class="form-control"></td>'+
            '<td><input type="text" name="perDiem[]" class="form-control"></td>'+
            '<td><input type="text" name="total[]" class="form-control"></td>'+
            '</tr>');
    }

    function subTotal(){
        var values = {};
        var total = $('input[name="total[]"]');
        var c = 0;
        total.each(function(){
            values[c] = total.val();
            c++;
        });
        console.log(values);
    }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>