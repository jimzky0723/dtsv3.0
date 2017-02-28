<?php $__env->startSection('content'); ?>
<div class="col-md-12 wrapper">
    <div class="alert alert-jim">
        <?php if(session('status')): ?>
            <?php
                $status = session('status');
            ?>
            <?php if(isset($status['success'])): ?>
                <div class="alert alert-success">
                    <ul>
                        <?php foreach($status['success'] as $success): ?>
                            <li><?php echo $success; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(isset($status['errors'])): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach($status['errors'] as $error): ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <h2 class="page-header">Accept Documents</h2>
        <form class="form-accept form-submit" id="accept_form" method="post">
            <?php echo e(csrf_field()); ?>


            <?php /*<div class="form-inline form-group">*/ ?>
                <?php /*<input type="text" name="route_no" class="form-control route_no" disabled placeholder="Enter route #" autofocus>*/ ?>
                <?php /*<input type="text" name="remarks" class="form-control remarks" disabled placeholder="Enter remarks">*/ ?>
            <?php /*</div>*/ ?>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Accepted By</th>
                        <th>Date In</th>
                        <th>Route No / Barcode</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<10;$i++): ?>
                    <tr>
                        <td>
                            <?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?>

                        </td>
                        <td>
                            <?php echo e(date('M d, Y h:i:s A')); ?>

                        </td>
                        <td>
                            <input type="text" name="route_no[]" class="form-control route_no" disabled placeholder="Enter route #">
                        </td>
                        <td>
                            <input type="text" name="remarks[]" class="form-control remarks" disabled placeholder="Enter remarks">
                        </td>
                    </tr>
                <?php endfor; ?>
                <tr>
                    <td colspan="4" class="text-right">
                        <button type="submit" class="btn btn-success btn-lg btn-accept btn-submit"><i class="fa fa-plus"></i> Accept Document</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="clearfix"></div><br>
            <div class="alert alert-danger error-accept hide">Please input route number!</div>
        </form>
        <hr />
        <div class="accepted-list">

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        <?php echo 'var url="'. asset('document/accept').'";'; ?>
        var route_nos = [];
//        $('.form-accept').on('submit',function(e){
//            $('.loading').show();
//            var remarks = $('.remarks').val();
//            var route_no = $('.route_no').val();
//            var content = '<div class="alert alert-info"><span class="pull-right"><a href="#" class="remove-accept" data-route="'+route_no+'"><i class="fa fa-times"></i></a></span><strong>ACCEPTED!</strong><br>Route Number: <strong>'+route_no+'</strong><br>Remarks: '+remarks+'</div>';
//            if(route_no){
//                for(var i=0; i<route_nos.length; i++){
//                    if(route_nos[i]==route_no){
//                        $('.error-accept').removeClass('hide').fadeIn(500).html('Route # \''+route_no+'\' is already accepted!');
//                        $('.loading').hide();
//                        return false;
//                    }
//                }
//                //post data to database
//                var data = [$('.route_no').val, $('.remarks').val];
//                var form = $('#accept_form');
//                $.ajax({
//                    url: url,
//                    type: 'POST',
//                    data: form.serialize(),
//                    success: function(data) {
//                        $('.loading').hide();
//                        var jim = jQuery.parseJSON(data);
//                        if(jim.message=='SUCCESS'){
//                            route_nos.push(route_no);
//                            $('.accepted-list').append(content);
//                            $('.route_no').val(null).focus();
//                            $('.remarks').val(null);
//                            $('.error-accept').addClass('hide').fadeOut(500);
//
//                            //if remove accept
//                            $('.remove-accept').on('click',function(){
//                                $('.loading').show();
//                                var tmp = $(this).data('route');
//                                $(this).parent().parent().fadeOut(500);
//                                for(var i=0; i<route_nos.length; i++){
//                                    if(route_nos[i]==tmp){
//                                        route_nos.splice(i,1);
//                                        $.ajax({
//                                            url: 'destroy/'+tmp,
//                                            type: 'GET',
//                                            success: function(data) {
//                                                $('.loading').hide();
//                                            }
//                                        });
//                                    }
//                                }
//                            });
//
//                        }else{
//                            $('.error-accept').removeClass('hide').fadeIn(500).html('Route # \''+route_no+'\' not found in the database!');
//                            return false;
//                        }
//
//                    },
//                    error: function () {
//                        console.log('error');
//                    }
//                });
//
//
//            }else{
//                $('.error-accept').removeClass('hide').fadeIn(500).html('Please input route number!');
//                $('.route_no').focus();
//                $('.loading').hide();
//            }
//
//            e.preventDefault();
//            return false;
//        });

        $(window).load(function(){
            $('.route_no').prop("disabled", false); // Element(s) are now enabled.
            $('.remarks').prop("disabled", false); // Element(s) are now enabled.
        });
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>