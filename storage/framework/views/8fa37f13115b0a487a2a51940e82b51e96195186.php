<?php $__env->startSection('content'); ?>
    <div class="col-lg wrapper">
        <div class="alert alert-jim">
            <?php
            Use App\Division;
            Use App\Section;
            Use App\Designation;
            use App\prr_meal_category;
            ?>
            <link href="<?php echo e(asset('resources/assets/css/print.css')); ?>" rel="stylesheet">
            <style>
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
                .align-top{
                    vertical-align: top;
                }
                .align-bottom{
                    vertical-align: bottom;
                }
                .table1 td {
                    border:1px solid #000;
                }
                small{
                    color:red;
                }
                hr {
                    height: 10px;
                    border: 0;
                    box-shadow: 0 10px 10px -10px #8c8c8c inset;
                }
            </style>
            <form method="post" id="form" action="<?php echo e(asset('prr_meal_update')); ?>">
                <?php echo e(csrf_field()); ?>

                <span id="getDesignation" data-link="<?php echo e(asset('getDesignation')); ?>"></span>
                <span id="url" data-link="<?php echo e(asset('prr_meal_append')); ?>"></span>
                <span id="category_url" data-link="<?php echo e(asset('prr_meal_category')); ?>"></span>
                <span id="update_history" data-link="<?php echo e(asset('prr_meal_history')); ?>"></span>
                <span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
                <input type="hidden" name="doc_type" value="PRR_M">
                <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" name="prepared_by">
                <div class="modal-body">
                    <div class="content-wrapper">
                        <!-- Main content -->
                        <section class="invoice">
                            <div class="table-responsive">
                                <?php if(Session::get('updated')): ?>
                                    <div class="alert alert-info">
                                        <i class="fa fa-check"></i> Successfully Updated!
                                    </div>
                                    <?php Session::forget('updated'); ?>
                                <?php endif; ?>
                                <table class="letter-head" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td id="border" class="align"><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></td>
                                        <td width="90%" id="border">
                                            <div class="align" style="margin-top:-10px;">
                                                <center>
                                                    Republic of the Philippinesss<br>
                                                    <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br>
                                                    Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                                                    Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                                                    Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                                                </center>
                                            </div>
                                        </td>
                                        <td id="border" class="align"><img src="<?php echo e(asset('resources/img/ro7.png')); ?>" width="100"></td>
                                    </tr>
                                </table>
                                <table class="letter-head" cellpadding="0" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <td colspan="7" class="align">
                                            <strong>PURCHASE REQUEST</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Department:</td>
                                        <td colspan="2"><?php echo e(Division::find(Auth::user()->division)->description); ?></td>
                                        <td colspan="2">PR No:</td>
                                        <td>Date:<input class="form-control" name="prepared_date" value="<?php echo e(substr($tracking->prepared_date,5,2).'/'.substr($tracking->prepared_date,8,2).'/'.substr($tracking->prepared_date,0,4)); ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Section:</td>
                                        <td colspan="2"><?php echo e(Section::find(Auth::user()->section)->description); ?></td>
                                        <td colspan="2">SAI No.:</td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Unit:</td>
                                        <td colspan="2"></td>
                                        <td colspan="2">ALOBS No.:</td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td><b>Option</b></td>
                                        <td><b>Qty</b></td>
                                        <td><b>Unit of Issue</b></td>
                                        <td><b>Item Description</b></td>
                                        <td><b>Stock No.</b></td>
                                        <td><b>Unit Cost</b></td>
                                        <td><b>Estimated Cost</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="global_title align">
                                            <strong><i>Global Title</i></strong>
                                            <input type="text" name="global_title" id="global_title" class="form-control" value="<?php echo e($prr_meal_logs->global_title); ?>" onkeyup="trapping()" required>
                                            <small id="E_global_title">required!</small>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody class="input_fields_wrap">
                                    <?php
                                    $count = 0;
                                    $total = 0;
                                    foreach($meal as $row):
                                        $total += $row->estimated_cost;
                                        $count++;
                                    ?>
                                    <tr id="<?php echo e($count); ?>">
                                        <input type="hidden" value="<?php echo e($row->id); ?>" name="pr_id">
                                        <td id="border-bottom" class="align-top">
                                            <button type="button" value="<?php echo e($count); ?>" onclick="erase($(this))" class="btn-sm"><small><i class="glyphicon glyphicon-remove"></i></small></button>
                                        </td>
                                        <td id="border-bottom">

                                        </td>
                                        <td id="border-bottom">

                                        </td>
                                        <td id="border-bottom" class="align-top" width="40%">
                                            <div class="<?php echo e('description'.$count); ?>">
                                                <strong><i>Description</i></strong>
                                                <textarea class="textarea" placeholder="Place some text here" style="width: 100%;font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="specification[]" id="<?php echo e('specification'.$count); ?>" onkeyup="trapping()" required>
                                                    <?php echo e($row->specification); ?>

                                                </textarea>
                                                <small id="<?php echo e('E_description'.$count); ?>"></small>
                                            </div>
                                            <div class="<?php echo e('expected'.$count); ?>">
                                                <strong><i>Expected:</i></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="text" name="expected[]" id="<?php echo e('expected'.$count); ?>" value="<?php echo e($row->expected); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" style="width: 20%;display: inline" required>
                                                <strong><i>Guaranteed:</i></strong> &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="guaranteed[]" id="guaranteed1" value="<?php echo e($row->guaranteed); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" style="width: 20%;display: inline" required>
                                            </div>
                                            <div class="<?php echo e('date_time'.$count); ?>" style="margin-top: 2%">
                                                <strong><i>Date and Time:</i></strong> &nbsp;&nbsp;&nbsp;
                                                <input type="text" name="date_time[]" value="<?php echo e($row->date_time); ?>" id="<?php echo e('date_time'.$count); ?>" class="form-control" onkeyup="trapping(event,true)" style="width: 50%;display: inline" required>
                                                <small id="<?php echo e('E_date_time'.$count); ?>">required!</small>
                                            </div>
                                            <div id="<?php echo e('category_append'.$count); ?>">
                                                <div style="margin-top: 2%">
                                                    <?php
                                                    $category = prr_meal_category::where('category_row',$row->category_row)
                                                                ->where('prr_logs_key',$row->prr_logs_key)
                                                                ->where('status',1)
                                                                ->get();
                                                    $category_array = array('AM Snacks','PM Snacks','Buffet Lunch');
                                                    $column = 0;
                                                    foreach($category as $category_desc):
                                                        $column++;
                                                    ?>
                                                        <div style="margin-top:2%;">
                                                            <strong><i>Meal Type:</i></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <select name="category[<?php echo e($count); ?>][<?php echo e($column); ?>]" id="<?php echo e('category'.$count.$column); ?>" value="<?php echo e($category_desc->category_desc); ?>" class="form-control" style="width: 50%;display: inline;">
                                                                <option value="<?php echo e($category_desc->category_desc); ?>"><?php echo e($category_desc->category_desc); ?></option>
                                                                <?php
                                                                    for($i=0;$i<count($category_array);$i++){
                                                                        if($category_desc->category_desc != $category_array[$i])
                                                                            echo "<option value='".$category_array[$i]."'>".$category_array[$i]."</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <a href="#" data-value="<?php echo e($count.$column); ?>" type="button" onclick="remove_category($(this))" style="display:inline;color: red;"><i class="fa fa-remove"> Remove</i></a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <a onclick="add_category($(this));" data-value="<?php echo e($count); ?>" class="pull-left" href="#" style="margin-top: 2%;"><i class="fa fa-plus"></i> Add Category</a>
                                        </td>
                                        <td id="border-bottom"></td>
                                        <td id="border-bottom" class="<?php echo e('unit_cost'.$count); ?> align-bottom">
                                            <div id="<?php echo e('unit_cost_append'.$count); ?>" style="margin-bottom: 20%">
                                                <?php $column=0; ?>
                                                <?php foreach($category as $unit_cost): ?>
                                                    <?php $column++; ?>
                                                    <div id="<?php echo e('parent_unit_cost'.$count.$column); ?>" style="margin-bottom: 5%;">
                                                        <input type="text" name="unit_cost[<?php echo e($count); ?>][<?php echo e($column); ?>]" id="<?php echo e('unit_cost'.$count.$column); ?>" value="<?php echo e($unit_cost->unit_cost); ?>" class="form-control" onkeydown="trapping(event,true)" onkeyup="trapping(event,true)" required>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td id="border-bottom" class="<?php echo e('estimated_cost'.$count); ?> align-bottom">
                                            <div id="<?php echo e('estimated_cost_append'.$count); ?>" style="margin-bottom: 20%">
                                                <?php
                                                $column=0;
                                                foreach($category as $estimated_cost):
                                                    $column++;
                                                ?>
                                                    <div id="<?php echo e('parent_estimated_cost'.$count.$column); ?>" style="margin-bottom: 14%;">
                                                        <input type="hidden" name="estimated_cost[<?php echo e($count); ?>][<?php echo e($column); ?>]" id="<?php echo e('estimated_cost'.$count.$column); ?>" value="<?php echo e($estimated_cost->estimated_cost); ?>"  class="form-control">
                                                        <strong style="color:green;">&#x20b1;</strong><strong style="color:green" id="<?php echo e('e_cost'.$count.$column); ?>"><?php echo e(number_format($estimated_cost->estimated_cost,2)); ?> </strong>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"><a onclick="add();" href="#"><i class="fa fa-plus"></i> Add Item</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"><br><br> Prepared By:<br><br><u><?php echo e(Auth::user()->fname.' '.Auth::user()->mname.' '.Auth::user()->lname); ?></u><br><?php echo e(Designation::find(Auth::user()->designation)->description); ?></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                        <td id="border-top"></td>
                                    </tr>
                                    <tr>
                                        <td class="align" colspan="6"><b>TOTAL</b></td>
                                        <td class="align-top">
                                            <input type="hidden" id="count" value="<?php echo e($count); ?>">
                                            <input type="hidden" id="column" value="<?php echo e($column); ?>">
                                            <input type="hidden" name="amount" id="amount">
                                            <strong style="color: red;">&#x20b1;</strong><strong style="color:red" id="total"><?php echo e($total); ?></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row" style="padding: 2%">
                                <div class="btn-group btn-group-md pull-right">
                                    <button class="btn btn-info" type="button" style="margin-left: 5%" onclick="update_history()">
                                        <i class="fa fa-history"></i> Update History</button>
                                </div>
                                <div class="btn-group btn-group-md pull-right">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-edit"></i> Update </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <h3>Certification</h3>
                                    <address>This is to certify that dilligent efforts have been exerted to ensure that the price/s indicated above(in relation to the specifications) is/are within the prevailing market price/s.
                                    </address>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Requested By:</label>
                                        <div class="col-sm-10">
                                            <input id="section_head" class="form-control" value="<?php echo e(\App\Users::find($tracking->requested_by)->fname.' '.App\Users::find($tracking->requested_by)->mname.' '.App\Users::find($tracking->requested_by)->lname); ?>" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>Certification</h3>
                                    <address>This is to certify that dilligent efforts have been exerted to ensure that the price/s indicated above(in relation to the specifications) is/are within the prevailing market price/s.
                                    </address>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Requested By:</label>
                                        <div class="col-md-10">
                                            <input id="section_head" class="form-control" value="<?php echo e(\App\Users::find($tracking->requested_by)->fname.' '.App\Users::find($tracking->requested_by)->mname.' '.App\Users::find($tracking->requested_by)->lname); ?>" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Designation:</label>
                                        <div class="col-md-10">
                                            <input id="section_head" class="form-control" value="<?php echo e(App\Designation::find(\App\User::find($tracking->requested_by)->designation)->description); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="purpose" class="col-md-2 control-label">Purpose:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" id="purpose" name="purpose" readonly><?php echo e($tracking->purpose); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="chargeable" class="col-md-2 control-label">Chargeable to:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="charge_to" readonly><?php echo e($tracking->source_fund); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <center>
                                        <h4><strong class="lean">Recommending Approval:</strong></h4>
                                    </center>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <h4><strong class="lean">Approved:</strong></h4>
                                    </center>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label">Printed Name:</label>
                                    <div class="col-md-10">
                                        <input id="section_head" class="form-control" value="<?php echo e(\App\Users::find($tracking->division_head)->fname.' '.App\Users::find($tracking->division_head)->mname.' '.App\Users::find($tracking->division_head)->lname); ?>" readonly>
                                    </div>
                                    <label class="col-md-4 control-label">Designation:</label>
                                    <div class="col-md-10">
                                        <input id="division_head" class="form-control" value="<?php echo e(App\Designation::find(\App\User::find($tracking->division_head)->designation)->description); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <strong>JAIME S. BERNADAS, MD, MGM, CESO III</strong><br>
                                        Director IV
                                    </center>
                                </div>
                            </div>
                            <hr>
                            <!-- this row will not appear when printing -->
                        </section>
                    </div>
                </div>
            </form>
            <form action="<?php echo e(asset('prr_meal_pdf')); ?>" method="get" target="_blank">
                <div class="btn-group btn-group-lg;">
                    <button class="btn btn-primary" type="submit" >
                        <i class="fa fa-download"></i> Generate-PDF</button>
                </div>
            </form>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>
    </div>
    <?php /*SIDE BAR*/ ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        ///PLUGIN
        $(".textarea").wysihtml5();
        $('.datepickercalendar').datepicker({
            autoclose: true
        });
        ///END PLUGIN
        var count = $("#count").val();
        if($("#column").val() != 0)
            var category_count = $("#column").val();
        else
            var category_count = 1;

        var limit = 10;
        trapping(event,false);

        var ok = "";
        function add(){
            event.preventDefault();
            ok = "true";
            var wrapper= $(".input_fields_wrap"); //Fields wrapper

            trapping();

            if(count < limit) {
                count++;
                var url = $("#url").data('link')+"?count="+count+"&category_count=" + category_count;
                $.get(url, function (result) {
                    $(wrapper).append(result);
                });
            }
        }

        function trapping(event,flag){
            if(flag)
                key_code(event);
            var estimated_cost = 0;
            var total = 0;
            for(var i=1; i<=count; i++)
            {
                for (var j = 1; j <= category_count; j++) {
                    var noComma = parseFloat(numeral($("#unit_cost" + i + j).val()).format('0,0.00').replace(/,/g, ''));
                    $("#expected" + i).val() && $("#unit_cost" + i + j).val() !== '' ? (parseFloat($("#estimated_cost" + i + j).val($("#expected" + i).val() * noComma))) : $("#estimated_cost" + i + j).val('');
                    $("#expected" + i).val() && $("#unit_cost" + i + j).val() !== '' ? ($("#e_cost" + i + j).text(numeral($("#expected" + i).val() * noComma).format('0,0.00')), estimated_cost = $("#estimated_cost" + i + j).val()) : ($("#e_cost" + i + j).text(''), estimated_cost = 0);

                    if (estimated_cost){
                        total += parseFloat(estimated_cost);
                    }
                }
            }
            $("#total").text(numeral(total).format('0,0.00'));
            $("#amount").val(numeral(total).format('0,0.00'));
        }

        function key_code(e){
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                        // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }

        function get_designation(result,request){
            var url = $("#getDesignation").data('link')+'/'+result.val();
            $.get(url, function(designation){
                request == 'section' ?
                        result.val() ? $("#section_head").val(designation) : $("#section_head").val('') :
                        result.val() ? $("#division_head").val(designation) : $("#division_head").val('');
            });
        }

        function haha(){
            console.log(count);
        }

        function erase(result){
            limit++;
            $("#"+result.val()).remove();
            trapping();
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event;
            var isEscape = false;
            if ("key" in evt) {
                isEscape = (evt.key == "Escape" || evt.key == "Esc");
            } else {
                isEscape = (evt.keyCode == 27);
            }
            if (isEscape) {
                count = $("#count").val();
            }
        };

        function update_history(){
            $('#document_form').modal('show');
            $('.modal_content').html(loadingState);
            $('.modal-title').html('Update History Logs');
            var url = $("#update_history").data('link');
            setTimeout(function() {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('.modal_content').html(data);
                        $('#reservation').daterangepicker();
                        var datePicker = $('body').find('.datepicker');
                        //Date picker
                        $('.datepickercalendar').datepicker({
                            autoclose: true
                        });
                        $('input').attr('autocomplete', 'off');
                    }
                });
            },1000);
        }

        ///CATEGORY
        var unit_cost_margin_bottom = '4%';
        var estimated_cost_margin_bottom = '12%';
        function add_category(row)
        {
            event.preventDefault();
            var category_row = 1;
            if(row)
                category_row = row.data('value');

            category_count++;
            var category_url = $("#category_url").data('link')+"?type=category&row="+category_row+"&category_count=" + category_count;
            $.get(category_url,function(result){
                $("#category_append"+category_row).append(result);
            });
            category_url = $("#category_url").data('link')+"?type=unit_cost&row="+category_row+"&category_count=" + category_count;
            $.get(category_url,function(result){
                $("#unit_cost_append"+category_row).append(result);
                $("#parent_unit_cost"+category_row+category_count).css("margin-bottom", unit_cost_margin_bottom);
            });
            category_url = $("#category_url").data('link')+"?type=estimated_cost&row="+category_row+"&category_count=" + category_count;
            $.get(category_url,function(result){
                $("#estimated_cost_append"+category_row).append(result);
                $("#parent_estimated_cost"+category_row+category_count).css("margin-bottom", estimated_cost_margin_bottom);
            });
        }

        function remove_category($value)
        {
            event.preventDefault();
            $value.parent('div').remove();
            $("#parent_unit_cost"+$value.data('value')).remove();
            $("#parent_estimated_cost"+$value.data('value')).remove();
            console.log($value.data('value'));
            trapping();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>