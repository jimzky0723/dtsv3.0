<?php
    use App\Tracking;
    use App\Http\Controllers\DocumentController as Doc;
    $route_no = Session::get('route_no');

    $document = Tracking::where('route_no',$route_no)->first();
?>
<html>
<title>Track Details</title>
<style>
    .upper, .info, .table {
        width: 100%;
    }
    .upper td, .info td, .table td {
        border:1px solid #000;
    }
    .upper td {
        padding:10px;
    }
    .info {
        margin-top: 90px;
    }
    .info td {
        padding: 5px;
        vertical-align: top;
    }
    .table th {
        border:1px solid #000;
        width: 25%;
    }
    .table td {
        padding: 5px;
    }
    .barcode {
        position:absolute;
        top: 130px;
        left: 30%;
    }
    .route_no {
        font-size:1.2em;
        margin-left:70px;
    }

</style>
<body>
<div class="barcode">
    <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,43) ?>
    <font class="route_no">{{ $route_no }}</font>
</div>

<table class="upper" cellpadding="0" cellspacing="0">
    <tr>
        <td width="20%"><center><img src="{{ asset('resources/img/doh.png') }}" width="100"></center></td>
        <td width="60%">
            <center>
                <strong>Republic of the Philippines</strong><br>
                Depart of Health - Regional Office 7<br>
                <h3 style="margin:0;">DOCUMENT TRACKING SYSTEM<br>(DTS)</h3>
            </center>
        </td>
        <td width="20%"><center><img src="{{ asset('resources/img/ro7.png') }}" width="100"></center></td>
    </tr>

</table>

<table class="info" width="100%" cellspacing="0">
    <tr>
        <td width="30%">
            <strong>PREPARED BY:</strong><br>
            Jimmy B. Lomocso Jr.
            <br><br>
        </td>
        <td>
            <strong>SECTION:</strong><br>
            Information and Communications Technology Unit
            <br><br>
        </td>
        <td width="30%">
            <strong>PREPARED DATE:</strong><br>
            November 17, 2016
            <br><br>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>DOCUMENT TYPE:</strong>
            Salary, Honoraria, Stipend, Remittances, CHT Mobilization
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>REMARKS / SUBJECT:</strong>
            Salary of Bohol Province
            <br>
            <br>
        </td>
    </tr>
</table>

<table cellspacing="0" class="table">
    <tr>
        <th>DATE</th>
        <th>FROM</th>
        <th>ACTION / REMARKS</th>
        <th>SIGNATURE</th>
    </tr>
    <tr>
        <td>11/17/2016<br>11:12 AM</td>
        <td>Jimmy Lomocso</td>
        <td>For Action</td>
        <td></td>
    </tr>
    @for($i=0; $i < 9; $i++)
    <tr>
        <td>&nbsp;<br><br></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    @endfor
</table>
{{--<table>--}}
    {{--<thead>--}}
        {{--<tr>--}}
            {{--<td width="120"><strong>Document Type</strong></td>--}}
            {{--<td width="10">:</td>--}}
            {{--<td>{{ Doc::docTypeName($document->doc_type) }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td><strong>Route Number</strong></td>--}}
            {{--<td>:</td>--}}
            {{--<td>{{ $route_no }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td><strong>Prepared By</strong></td>--}}
            {{--<td>:</td>--}}
            {{--<td>{{ $document->prepared_by }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td><strong>Section</strong></td>--}}
            {{--<td>:</td>--}}
            {{--<td>{{ $document->section }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td><strong>Date Prepared</strong></td>--}}
            {{--<td>:</td>--}}
            {{--<td>{{ date('M d, Y h:i:s A', strtotime($document->prepared_date)) }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td><strong>Additional Information</strong></td>--}}
            {{--<td>:</td>--}}
            {{--<td>{{ $document->description }}</td>--}}
        {{--</tr>--}}
    {{--</thead>--}}
{{--</table>--}}

</body>
</html>