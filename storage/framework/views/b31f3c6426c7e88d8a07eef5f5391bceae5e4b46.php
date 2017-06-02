<html>
<style type="text/css">
    .barcode {
        top: 930px;
        position: relative;
        left: -50%;
    }
    .route_no {
        font-size: 1em;
        text-align:center;
    }
</style>
<title><?php echo e(Session::get('route_no')); ?></title>
<body>
<div style="position: absolute; left: 50%;">
    <div class="barcode">
        <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,28) ?>
        <font class="route_no"><?php echo e(Session::get('route_no')); ?></font>
    </div>
</div>
</body>
</html>