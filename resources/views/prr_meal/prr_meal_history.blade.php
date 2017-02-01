<?php
    use App\Users;
    use App\Designation;
    use App\prr_meal_specs;
    use App\prr_meal_category;
?>
<html>
<head>
    <link href="{{ asset('resources/assets/css/print.css') }}" rel="stylesheet">
    <style>
        html {
            font-size:x-small;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        body {
            margin-bottom: 50px;
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
        #border-bottom-t{
            border-collapse: collapse;
            border-top:1px solid red;
            border-bottom:1px solid red;
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
<br>
<?php
if(count($prr_meal_logs) >= 1){
    foreach($prr_meal_logs as $prr_meal_logs):
    $prr_meal_specs = prr_meal_specs::where("route_no",$prr_meal_logs->route_no)
            ->where("prr_logs_key",$prr_meal_logs->prr_logs_key)
            ->get();
?>
    <body>
    <div style="padding: 5%;margin-top: -5%">
        <span style="color: blue">Updated Date:</span> <span style="color:green">{{ date('M d, Y h:i:s A',strtotime($prr_meal_logs->updated_date)) }}</span>
        <table class="letter-head" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="7" class="align">
                    <strong>PURCHASE REQUEST LAST CREATED</strong>
                </td>
            </tr>
            <tr>
                <td id="border-left"><b>Item No</b></td>
                <td id="border-right"><b>Qty</b></td>
                <td id="border-right"><b>Unit of Issue</b></td>
                <td width="35%" id="border-right"><b>Item Description</b></td>
                <td id="border-right"><b>Stock No.</b></td>
                <td><b>Estimated Unit Cost</b></td>
                <td id="border-right"><b>Estimated Cost</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="global_title align">
                    <i>{{ $prr_meal_logs->global_title }}</i>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tbody>
            <?php
            $total = 0;
            $meal_no = 1;
            $tr_count = 1;
            foreach($prr_meal_specs as $row):
            $tr_count == 1 ? $border = 'border-bottom border-top' : $border = 'border-bottom';
            ?>
            <tr>
                <td id="{{ $border }}" class="align-top"><p>{{ $meal_no }}</p></td>
                <td id="{{ $border }}" class="align-top">{{ $row->qty }}</td>
                <td id="{{ $border }}" class="align-top">{{ $row->issue }}</td>
                <td id="{{ $border }}" class="align-top">
                            <span class="small-text">
                                <?php
                                $count = 0;
                                $meal_no++;
                                echo $row->specification;
                                ?>
                                <p>Expected&nbsp;&nbsp;&nbsp;: {{ $row->expected }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guaranteed: &nbsp;&nbsp;{{ $row->guaranteed }}</p>
                                <p>Date & Time&nbsp;&nbsp;&nbsp;: {{ $row->date_time }}</p>
                                <?php
                                $category = prr_meal_category::where('category_row',$row->category_row)
                                        ->where('prr_logs_key',$row->prr_logs_key)
                                        ->where('status',1)
                                        ->get();
                                foreach($category as $category_desc):
                                    echo '<p>Category&nbsp;&nbsp;&nbsp;: '.$category_desc->category_desc.'</p>';
                                endforeach;
                                ?>
                            </span>
                </td>
                <td id="{{ $border }}"></td>
                <td id="{{ $border }}" class="align-bottom">
                    <div style="margin-bottom: 5px">
                        @foreach($category as $unit_cost)
                            <div style="margin-bottom: 6px">
                                <span style="font-family: DejaVu Sans;">&#x20b1; {{ number_format($unit_cost->unit_cost,2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td id="{{ $border }}" class="align-bottom">
                    <div style="margin-bottom: 5px">
                        @foreach($category as $estimated_cost)
                            <div style="margin-bottom: 6px%">
                                <strong style="color: mediumvioletred;"><span style="font-family: DejaVu Sans;">&#x20b1; </span> {{ number_format($estimated_cost->estimated_cost,2) }}</strong>
                                <?php $total += $estimated_cost->estimated_cost ?>
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
            <?php
            $tr_count++;
            endforeach;
            ?>
            </tbody>
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
                <td class="align-top"><strong style="color: red;"><span style="font-family: DejaVu Sans;">&#x20b1; </span> {{ number_format($total,2) }}</strong></td>
            </tr>
        </table>
        <div style="position:absolute; left: 30%;margin-top:1%" class="align">
            <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,28) ?>
            <font class="route_no">{{ Session::get('route_no') }}</font>
        </div>
    </div>
    </body>
<hr>
<?php
    endforeach;
    } else {
        echo
        '<div>
            <h4 class="alert alert-success text-center"><strong>No update history</strong></h4>
        </div>';
    }
?>
</html>