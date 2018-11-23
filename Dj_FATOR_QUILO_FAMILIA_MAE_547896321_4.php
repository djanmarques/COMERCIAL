<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>RELATORIO DE PEDIDOS</title>
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
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

<script>
var soma = 0;

$('#tabelaArmotizacao > tbody tr .valorAmortizar').each(function(i){
  soma += parseFloat($(this).val());
});

$("#resultado").val(soma);

</script>

<BODY>
  <form method="post"   >
    <?php
    require '..\COMERCIAL\DJ_SQL_COMERCIAL.php';
    require '..\COMERCIAL\DJ_FORM_COMERCIAL.php';
    require '..\MENU\MENU.php';


    if (isset($_POST['btnK']))
    {
      $DT1 = $_POST['data1'];
      $DT2 = $_POST['data2'];
      $stid = oci_parse($conn,$DJ_MENU);
      menu($stid);
      Mostrar_Intervalo_Data_Definido($DT1,$DT2);
      Mostrar_Intervalo_Data($DT1,$DT2);


      $stid = oci_parse($conn,MAE($DT1,$DT2));
      dj_select($stid);
    //  $opcao = $_POST['select_ped'];
  //    $opcao = count($opcao);
    //  echo $opcao;
    } else {
      $stid = oci_parse($conn,FunctionDj_Sql_Hoje_Dia_N_Mes('-1'));
      $DT1 = dj_select_um_campo($stid);


      $stid = oci_parse($conn,FunctionDj_Sql_Hoje_Dia_N_Mes('-1'));
      $DT2 = dj_select_um_campo($stid);

      $stid = oci_parse($conn,$DJ_MENU);
      menu($stid);

      Mostrar_Intervalo_Data($DT1,$DT2);
      Mostrar_Intervalo_Data_Definido($DT1,$DT2);
    //  echo (MAE($DT1,$DT2));
      $stid = oci_parse($conn,MAE($DT1,$DT2));
      dj_select($stid);
    }


    /*
    //emp____________________________________________________________________________________________________________
    $stid1 = oci_parse($conn,$SQL_LISTA_EMP_PEDIDO_COM_SALDO);
    oci_execute($stid1);
    echo "<select name=\"select_emp[]\" multiple=\"multiple\" id=\"appearance-select_emp\">" ;
    While (($row = oci_fetch_array ($stid1, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    foreach ($row as $item) {
    echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
  }
}
echo "</select>" ;

//pedido_________________________________________________________________________________________________________
$stid2 = oci_parse($conn,$SQL_LISTA_PEDIDO_COM_SALDO_POR_EMP);
oci_execute($stid2);
echo "<select name=\"select_ped[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;

//produto_________________________________________________________________________________________________________
$stid3 = oci_parse($conn,$SQL_LISTA_PRODUTO);
oci_execute($stid3);
echo "<select name=\"select_prod[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;

//produto_________________________________________________________________________________________________________
$stid4 = oci_parse($conn,$SQL_LISTA_GRUPO);
oci_execute($stid4);
echo "<select name=\"select_grupo[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid4, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;
//produto_________________________________________________________________________________________________________
$stid5 = oci_parse($conn,$SQL_LISTA_CLI);
oci_execute($stid5);
echo "<select name=\"select_grupo[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid5, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;
//produto_________________________________________________________________________________________________________
$stid6 = oci_parse($conn,$SQL_LISTA_REP);
oci_execute($stid6);
echo "<select name=\"select_grupo[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid6, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;
//produto_________________________________________________________________________________________________________
$stid7 = oci_parse($conn,$SQL_LISTA_UF);
oci_execute($stid7);
echo "<select name=\"select_grupo[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid7, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;
//produto_________________________________________________________________________________________________________
$stid8 = oci_parse($conn,$SQL_LISTA_CIDADE);
oci_execute($stid8);
echo "<select name=\"select_grupo[]\" multiple=\"multiple\" id=\"appearance-select\">" ;
While (($row1 = oci_fetch_array ($stid8, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
foreach ($row1 as $item) {
echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
}
}
echo "</select>" ;



echo "<button type=\"submit\">FILTRAR</button>";
*/
?>

</form>
</BODY>
</html>
