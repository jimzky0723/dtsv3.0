<?php
use App\Section;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('resources/img/favicon.png') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>Document Tracking System</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('resources/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <link href="{{ asset('resources/plugin/datepicker/datepicker3.css') }}" rel="stylesheet">

    <title>
        @yield('title','Home')
    </title>

    <!--DATE RANGE-->
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <!--CHOOSEN SELECT -->
    <link href="{{ asset('resources/plugin/chosen/chosen.css') }}" rel="stylesheet">

    @yield('css')
    <style>
        body {
            background: url('{{ asset('resources/img/backdrop.png') }}'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .loading {
            opacity:0.4;
            background:#ccc url('{{ asset('resources/img/spin.gif')}}') no-repeat center;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
            display: none;
        }

    </style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('resources/assets/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->

<nav class="navbar navbar-default navbar-static-top">
    <div class="header" style="background-color:#2F4054;padding:10px;">
        <div class="col-md-4">
            <span class="title-info">Welcome,</span> <span class="title-desc">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Section:</span>
            <span class="title-desc">
                {{ Section::find(Auth::user()->section)->description }}
            </span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Date:</span> <span class="title-desc">{{ date('M d, Y') }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header" style="background-color:#00CC99;padding:15px;">
        <div class="container">
            <img src="{{ asset('resources/img/banner.png') }}" class="img-responsive" />
        </div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-code-o"></i>&nbsp; Document<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ asset('document/accept')  }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Accept Document</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ asset('document') }}"><i class="fa fa-file"></i>&nbsp;&nbsp; Create Document</a></li>
                        @if(Auth::user()->user_priv==1)
                        <li><a href="{{ asset('document/list') }}"><i class="fa fa-file"></i>&nbsp;&nbsp; All Documents</a></li>
                        @endif
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Print<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::to('document/logs') }}"><i class="fa fa-file-archive-o"></i>&nbsp;&nbsp; Print Logs</a></li>
                        @if(Auth::user()->user_priv==1)
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('report') }}"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp; Print Report</a></li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->user_priv==1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Settings<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ asset('/users')  }}"><i class="fa fa-users"></i>&nbsp;&nbsp; Users</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ asset('/designation') }}"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Designation</a></li>
                            <li><a href="{{ asset('/section') }}"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Section</a></li>
                            <li><a href="{{ asset('/division') }}"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Division</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ asset('document/filter') }}"><i class="fa fa-filter"></i>&nbsp;&nbsp; Filter Documents</a></li>
                            <li><a href="{{ asset('users/feedback') }}"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp; User Feedbacks <span class="badge">{{ \App\Feedback::where('is_read','0')->count() }}</span></a></li>
                        </ul>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ asset('/change/password')  }}"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
                    </ul>
                </li>

                    <li>
                        <a href="javascript:void(0)" data-link="{{ asset('feedback') }}" id="feedback" title="Write a feedback" data-trigger="focus" data-container="body"  data-placement="top" data-content="Help us improve our system by just sending feedback.">
                            <i class="fa fa-sign-out"></i> Feedback
                        </a>
                    </li>

                <li><a href="http://210.4.59.4/old/" target="_blank"><i class="fa fa-send"></i> Old Version</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#trackDoc" data-toggle="modal"><i class="fa fa-search"></i> Track Document</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="loading"></div>
    @yield('content')
    <div class="clearfix"></div>
</div> <!-- /container -->
<footer class="footer">
    <div class="container">
        <p class="pull-right">
            <?php
                use App\Http\Controllers\DocumentController as Doc;
                $online = Doc::countOnlineUsers();
            ?>
            @if($online<=1)
                {{ $online }} Online User | <i class="fa fa-user"></i>
            @else
                {{ $online }} Online Users | <i class="fa fa-users"></i>
            @endif
        </p>
        <p>Copyright &copy; 2016 DOH-RO7 All rights reserved</p>

    </div>
</footer>
@include('modal')

        <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/jquery-validate.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('resources/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
<script>var loadingState = '<center><img src="{{ asset('resources/img/spin.gif') }}" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="{{ asset('resources/plugin/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('resources/assets/js/script.js') }}?v=1"></script>
<script src="{{ asset('resources/assets/js/form-justification.js') }}"></script>
@yield('plugin')
<script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
<!-- DATE RANGE SELECT -->
<script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
<!-- NUMERAL JS -->
<script src="{{ asset('resources/assets/js/Numeral-js/src/numeral.js') }}"></script>
<!-- SELECT CHOOSEN -->
<script src="{{ asset('resources/plugin/chosen/chosen.jquery.js') }}"></script>
<!-- CKEDITOR -->
<script src="{{ asset('resources/plugin/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('resources/plugin/ckeditor/adapters/jquery.js') }}"></script>
<script>
    $('#reservation').daterangepicker();
    $('.chosen-select').chosen();

    function checkDocTye(){
        var doc = $('select[name="doc_type"]').val();
        if(doc.length == 0){
            $('.error').removeClass('hide');
        }
    }
</script>
<script>
    function searchDocument(){
        $('.loading').show();
        setTimeout(function(){
            return true;
        },2000);
    }

    $("a[href='#feedback']").on('click',function(){
        alert("Hello");
    });

    (function(){
        $('#feedback').popover('show');
        setTimeout(function(){
            $('#feedback').popover('hide');
        },2000);

        $('#feedback').click(function(){
            $('#feedback').popover('hide');
            $('#document_form').modal('show');
            $('.modal_content').html(loadingState);
            $('.modal-title').html($(this).html());
            var url = $(this).data('link');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#create').attr('action', url);
                    $('input').attr('autocomplete', 'off');
                }
            });
        });
    })();
</script>

@section('js')

@show
</body>
</html>
