<?php $__env->startSection('content'); ?>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h3 class="page-header">Created
            <small>Documents</small>
        </h3>
        <canvas id="createdDoc" width="400" height="200"></canvas>
        <h3 class="page-header">Accepted
            <small>Documents</small>
        </h3>
        <canvas id="acceptedDoc" width="400" height="200"></canvas>
    </div>
</div>
<?php echo $__env->make('sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php
    use Illuminate\Support\Facades\Session;
?>
<?php if(!Session::get('featuress')): ?>
<?php Session::put('features',true); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="notificationModal" style="margin-top: 30px;z-index: 99999 ">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h3 style="font-weight: bold" class="text-success">WHAT'S NEW</h3>

                <table class="table table-hover">
                    <tr><td><strong>Upgraded to Version 3.2</strong></td></tr>
                    <tr><td>Users can <strong>EDIT</strong> document.</td></tr>
                    <tr><td>Users can <strong>DELETE</strong> unrouted document.</td></tr>
                    <tr><td>Users can <strong>VIEW</strong> online users by clicking the <i class="fa fa-users"></i> icon or the link below.</td></tr>
                    <tr><td><strong>All Pending Documents</strong> is added under <em>Document Section.</em></td></tr>
                    <tr><td>Users can <strong>ACCEPT</strong> multiple document at once.</td></tr>
                    <tr><td>
                            In <strong>Print Logs Section</strong>, users may choose to which <strong>SECTION</strong> they will released their document.
                            <br />
                            <br />
                            <div class="alert alert-danger">
                                Please be reminded that <strong>UNACCEPTED DOCUMENT</strong> will be directed to <strong>INCIDENT REPORT</strong>  within 2-4 hours for monitoring purposes.
                            </div>
                        </td></tr>
                    <tr><td><strong>Purchase Request - Regular Purchase <em>(Supply)</em></strong> has been fixed.</td></tr>
                    <tr><td>Printing <strong>Section Logs</strong> has been fixed.</td></tr>
                    <tr><td><strong>Keyword field</strong> is added to Print Logs.</td></tr>
                    <tr><td>Minor bugs fixes.</td></tr>
                </table>
                <div class="alert alert-success text-center">
                    For further assistance, please contact <i class="fa fa-phone-square"></i> 418-4822 or visit ICT Unit.<br />
                    Thank you!
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('resources/plugin/Chart.js/Chart.min.js')); ?>"></script>
<script>
        $('.loading').show();
    $('#notificationModal').modal('show');
</script>
<script>
    <?php echo 'var url = "'.asset('home/chart').'";';?>
    var jim = [];
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            jim = jQuery.parseJSON(data);
            //chart created docs
            var ctx = document.getElementById("createdDoc");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: jim.data1.months,
                    datasets: [{
                        label: '# of Created Documents',
                        data: jim.data1.count,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            //end chart created docs
            //chart accepted docs
            var ctx = document.getElementById("acceptedDoc");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: jim.data2.months,
                    datasets: [{
                        label: '# of Accepted Documents',
                        data: jim.data2.count,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            //end chart accepted docs
            $('.loading').hide();
        }
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>