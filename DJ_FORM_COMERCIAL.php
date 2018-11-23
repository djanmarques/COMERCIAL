<?php

function Mostrar_Intervalo_Data($data1,$data2){

  echo "<div class=\"container\">";
  echo "<div class=\"titulo\">";
        echo "<table class=\"blueTable sortable\">\n";
        echo "<thead>";
        echo "<tr>\n";
  echo "</table>\n";
    echo "</div>";
    echo "<div class=\"op1\">";
      echo "<p>Data: <input type=\"text\" id=\"calendario\"  name=\"data1\" value=\"$data1\" /></p>";
    echo "</div>";
    echo "<div class=\"op2\">";
      echo "<p>Data: <input type=\"text\" id=\"calendario1\" name=\"data2\" value=\"$data2\" /></p>";
    echo "</div>";
    echo "<div class=\"op3\">";
    echo "<input type=\"image\"  alt=\"search\" style=\"vertical-align: middle;\">";
    echo "<input class=\"btn btn-primary btn-lg\" value=\"Pesquisa Cristalcopo\" aria-label=\"CONSULTAR\" name=\"btnK\" type=\"submit\" >";

    echo "</div>";
    echo "<div class=\"op4\">";
    echo "<input class=\"btn btn-primary btn-lg\" value=\"TESTE\" aria-label=\"TESTE\" name=\"bTESTE\" type=\"submit\" >";
    echo "</div>";
  echo "</div>";
    echo "<hr/>";

}
function Mostrar_Intervalo_Data_Definido($dt1,$dt2){
  echo "<div class=\"container\">";
  echo "<div class=\"titulo\">";
        echo "<table class=\"blueTable sortable\">\n";
        echo "<thead>";
        echo "<tr>\n";
  echo "</table>\n";
    echo "</div>";
    echo "<div class=\"op1\">";
      echo "<p>$dt1</p>";
    echo "</div>";
    echo "<div class=\"op2\">";
        echo "<p>$dt2</p>";
    echo "</div>";
    echo "<div class=\"op3\">";
    echo "<p>INTERVALO DE DATA</p>";
    echo "</div>";
    echo "<div class=\"op4\">";
      echo "IP: ".$_SERVER["REMOTE_ADDR"];
    echo "</div>";
  echo "</div>";
    echo "<hr/>";

}

function Mostrar_Filtro($dt1,$dt2){
    echo "<div class=\"container\">";
      echo "<div class=\"sel1\">";
        echo "<select>";
        echo "</select>";
      echo "</div>";
      echo "<div class=\"sel2\">";
        echo "<select></select>";
      echo "</div>";
      echo "<div class=\"sel3\">";
        echo "<select></select>";
      echo "</div>";
      echo "<div class=\"sel4\">";
        echo "<select></select>";
      echo "</div>";
    echo "</div>";
}

?>
