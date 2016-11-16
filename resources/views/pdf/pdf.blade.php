<html>
<style type="text/css">
    html {
        margin-top:955px;
        margin-left:280px;
    }
</style>
<title>{{ Session::get('route_no') }}</title>
<body>
<?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,33) ?>
{{ Session::get('route_no') }}
</body>
</html>