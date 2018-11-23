<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>CX_PERIODO</title>
  <style>
  table.sortable thead {
    background-color:#eee;
    color:#666666;
    font-weight: bold;
    cursor: default;
}
</style>
<script src="../objetos/sorttable.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
 <link rel="stylesheet" type="text/css" href="../objetos/djcss.css">
 <link rel="stylesheet" type="text/css" href="../css/pfSense.css">
 <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
 <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
  <script>
      !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
      arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
      d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
      insertBefore(d,q)}(window,document,'script','_gs');
      _gs('GSN-340356-F');
    </script>

    <script>
    $(function() {
      $( "#calendario" ).datepicker({dateFormat: 'dd/mm/yy'});
      $( "#calendario1" ).datepicker({dateFormat: 'dd/mm/yy'});
  });
    </script>
 </head>
 <BODY>
   <form method="POST" >
    <?php
    require '..\COMERCIAL\DJ_SQL_COMERCIAL.php';
    require '..\COMERCIAL\DJ_FORM_COMERCIAL.php';
    require '..\MENU\MENU.php';
  //  include "..\indpage\objetos\oracle.php";

/*MENU____________________________________________________________________*/

if (isset($_POST['btnK']))
{
  $DT1 = $_POST['data1'];
  $DT2 = $_POST['data2'];
  $stid = oci_parse($conn,$DJ_MENU);
  menu($stid);
  Mostrar_Intervalo_Data_Definido($DT1,$DT2);
  Mostrar_Intervalo_Data($DT1,$DT2);


$stid = oci_parse($conn,CX_PERIODO($DT1,$DT2));
  dj_select($stid);

} else {

$stid = oci_parse($conn,Dj_Sql_Primeiro_Dia_N_Mes('-1'));
$DT1 = dj_select_um_campo($stid);


$stid = oci_parse($conn,FunctionDj_Sql_Ultimo_Dia_N_Mes('-1'));
$DT2 = dj_select_um_campo($stid);




  $stid = oci_parse($conn,$DJ_MENU);
  menu($stid);


Mostrar_Intervalo_Data_Definido($DT1,$DT2);
  Mostrar_Intervalo_Data($DT1,$DT2);


  $stid = oci_parse($conn,CX_PERIODO($DT1,$DT2));
  echo (CX_PERIODO($DT1,$DT2));
  dj_select($stid);

}
?>
</form>
 </BODY>
</html>
