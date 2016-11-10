$(function(){

    var url = window.location.pathname;
    var host = window.location.hostname;
    var filename = window.location.href;
    //$('.sidebar-menu li a[href="'+filename+'"]').parent('li').addClass('active');
    $('.navbar-nav li a[href="'+filename+'"]').parent('li').addClass('active');
    //console.log('.navbar-nav li a[href="'+filename+'"]').addClass('active');

    var route_nos = [];       
    $('.form-accept').on('submit',function(e){
        var remarks = $('.remarks').val();
        var route_no = $('.route_no').val();
        var content = '<div class="alert alert-info"><span class="pull-right"><a href="#" class="remove-accept" data-route="'+route_no+'"><i class="fa fa-times"></i></a></span><strong>ACCEPTED!</strong><br>Route Number: <strong>'+route_no+'</strong><br>Remarks: '+remarks+'</div>';
        if(route_no){
            for(var i=0; i<route_nos.length; i++){
                if(route_nos[i]==route_no){
                    $('.error-accept').removeClass('hide').fadeIn(500).html('Route # \''+route_no+'\' is already accepted!');
                    return false;   
                }
            }
            route_nos.push(route_no);
            $('.accepted-list').append(content);
            $('.route_no').val(null).focus();
            $('.remarks').val(null);
            $('.error-accept').addClass('hide').fadeOut(500);
            $('.remove-accept').on('click',function(){                
                var tmp = $(this).data('route');
                $(this).parent().parent().fadeOut(500); 
                for(var i=0; i<route_nos.length; i++){
                    if(route_nos[i]==tmp){
                        route_nos.splice(i,1);   
                    }
                }
            });
        }else{
            $('.error-accept').removeClass('hide').fadeIn(500).html('Please input route number!');
            $('.route_no').focus();               
        }
        console.log(route_nos);
        e.preventDefault();
        return false;
    });
    
    $('.remove-accept').on('click',function(){
        $(this).parent().parent().fadeOut(500); 
        var tmp = $('.error-accept').data('route');
        console.log(tmp);
    });
    $(window).load(function(){
        $('.route_no').prop("disabled", false); // Element(s) are now enabled. 
        $('.remarks').prop("disabled", false); // Element(s) are now enabled. 
        $('.route_no').focus();   
    }); 
    
    $("a[href='#track']").on('click',function(){  
        $('.track_history').html('<center><img src="resources/img/spin.gif"></center>');
        setTimeout(function(){
            var content = '<table class="table table-hover table-striped"> \
                    <caption>Tracking History</caption>\
                    <thead>\
                        <tr>\
                            <th width="25%">Date / Time In</th>\
                            <th width="25%">Received By</th>\
                            <th width="25%">Duration</th>\
                            <th width="25%">Remarks</th>\
                        </tr>\
                    </thead>\
                    <tbody>\
                        <tr>\
                            <td>Oct 23, 2016<br>9:00 AM</td>\
                            <td>\
                                <span class="name">Rusel Tayong</span><br>\
                                ICTU<br>\
                                MSD\
                            </td>\
                            <td>1 hr 2 mins</td>\
                            <td></td>\
                        </tr>\
                        <tr>\
                            <td>Oct 24, 2016<br>10:00 AM</td>\
                            <td>\
                                <span class="name">Rhea Jean Abastillas</span><br>\
                                ICTU<br>\
                                MSD\
                            </td>\
                            <td>1day 1 hr 2 mins</td>\
                            <td></td>\
                        </tr>\
                    </tbody>\
                </table>';   
           
        $('.track_history').html(content);
        },1000);
        
    });
    
    //Get forms
    $('a[href="#document_form"]').on('click',function(){
        $('.modal-title').html($(this).html());
        var url = $(this).data('link');
        console.log(url);
        $.ajax({    
            url: url, 
            type: 'GET',
            success: function(data) { 
                $('.modal_content').html(data);
            }
        })
    });
    
    
});

function acceptNumber($this){
    $this.val($this.val().replace(/[^\d+(\.\.]/g, ''));
}
