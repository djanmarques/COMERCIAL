<?php
setlocale(LC_ALL, "pt_BR","pt_BR.utf8","portuguese");
$conn = oci_connect('focco_consulta', 'consulta3i08', '192.168.0.100/f3ipro');
$dt1='01/01/2018';
$dt1='01/01/2050';


Function Dj_Sql_Primeiro_Dia_N_Mes($dt1) {
  $Dj_Sql_Primeiro_Dia_N_Mes = 'select TO_CHAR(ADD_MONTHS(LAST_DAY(SYSDATE),  \''.$dt1.'\'  )+1,\'DD/MM/YYYY\') DATA1 FROM DUAL';
  Return $Dj_Sql_Primeiro_Dia_N_Mes;
     }
  Function   FunctionDj_Sql_Ultimo_Dia_N_Mes($dt1) {
       $Dj_Sql_Primeiro_Dia_N_Mes = 'select TO_CHAR(ADD_MONTHS(LAST_DAY(SYSDATE),  \''.$dt1.'\'  +1),\'DD/MM/YYYY\') DATA1 FROM DUAL';
       Return $Dj_Sql_Primeiro_Dia_N_Mes;
          }
          Function   FunctionDj_Sql_Hoje_Dia_N_Mes($dt1) {
               $Dj_Sql_Primeiro_Dia_N_Mes = 'select TO_CHAR((SYSDATE),\'DD/MM/YYYY\') DATA1 FROM DUAL';
               Return $Dj_Sql_Primeiro_Dia_N_Mes;
                  }

     $CX1 = '
     select
     dt_emis,sum(qtde) as QTDE,
     to_char(sum(vlr_liq_total),\'999g999g990d00\') as VLR,
     to_char(sum(PESO_LIQ),\'9999999D99\')as PESO,
     to_char (avg(f_quilo),\'9999999D99\') as FATOR
     from
     dj_mae_1
     where
     dt_emis
     between TO_DATE (\'01/09/2018\',\'DD/MM/RRRR\') AND TO_DATE (\'30/09/2018\',\'DD/MM/RRRR\')
     group by DT_EMIS order by 1 desc
     ';

     function CX_PERIODO($dt1,$dt2){
     /*  var_dump ($dt1."<>".$dt2);*/
       $CX = '
       select
       to_char(dt_emis,\'DD/MM/YYYY\') AS DT_EMIS,
       sum(qtde) as QTDE,
       to_char(sum(vlr_liq_total),\'999g999g990d00\',\'nls_numeric_characters=\'\',.\'\'\') as VLR,
       to_char(sum(PESO_LIQ),\'999g999g999D99\',\'nls_numeric_characters=\'\',.\'\'\')as PESO,
       to_char (avg(f_quilo),\'999g999g999D99\',\'nls_numeric_characters=\'\',.\'\'\') as FATOR
       from
       dj_mae_1
       where
       dt_emis
       between TO_DATE (\''.$dt1.'\',\'DD/MM/RRRR\') AND TO_DATE (\''.$dt2.'\',\'DD/MM/RRRR\')
       group by DT_EMIS order by 1 desc
       ';
       /*echo $CX;*/
       return $CX;
     }

function dj_select($stid){
  oci_execute($stid);
    echo "<div>";
        echo "<table class=\"blueTable sortable\" >\n";
        echo "<thead>";
    echo "<tr>\n";
        $CB=True;
        while (($row = oci_fetch_array ($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) { // Fetch NULLs
          if ($CB == True) {
            foreach ($row as $key => $value) {
             echo "  <th>".$key."</th>\n";
              $CB=False;
            }
      echo "</tr>\n";
      echo "</thead>";
  }
    foreach ($row as $item) {
       echo "  <td class=\"a\">".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
echo "</div>";
}


function dj_select_combobox($stid){
    oci_execute($stid);

    echo "<select  >\n";
    echo "  <option>TUDO</option>\n";
    while (($row = oci_fetch_array ($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) { // Fetch NULLs

        foreach ($row as $item) {
            echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
        }
    }
    echo "</select>\n";
}

function dj_select_combobox_EMP($stid){
    oci_execute($stid);

    echo "<select  name=\"sEMP\" >\n";
    echo "  <option>TUDO</option>\n";
    while (($row = oci_fetch_array ($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) { // Fetch NULLs

        foreach ($row as $item) {
            echo "  <option>".($item !== null ? htmlentities($item, ENT_QUOTES) : " ")."</option>\n";
        }
    }
    echo "</select>\n";
}


function dj_select_um_campo($stid){
  $DATA1='';
  //  echo $stid;
  $exe = oci_execute($stid,OCI_DEFAULT);
if(!$exe){
  echo $stid;
}else{
    //echo $stid;
  oci_execute($stid);
//$row1 = oci_fetch_array ($stid, OCI_ASSOC+OCI_RETURN_NULLS);
while (oci_fetch($stid)) {
   $DATA1= oci_result($stid, 'DATA1');
}
  return($DATA1);
}
}


function sql($sql){
	global $conexao;
	conecta();
echo $ssql;

	$result=ociparse($conexao,$sql); //executa uma fun��o sql no banco
	if (!$result){ //verifica se ocorreu algum erro de sql
		echo "<br><br>
			<center>
			<font face=helvetica size=2>
			N�o foi poss�vel localizar os dados.<br>
			</font>
			</center>";
		exit;
	}else{
		$exe = ociexecute($result,OCI_DEFAULT);
//		$exe = ociexecute($result,OCI_COMMIT_ON_SUCCESS,OCI_DEFAULT);
		if(!$exe){
			echo $sql;
		}else{
			OCICommit($conexao);
			return($result);
		}
	}
	desconecta();
}


$DJ_MENU = '
SELECT pagina FROM  DJ_PAGINAS_PHP WHERE REV >0 AND PROJETO=3 or id=0 ORDER BY ORDEM
';

function MAE($EMP,$dt1,$dt2){
$MAE='
SELECT DJ_MAE.EMPR EMPR,
       DJ_MAE.PEDIDO PEDIDO,
       DJ_MAE.COD_CLI COD_CLI,
       DJ_MAE.COD_RES COD_ITEM,
      TO_CHAR( DJ_MAE.PESO_LIQ_UNI ,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') PESO_LIQ_UNI,
       DJ_MAE.QTDE QTDE,
      TO_CHAR(DJ_MAE.VLR_LIQ,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ,
      TO_CHAR(DJ_MAE.F_QUILO,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') F_QUILO,
      TO_CHAR(DJ_MAE.VLR_LIQ_IPI,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_C_IPI,
      TO_CHAR(DJ_MAE.VLR_BRUTO_SICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_SICMS,
      TO_CHAR((CASE WHEN DJ_MAE.PESO_LIQ_UNI <=0 THEN DJ_MAE.VLR_BRUTO_SICMS ELSE DJ_MAE.VLR_BRUTO_SICMS/DJ_MAE.PESO_LIQ_UNI END),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') F_K_LIQ_S_ICMS,
       DJ_MAE.QTDE_SLDO QTDE_SLDO,
      TO_CHAR(DJ_MAE.VLR_LIQ_TOTAL,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_TOTAL,
       TO_CHAR(DJ_MAE.PESO_LIQ,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') PESO_LIQ,
        DJ_MAE.TP_FRETE,
       DJ_MAE.COD_REP COD_REP,
       TO_CHAR(DJ_MAE.COMIS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') COMIS,
       DJ_MAE.DT_EMIS DT_EMIS,
       DJ_MAE.DT_ENTREGA DT_ENTREGA,
       DJ_MAE.PP_PS PP_PS,
       DJ_MAE.COD_GRP_ITE COD_GRP_ITE,
       DJ_MAE.DESC_GRP DESC_GRP,
       DJ_MAE.COD_PG COD_PG,
       DJ_MAE.PRA_MEDIO PRA_MEDIO,
       TO_CHAR(DJ_MAE.VLR_ACRES_PDV,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ACRES_PDV,
       TO_CHAR(DJ_MAE.VLR_DESC_PDV,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_DESC_PDV,
       TO_CHAR(DJ_MAE.VLR_LIQ_IPI_SICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_IPI_SICMS,
       TO_CHAR(DJ_MAE.VLR_LIQ_SICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_SICMS,
       TO_CHAR(DJ_MAE.VLR_IPI_SICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_IPI_SICMS,
       TO_CHAR(DJ_MAE.VLR_SUB_ICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_SUB_ICMS,
       TO_CHAR(DJ_MAE.VLR_ICMS,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ICMS,
       TO_CHAR(DJ_MAE.VLR_ACRES_ICMS_ST,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ACRES_ICMS_ST,
       DJ_MAE.USUARIO USUARIO,
       DJ_MAE.TMASC_ITEM_ID TMASC_ITEM_ID,
       DJ_MAE.UF UF,
       DJ_MAE.CIDADE CIDADE,
       DJ_MAE.REGIAO REGIAO,
         TO_CHAR(DJ_MAE.VLR_IPI,\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_IPI,
       DJ_MAE.NUM_ITEM NUM_ITEM,
        DJ_MAE.OBS OBS
  FROM DJ_MAE DJ_MAE
where
DJ_MAE.EMPR IN  ('.$EMP.')
AND DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
';
//echo ($MAE);
return($MAE);
}

function MAE_TOTAL($EMP,$dt1,$dt2){
    $MAE='
SELECT COUNT(DJ_MAE.EMPR) EMPR,
       COUNT(DJ_MAE.PEDIDO) PEDIDO,
       COUNT(DJ_MAE.COD_CLI) COD_CLI,
       COUNT(DJ_MAE.COD_ITEM) COD_RES,
       TO_CHAR(SUM(DJ_MAE.PESO_LIQ_UNI),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') PESO_LIQ_UNI,
         SUM(DJ_MAE.QTDE) QTDE,
       TO_CHAR(SUM(DJ_MAE.VLR_LIQ),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ,
       TO_CHAR(AVG(DJ_MAE.F_QUILO),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') F_QUILO,
       TO_CHAR(SUM(DJ_MAE.VLR_LIQ_IPI),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_C_IPI,
       TO_CHAR(SUM(DJ_MAE.VLR_BRUTO_SICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_SICMS,
       TO_CHAR(AVG((CASE WHEN DJ_MAE.PESO_LIQ_UNI <=0 THEN DJ_MAE.VLR_BRUTO_SICMS ELSE DJ_MAE.VLR_BRUTO_SICMS/DJ_MAE.PESO_LIQ_UNI END)),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') F_K_LIQ_S_ICMS,
       SUM(DJ_MAE.QTDE_SLDO) QTDE_SLDO,
       TO_CHAR(SUM(DJ_MAE.VLR_LIQ_TOTAL),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_TOTAL,
       TO_CHAR(SUM(DJ_MAE.PESO_LIQ),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') PESO_LIQ,
       COUNT( DJ_MAE.TP_FRETE),
       COUNT(DJ_MAE.COD_REP) COD_REP,
       TO_CHAR(AVG(DJ_MAE.COMIS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') COMIS,
       COUNT(DJ_MAE.DT_EMIS) DT_EMIS,
       COUNT(DJ_MAE.DT_ENTREGA) DT_ENTREGA,
       COUNT(DJ_MAE.COD_GRP_ITE) COD_GRP_ITE,
       COUNT(DJ_MAE.DESC_GRP) DESC_GRP,
       COUNT(DJ_MAE.COD_PG) COD_PG,
       COUNT(DJ_MAE.PRA_MEDIO) PRA_MEDIO,
       TO_CHAR(SUM(DJ_MAE.VLR_ACRES_PDV),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ACRES_PDV,
       TO_CHAR(SUM(DJ_MAE.VLR_DESC_PDV),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_DESC_PDV,
       TO_CHAR(SUM(DJ_MAE.VLR_LIQ_IPI_SICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_IPI_SICMS,
       TO_CHAR(SUM(DJ_MAE.VLR_LIQ_SICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_LIQ_SICMS,
       TO_CHAR(SUM(DJ_MAE.VLR_IPI_SICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_IPI_SICMS,
       TO_CHAR(SUM(DJ_MAE.VLR_SUB_ICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_SUB_ICMS,
       TO_CHAR(SUM(DJ_MAE.VLR_ICMS),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ICMS,
       TO_CHAR(SUM(DJ_MAE.VLR_ACRES_ICMS_ST),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_ACRES_ICMS_ST,
       COUNT(DJ_MAE.USUARIO) USUARIO,
       COUNT(DJ_MAE.TMASC_ITEM_ID) TMASC_ITEM_ID,
       COUNT(DJ_MAE.UF) UF,
       COUNT(DJ_MAE.CIDADE) CIDADE,
       COUNT(DJ_MAE.NUM_ITEM) NUM_ITEM,
        TO_CHAR(SUM(DJ_MAE.VLR_IPI),\'999g999g990d00\',\'NLS_NUMERIC_CHARACTERS = \'\',.\'\' \') VLR_IPI,
       COUNT(DJ_MAE.OBS) OBS
  FROM DJ_MAE DJ_MAE
where
DJ_MAE.EMPR IN  ('.$EMP.')
AND DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
';
    return($MAE);
}

function MAE_DISTINCT_EMP($dt1, $dt2)
{
    $MAE = '
SELECT 
distinct(DJ_MAE.EMPR) EMPR
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \'' . $dt1 . '\' AND \'' . $dt2 . '\'
order by 1
';
    return ($MAE);
}
function MAE_DISTINCT_PEDIDO($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.PEDIDO||\'.\'||DJ_MAE.COD_CLI) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}
function MAE_DISTINCT_COD_ITEM($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.PEDIDO||\'.\'||DJ_MAE.COD_CLI) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_TP_FRETE($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.TP_FRETE) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_COD_GRP_ITE($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.COD_GRP_ITE) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_DESC_GRP($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.DESC_GRP) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_UF($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.UF) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_CIDADE($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.CIDADE) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_PP_PS($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.PP_PS) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}

function MAE_DISTINCT_REGIAO($dt1,$dt2){
    $MAE='
SELECT 
DISTINCT(DJ_MAE.REGIAO) PEDIDO
FROM
DJ_MAE DJ_MAE 
where
DJ_MAE.DT_EMIS between  \''.$dt1.'\' AND \''.$dt2.'\'
order by 1
';
    return($MAE);
}


?>
