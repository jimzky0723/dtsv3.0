<html>
<<<<<<< HEAD
    <style type="text/css">
        html {
            margin-top:950px;
            margin-left:280px;
        }
    </style>
    <body>
        <?php echo DNS1D::getBarcodeHTML(Session::get("route_no"),"C39E",1,33) ?>
        {{ Session::get("route_no") }}
    </body>
=======
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
>>>>>>> 72359f95caa2b1641ff8cabbdfc4beb07028d000
</html>