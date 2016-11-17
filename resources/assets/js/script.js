$(function(){
    $('input').attr('autocomplete', 'off');
    var url = window.location.pathname;
    var host = window.location.hostname;
    var filename = window.location.href;
    //$('.sidebar-menu li a[href="'+filename+'"]').parent('li').addClass('active');
    $('.navbar-nav li a[href="'+filename+'"]').parent('li').addClass('active');
    //console.log('.navbar-nav li a[href="'+filename+'"]').addClass('active');

    var route_nos = [];       
    $('.form-accept').on('submit',function(e){
        $('.loading').show();
        var remarks = $('.remarks').val();
        var route_no = $('.route_no').val();
        var content = '<div class="alert alert-info"><span class="pull-right"><a href="#" class="remove-accept" onclick="removeAccept($(this))" data-route="'+route_no+'"><i class="fa fa-times"></i></a></span><strong>ACCEPTED!</strong><br>Route Number: <strong>'+route_no+'</strong><br>Remarks: '+remarks+'</div>';
        if(route_no){
            for(var i=0; i<route_nos.length; i++){
                if(route_nos[i]==route_no){
                    $('.error-accept').removeClass('hide').fadeIn(500).html('Route # \''+route_no+'\' is already accepted!');
                    $('.loading').hide();
                    return false;
                }
            }
            //post data to database
            var data = [$('.route_no').val, $('.remarks').val];
            var form = $('#accept_form');
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function(data) {
                    $('.loading').hide();
                    var jim = jQuery.parseJSON(data);
                    if(jim.message=='SUCCESS'){
                        route_nos.push(route_no);
                        $('.accepted-list').append(content);
                        $('.route_no').val(null).focus();
                        $('.remarks').val(null);
                        $('.error-accept').addClass('hide').fadeOut(500);

                        //if remove accept
                        $('.remove-accept').on('click',function(){
                            $('.loading').show();
                            var tmp = $(this).data('route');
                            $(this).parent().parent().fadeOut(500);
                            for(var i=0; i<route_nos.length; i++){
                                if(route_nos[i]==tmp){
                                    route_nos.splice(i,1);
                                    $.ajax({
                                        url: 'destroy/'+tmp,
                                        type: 'GET',
                                        success: function(data) {
                                            $('.loading').hide();
                                        }
                                    });
                                }
                            }
                        });

                    }else{
                        $('.error-accept').removeClass('hide').fadeIn(500).html('Route # \''+route_no+'\' not found in the database!');
                        return false;
                    }

                },
                error: function () {
                    console.log('error');
                }
            });


        }else{
            $('.error-accept').removeClass('hide').fadeIn(500).html('Please input route number!');
            $('.route_no').focus();
            $('.loading').hide();
        }

        e.preventDefault();
        return false;
    });

    $(window).load(function(){
        $('.route_no').prop("disabled", false); // Element(s) are now enabled. 
        $('.remarks').prop("disabled", false); // Element(s) are now enabled. 
        $('.route_no').focus();   
    }); 

    //tracking history of the document
    $("a[href='#track']").on('click',function(){
        $('.track_history').html(loadingState);
        var route_no = $(this).data('route');
        $('#track_route_no').val('Loading...');
        setTimeout(function(){
            $('#track_route_no').val(route_no);
            $.ajax({
                url: 'document/track/'+route_no,
                type: 'GET',
                success: function(data) {
                    $('.track_history').html(data);
                }
            });
        },1000);
        
    });

    //document information
    $("a[href='#document_info']").on('click',function(){
        var route_no = $(this).data('route');
        $('.modal_content').html(loadingState);
        $('.modal-title').html('Route #: '+route_no);
        var url = $(this).data('link');
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#reservation').daterangepicker();
                    var datePicker = $('body').find('.datepicker');
                    $('input').attr('autocomplete', 'off');
                }
            });
        },1000);

    });
    //document information 2
    $("a[href='#document_info_pending']").on('click',function(){
        var route_no = $(this).data('route');
        $('.modal_content').html(loadingState);
        $('.modal-title').html('Route #: '+route_no);
        var url = $(this).data('link');
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#reservation').daterangepicker();
                    var datePicker = $('body').find('.datepicker');
                    $('input').attr('autocomplete', 'off');
                }
            });
        },1000);

    });
    //remove pending documents
    $("a[href='#remove_pending']").on('click',function(){
        var id = $(this).data('id');
        $('.loading').show();
        var url = $(this).data('link');
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.table-'+id).fadeOut();
                    $('.loading').hide();
                }
            });
        },500);

    });
    //Get forms
    $('a[href="#document_form"]').on('click',function(){
        $('.modal_content').html(loadingState);
        $('.modal-title').html($(this).html());
        var url = $(this).data('link');
        setTimeout(function() {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#reservation').daterangepicker();
                    var datePicker = $('body').find('.datepicker');
                    $('input').attr('autocomplete', 'off');
                }
            });
        },1000);
    });
});

function acceptNumber($this){
    $this.val($this.val().replace(/[^\d+(\.\.]/g, ''));
}

function trackDocument(){
    var route_no = $('#track_route_no2').val();
    var url = $('#trackForm').attr('action')+'/'+route_no;
    $('.track_history').html(loadingState);
    if(route_no.length > 0){
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.track_history').html(data);
                    $('.btn-print').removeClass('hide');
                }
            });
        },1000);
    }else{
        setTimeout(function(){
            $('.track_history').html('<div class="alert alert-danger"><i class="fa fa-times"></i> Please enter route number!</div>');
            $('.btn-print').addClass('hide');
        },1000);
    }
    return false;
}


