<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Filter Document Types</h2>
        <div class="page-divider"></div>
            <div class="table-responsive">
                <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" id="url" value="<?php echo e(asset('document/filter')); ?>">
                <table class="table table-bordered table-type  table-hover table-striped">
                <thead>
                <tr>
                    <th>Document Type</th>
                    <th>description</th>
                    <th>amount</th>
                    <th>pr_no</th>
                    <th>po_no</th>
                    <th>purpose</th>
                    <th>source_fund</th>
                    <th>requested_by</th>
                    <th>route_to</th>
                    <th>route_from</th>
                    <th>supplier</th>
                    <th>event_date</th>
                    <th>event_location</th>
                    <th>event_participant</th>
                    <th>cdo_applicant</th>
                    <th>cdo_day</th>
                    <th>event_daterange</th>
                    <th>payee</th>
                    <th>item</th>
                    <th>dv_no</th>
                    <th>ors_no</th>
                    <th>fund_source_budget</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($documents as $doc): ?>
                    <tr>
                        <td><?php echo e($doc->doc_type); ?></td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('description'); ?>"
                            <?php if($doc->description==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('amount'); ?>"
                            <?php if($doc->amount==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('pr_no'); ?>"
                            <?php if($doc->pr_no==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('po_no'); ?>"
                            <?php if($doc->po_no==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('purpose'); ?>"
                            <?php if($doc->purpose==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('source_fund'); ?>"
                            <?php if($doc->source_fund==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('requested_by'); ?>"
                            <?php if($doc->requested_by==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('route_to'); ?>"
                            <?php if($doc->route_to==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('route_from'); ?>"
                            <?php if($doc->route_from==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('supplier'); ?>"
                            <?php if($doc->supplier==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('event_date'); ?>"
                            <?php if($doc->event_date==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('event_location'); ?>"
                            <?php if($doc->event_location==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('event_participant'); ?>"
                            <?php if($doc->event_participant==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('cdo_applicant'); ?>"
                            <?php if($doc->cdo_applicant==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('cdo_day'); ?>"
                            <?php if($doc->cdo_day==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('event_daterange'); ?>"
                            <?php if($doc->event_daterange==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('payee'); ?>"
                            <?php if($doc->payee==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('item'); ?>"
                            <?php if($doc->item==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('dv_no'); ?>"
                            <?php if($doc->dv_no==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('ors_no'); ?>"
                            <?php if($doc->ors_no==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                        <td><input data-type="<?php echo e($doc->doc_type); ?>" type="checkbox" class="update_filter flat-red" data-column="<?php echo e('fund_source_budget'); ?>"
                            <?php if($doc->fund_source_budget==1): ?>
                                <?php echo e('checked'); ?>

                                    <?php endif; ?>
                            >
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin'); ?>
    <script src="<?php echo e(asset('resources/plugin/iCheck/icheck.min.js')); ?>"></script>
    <script>
        var $table = $('.table-type');
        var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');

        $fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();

        $fixedColumn.find('tr').each(function (i, elem) {
            $(this).height($table.find('tr:eq(' + i + ')').height()-1.5);
        });

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });

        $('.update_filter').on('ifChecked',function(){
            var data = {
                'column':$(this).data('column'),
                'doc_type':$(this).data('type'),
                'value':1,
                '_token':$("#token").val()
            };

            var url = $('#url').val();
            $('.loading').show();
            setTimeout(function(){
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(data) {
                        console.log(data);
                        $('.loading').hide();
                    }
                });
            },1000);
        });
        $('.update_filter').on('ifUnchecked',function(){
            var data = {
                'column':$(this).data('column'),
                'doc_type':$(this).data('type'),
                'value':0,
                '_token':$("#token").val()
            };
            var url = $('#url').val();
            $('.loading').show();
            setTimeout(function(){
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(data) {
                        console.log(data);
                        $('.loading').hide();
                    }
                });
            },500);
        });

    </script>
    <script>
        var down=false;
        var scrollLeft=0;
        var x = 0;

        $('.table-responsive').mousedown(function(e) {
            down = true;
            scrollLeft = this.scrollLeft;
            x = e.clientX;
        }).mouseup(function() {
            down = false;
        }).mousemove(function(e) {
            if (down) {
                this.scrollLeft = scrollLeft + x - e.clientX;
            }
        }).mouseleave(function() {
            down = false;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('resources/plugin/iCheck/all.css')); ?>">
    <style>
        .table-responsive>.fixed-column {
            position: absolute;
            width: auto;
            border-right: 1px solid #ddd;
            background-color: #ddd;
            z-index:3000;
        }
        .table-type th {
            text-transform: uppercase;
        }
        .table tr td {
            text-align: center;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>