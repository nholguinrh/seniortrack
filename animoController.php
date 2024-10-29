<?php
echo vistaHeader();
echo vistaNav();
echo vistaHeaderRow();

echo '<center>';

if(isset($_GET['accion']) AND $_GET['accion']="insertarAnimo")
	{
		$tabla="animo";
		$columna=array("usuario","fecha","animo","razon");
		$fecha=time();
		$valor=array($_SESSION['usuario_id'],$fecha,$_POST['mood'],$_POST['reason']);
		modeloInsertMysql($tabla,$columna,$valor);
		header("Location: ./?view=animo&id=".$_POST["hash"]."&step=4&hora0=".$_POST["hora0"]);
	}
$hoy=mktime(0,0,0,date("m"),date("d"),date("Y"));
$hoy=isset($_GET["fecha"]) ? $_GET["fecha"] : $hoy;
$animo=modeloSelectMysql("SELECT * FROM animo WHERE usuario='".$_SESSION['usuario_id']."' AND fecha > $hoy ORDER By id DESC");
echo vistaanimo($animo);
echo vistaFormIngresoAnimo();
echo '</center>';

echo vistaPie();




?>
