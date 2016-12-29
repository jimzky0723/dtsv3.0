<!DOCTYPE html>
<html>
<title>Purchase Request</title>
<head>
    <link href="{{ asset('resources/assets/css/print.css') }}" rel="stylesheet">
    <style>
        html {
            margin: 30px;
        }
        #border{
            border-collapse: collapse;
            border: none;
        }
        #border-top{
            border-collapse: collapse;
            border-top: none;
        }
        #border-right{
            border-collapse: collapse;
            border-right: none;
        }
        #border-bottom{
            border-collapse: collapse;
            border-bottom: none;
        }
        #border-left{
            border-collapse: collapse;
            border-left: none;
        }
        .align{
            text-align: center;
        }
        .table1 {
            width: 100%;
        }
        .table1 td {
            border:1px solid #000;
        }
    </style>
</head>
<body>
<small>
    <table class="letter-head" cellpadding="0" cellspacing="0">
        <tr>
            <td id="border" class="align"><img src="{{ asset('resources/img/doh.png') }}" width="100"></td>
            <td width="90%" id="border">
                <div class="align" style="margin-top:-10px;">
                    Republic of the Philippines<br>
                    <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br>
                    Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                    Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                    Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                </div>
            </td>
            <td id="border" class="align"><img src="{{ asset('resources/img/ro7.png') }}" width="100"></td>
        </tr>
    </table>
    <table class="letter-head" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="7" class="align">
                <strong>PURCHASE REQUEST</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">Department:</td>
            <td rowspan="3" colspan="2">{{ $division->description }}<br> {{ $section->description }}</td>
            <td colspan="2">PR No:</td>
            <td><small>Date:12/29/16</small></td>
        </tr>
        <tr>
            <td colspan="2">Section:</td>
            <td colspan="2">SAI No.:</td>
            <td>Date: </td>
        </tr>
        <tr>
            <td colspan="2">Unit:</td>
            <td colspan="2">ALOBS No.:</td>
            <td>Date: </td>
        </tr>
        <tr>
            <td><b>Item No</b></td>
            <td><b>Qty</b></td>
            <td><b>Unit of Issue</b></td>
            <td width="35%"><b>Item Description</b></td>
            <td><b>Stock No.</b></td>
            <td><b>Estimated Unit Cost</b></td>
            <td><b>Estimated Cost</b></td>
        </tr>
        @foreach($item as $row)
            <tr>
                <td id="border-bottom">{{ $row->id }}</td>
                <td id="border-bottom">{{ $row->qty }}</td>
                <td id="border-bottom">{{ $row->issue }}</td>
                <td id="border-bottom">
                    <?php
                    $count = 0;
                    if(strlen($row->description) <= 35){
                        echo "<br>".$row->description."<br>";
                    } else {
                        for($i=0;$i<=strlen($row->description);$i++){
                            if($i % 35 == 0){
                                echo "<br>".substr($row->description,$count,35)."<br>";
                                $count = $count + 35;
                            }
                        }
                    }
                    ?>
                </td>
                <td id="border-bottom"></td>
                <td id="border-bottom">{{ $row->unit_cost }}</td>
                <td id="border-bottom">{{ $row->cost }}</td>
            </tr>
        @endforeach
        <tr>
            <td id="border-top"></td>
            <td id="border-top"></td>
            <td id="border-top"></td>
            <td id="border-top" width="35%"><br><br> Prepared By:<br><br><u>{{ $user->fname.' '.$user->mname.' '.$user->lname }}</u><br>Programmer</th>
            <td id="border-top"></td>
            <td id="border-top"></td>
            <td id="border-top"></td>
        </tr>
        <tr>
            <td class="align" colspan="6"><b>TOTAL</b></td>
            <td class="align">1111</td>
        </tr>
        <tr>
            <td colspan="7" class="align"><b style="margin-right:5%">CERTIFICATION</b></td>
        </tr>
        <tr>
            <td id="border-bottom" colspan="7">This is to certify that diligent efforts have been exerted to ensure that the price/s indicated above (in relation to the<br>specification) is/are within the prevailing market price/s.
                <br><br>
                Requested By:
            </td>
        </tr>
        <tr>
            <td id="border-top" colspan="7" class="align"><u><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Garizaldy Epistola&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br>Computer Maintenance V</u></td>
        </tr>
        <tr>
            <td colspan="7" id="border-bottom">Purpose: <b>hahaha</b></td>
        </tr>
        <tr>
            <td colspan="7" id="border-top">Chargeable to: <b>hahaha</b></td>
        </tr>
    </table>
    <table class="table1" cellpadding="0" cellspacing="0">
        <tr>
            <td id="border-bottom" width="15%"></td>
            <td id="border-bottom" width="40%">Recommending Approval:</td>
            <td id="border-bottom" width="40%">Approved By:</td>
        </tr>
        <tr>
            <td id="border-top border-bottom">&nbsp;Signature:</td>
            <td id="border-top border-bottom"></td>
            <td id="border-top border-bottom"></td>
        </tr>
        <tr>
            <td id="border-top border-bottom">&nbsp;Printed Name:</td>
            <td id="border-top border-bottom" class="align"><u><b>Sophia M. Mancao</b></u></td>
            <td id="border-top border-bottom" class="align"><u><b>Jaime S. Bernadas, MD, MGM, CESO III</b></u></td>
        </tr>
        <tr>
            <td id="border-top" >&nbsp;Designation:</td>
            <td id="border-top" class="align">Officer-In-Charge Assistant Regional Director</td>
            <td id="border-top" class="align">Director IV</td>
        </tr>
    </table>
    <br><br>
    <div style="position: absolute; left: 20%;">
        <div class="barcode">
            <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,28) ?>
            <font class="route_no">{{ Session::get('route_no') }}</font>
        </div>
    </div>
</small>
</body>
</html>