<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MENU</title>
    <style>
        table.sortable thead {
            background-color:#eee;
            color:#666666;
            font-weight: bold;
            cursor: default;
        }
    </style>
    <script src="../objetos/sorttable.js"></script>
    <link rel="stylesheet" type="text/css" href="../objetos/djcss.css">
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script>
        !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
            arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
            d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
            insertBefore(d,q)}(window,document,'script','_gs');
        _gs('GSN-340356-F');
    </script>
</head>
<body>
<?php
require '..\COMERCIAL\DJ_SQL_COMERCIAL.php';
require '..\COMERCIAL\DJ_FORM_COMERCIAL.php';
require '..\MENU\MENU.php';
/*MENU____________________________________________________________________*/
$stid = oci_parse($conn,$DJ_MENU);
menu($stid);
echo "<hr/>";

?>
</body>
</html>
