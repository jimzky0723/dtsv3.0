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
    @yield('css')
    <style>
        body {
            background: url({{ asset('resources/img/backdrop.png') }}), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));   
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
            <span class="title-info">Welcome,</span> <span class="title-desc">{{ Auth::user()->fname }}</span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Section:</span> <span class="title-desc">Information Communication and Technology Unit</span>
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
        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('document/accept') }}"><i class="fa fa-plus"></i> Accept Document</a></li>            
            <li><a href="{{ URL::to('document') }}"><i class="fa fa-file"></i> Create Document</a></li>                       
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Print<span class="caret"></span></a>
              <ul class="dropdown-menu">                
                <li><a href="{{ URL::to('log') }}"><i class="fa fa-calendar"></i>&nbsp;&nbsp; Logs</a></li>
                <li><a href="{{ URL::to('pending') }}"><i class="fa fa-hourglass-half"></i>&nbsp;&nbsp; Pending</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
              <ul class="dropdown-menu">                
                <li><a href="{{ asset('/change/password')  }}"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
                <li class="divider"></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#"><i class="fa fa-search"></i> Track Document</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
        @yield('content')     
        <div class="clearfix"></div>
    </div> <!-- /container -->
    <footer class="footer">
      <div class="container">
        <p>Copyright &copy; 2016 DOH-RO7 All rights reserved</p>
      </div>
    </footer>
    @include('modal')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
    
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('resources/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
    @yield('plugin')
    <script src="{{ asset('resources/assets/js/script.js') }}"></script>
    @section('js')

    @show
  </body>
</html>
