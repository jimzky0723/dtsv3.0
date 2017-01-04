<!DOCTYPE html>
<html>
<title>Purchase Request</title>
<head>
    <link href="{{ asset('resources/assets/css/print.css') }}" rel="stylesheet">
    <style>
        html {
            margin: 30px;
            font-size:x-small;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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
            border:1px solid #000;
        }
        #border-bottom{
            border-collapse: collapse;
            border-bottom: none;
        }
        #border-left{
            border-collapse: collapse;
            border:1px solid #000;
        }
        .align{
            text-align: center;
        }
        .align-top{
            vertical-align : top;
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
    <table class="letter-head" cellpadding="0" cellspacing="0">
        <tr>
            <td id="border" class="align"><img src="{{ asset('resources/img/doh.png') }}" width="100"></td>
            <td width="90%" id="border">
                <div class="align small-text" style="margin-top:-10px;">
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
            <th id="border-left">Item No</th>
            <th id="border-right">Qty</th>
            <th id="border-right">Unit of Issue</th>
            <th width="35%" id="border-right">Item Description</th>
            <th id="border-right">Stock No.</th>
            <th>Estimated Unit Cost</th>
            <th id="border-right">Estimated Cost</th>
        </tr>
        <tbody>
        @foreach($item as $row)
            <tr>
                <td id="border-bottom" class="align-top">{{ $row->id }}</td>
                <td id="border-bottom" class="align-top">{{ $row->qty }}</td>
                <td id="border-bottom" class="align-top">{{ $row->issue }}</td>
                <td id="border-bottom" class="align-top">
                    <span class="small-text">
                        <?php
                        $count = 0;
                        echo "<strong>".$row->description."</strong>"."<br>";
                        if(strlen($row->specification) <= 35){
                            echo "<br>".$row->specification."<br>";
                        } else {
                            for($i=0;$i<=strlen($row->specification);$i++){
                                if($i % 35 == 0){
                                    echo "<br>".substr($row->specification,$count,35)."<br>";
                                    $count = $count + 35;
                                }
                            }
                        }
                        ?>
                    </span>
                </td>
                <td id="border-bottom"></td>
                <td id="border-bottom" class="align-top">{{ $row->unit_cost }}</td>
                <td id="border-bottom" class="align-top"><strong style="color: mediumvioletred;"><span style="font-family: DejaVu Sans;">&#x20b1; </span> {{ number_format($row->estimated_cost,2) }}</strong></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
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
            <td class="align-top"><strong style="color: red;"><span style="font-family: DejaVu Sans;">&#x20b1; </span> {{ number_format($tracking->amount,2) }}</strong></td>
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
        </tfoot>
    </table>
    <table class="table1" cellpadding="0" cellspacing="0">
        <tr>
            <td id="border-bottom" width="15%"></td>
            <td id="border-bottom" width="40%">&nbsp;Recommending Approval:</td>
            <td id="border-bottom" width="40%">&nbsp;Approved By:</td>
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
            <td id="border-top" class="align">&nbsp;Officer-In-Charge Assistant Regional Director</td>
            <td id="border-top" class="align">&nbsp;Director IV</td>
        </tr>
    </table>
    <br><br>
    <div style="position: absolute; left: 20%;">
        <div class="barcode">
            <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,28) ?>
            <font class="route_no">{{ Session::get('route_no') }}</font>
        </div>
    </div>
</body>
</html>