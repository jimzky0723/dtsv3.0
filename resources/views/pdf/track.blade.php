<?php
    use App\Tracking;
    use App\Tracking_Details;
    use App\User as User;
    use App\Http\Controllers\DocumentController as Doc;
    $route_no = Session::get('route_no');
    $document = Tracking::where('route_no',$route_no)->first();
    $tracking = Tracking_Details::where('route_no',$route_no)
        ->orderBy('id','asc')
        ->get();
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
            <?php $user = User::find($document->prepared_by); ?>
            {{ $user->fname.' '.$user->lname }}
            <br><br>
        </td>
        <td>
            <strong>SECTION:</strong><br>
            {{ $document->section }}
            <br><br>
        </td>
        <td width="30%">
            <strong>PREPARED DATE:</strong><br>
            {{ date('M d, Y',strtotime($document->prepared_date)) }}
            <br><br>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>DOCUMENT TYPE:</strong>
            {{ Doc::getDocType($route_no) }}
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>REMARKS / SUBJECT:</strong>
            {{ $document->description }}
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
    @foreach($tracking as $doc)
        <tr>
            <td>{{ date('M d, Y', strtotime($doc->date_in)) }}<br>{{ date('h:i A', strtotime($doc->date_in)) }}</td>
            <td>
                <?php $user = User::find($doc->received_by); ?>
                {{ $user->fname.' '.$user->mname.' '.$user->lname }}
            </td>
            <td>{{ $doc->remarks }}</td>
            <td></td>
        </tr>
    @endforeach
    <?php $i = count($tracking); ?>
    @for($i; $i < 10; $i++)
    <tr>
        <td>&nbsp;<br><br></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    @endfor
</table>
</body>
</html>