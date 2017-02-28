<?php
$total = 0;
$item_no = 1;
use App\Users;
use App\Designation;
?>
        <!DOCTYPE html>
<html>
<title>Calendar Of Activities</title>
<style>
    .align{
        text-align: center;
    }
</style>
<head>
    <link href="<?php echo e(asset('resources/assets/css/print.css')); ?>" rel="stylesheet">
</head>
<body>
<div class="new-times-roman">
    <table class="letter-head" cellpadding="0" cellspacing="0">
        <tr>
            <td id="border" class="align"><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></td>
            <td width="90%" id="border">
                <div class="align small-text" style="margin-top:-10px;font-size: 10.5pt">
                    Republic of the Philippines<br>
                    <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br>
                    Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                    Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                    Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                </div>
            </td>
            <td id="border" class="align"><img src="<?php echo e(asset('resources/img/ro7.png')); ?>" width="100"></td>
        </tr>
    </table>
    <table class="letter-head" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/january.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/febuary.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/march.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/april.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/may.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/june.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/july.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/august.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/september.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/october.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/november.png'); ?>" width="400"></center></td>
        </tr>
        <tr>
            <td colspan="4"><center><img src="<?php echo e(public_path() . '/calendar_img/december.png'); ?>" width="400"></center></td>
        </tr>
    </table>
</div>
</body>
</html>