<?php
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Section;
use App\Http\Controllers\DocumentController as Doc;
$documents = Session::get('logsDocument');

?>
<html>
<title>Print Logs</title>
<head>
    <link href="<?php echo e(asset('resources/assets/css/print.css')); ?>" rel="stylesheet">
    <style>
        html {
            font-size:0.9em;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
</head>
<body>
<table class="letter-head" cellpadding="0" cellspacing="0">
    <tr>
        <td width="20%"><center><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></center></td>
        <td width="60%">
            <center>
                <h4 style="margin:0;">DOCUMENT TRACKING SYSTEM LOGS</h4>
                (<?php echo e(Section::find(Auth::user()->section)->description); ?>)<br>
                <?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?><br>
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
        <th width="17%">Route # / Remarks</th>
        <th width="15%">Received Date</th>
        <th width="15%">Received From</th>
        <th width="15%">Released Date</th>
        <th width="15%">Released To</th>
        <th width="20%">Document Type</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($documents as $doc): ?>
        <tr>
            <td>
                <?php echo e($doc->route_no); ?>

                <br>
                <?php echo nl2br($doc->description); ?>

            </td>
            <td><?php echo e(date('M d, Y',strtotime($doc->date_in))); ?><br><?php echo e(date('h:i:s A',strtotime($doc->date_in))); ?></td>
            <td>
                <?php $user = Users::find($doc->delivered_by);?>
                <?php echo e($user->fname); ?>

                <?php echo e($user->lname); ?>

                <br>
                <em>(<?php echo e(Section::find($user->section)->description); ?>)</em>
            </td>
            <?php
            $out = Doc::deliveredDocument($doc->route_no,$doc->received_by,$doc->doc_type);
            ?>
            <?php if($out): ?>
                <td><?php echo e(date('M d, Y',strtotime($out->date_in))); ?><br><?php echo e(date('h:i:s A',strtotime($out->date_in))); ?></td>
                <td>
                    <?php $user = Users::find($out->received_by);?>
                    <?php echo e($user->fname); ?>

                    <?php echo e($user->lname); ?>

                    <br>
                    <em>(<?php echo e(Section::find($user->section)->description); ?>)</em>
                </td>
            <?php else: ?>
                <td></td>
                <td></td>
            <?php endif; ?>
            <td><?php echo e(\App\Http\Controllers\DocumentController::docTypeName($doc->doc_type)); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>