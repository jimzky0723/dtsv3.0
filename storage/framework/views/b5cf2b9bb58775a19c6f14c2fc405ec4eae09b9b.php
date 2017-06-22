<?php
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Section;
$documents = Session::get('deliveredDocuments');
?>
<html>
<title>Routing Slip logs</title>
<head>
    <link href="<?php echo e(asset('resources/assets/css/print.css')); ?>" rel="stylesheet">
</head>
<body>
<table class="letter-head" cellpadding="0" cellspacing="0">
    <tr>
        <td width="20%"><center><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></center></td>
        <td width="60%">
            <center>
                <strong>Republic of the Philippines</strong><br>
                Depart of Health - Regional Office 7<br>
                <h4 style="margin:0;">DOCUMENT TRACKING SYSTEM LOGS</h4>
                (Delivered Documents)<br>
                <?php echo e(date('M d, Y',strtotime(Session::get('startdate')))); ?> - <?php echo e(date('M d, Y',strtotime(Session::get('enddate')))); ?>

            </center>
        </td>
        <td width="20%"><center><img src="<?php echo e(asset('resources/img/ro7.png')); ?>" width="100"></center></td>
    </tr>

</table>
<br>
<center><h3><?php echo e(strtoupper(Session::get('doc_type'))); ?></h3></center>
<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th>Date Delivered</th>
        <th>Delivered To</th>
        <th>Route # / Remarks</th>
    </tr>
    </thead>
    <tbody>
   
    </tbody>
</table>
</body>
</html>