<?php
if(isset($_GET["accion"]) AND $_GET["accion"]=="ingresar")
	{
		$timestamp = strtotime($_POST['fecha_hora']);
		$tabla="cita";
		$columna=array("usuario","fecha","cita");
		$valor=array($_SESSION["usuario_id"],$timestamp,$_POST["informacion"]);
		modeloInsertMysql($tabla,$columna,$valor);
		header("Location: ?view=cita");
		exit;
	}


echo vistaHeader();
echo vistaNav();

echo vistaHeaderRow();
echo '<center>';

$sql="SELECT * FROM cita WHERE usuario=".$_SESSION["usuario_id"];
$cita=modeloSelectMysql($sql);
echo vistaCita($cita);
echo vistaFormIngresoCita();

echo '</center>';
echo vistaPie();




?>
