<?php
if(isset($_GET["accion"]) AND $_GET["accion"]=='marcar')
	{
		$dosis=mktime(date('h',$_GET["hora"]),date('i',$_GET["hora"]),date('s',$_GET["hora"]),date("m"),date("d"),date("Y"));
		$tabla="medicina_hoy";
		$columna=array("id","fecha","tomada");
		$valor=array($_GET["medicina"],$dosis,"1");
		modeloInsertMysql($tabla,$columna,$valor);
		header("Location: ./?view=medicina");
		exit;
	}


echo vistaHeader();
echo vistaNav();
echo vistaHeaderRow();
echo '<center>';

$hoy=mktime(0,0,0,date("m"),date("d"),date("Y"));
$hoy=isset($_GET["fecha"]) ? $_GET["fecha"] : $hoy;

$sql="SELECT * FROM medicina WHERE usuario='".$_SESSION['usuario_id']."'";
$medicina=modeloSelectMysql($sql);
for($i=0;$i<count($medicina,0);$i++)
	{
		$dosis=mktime(date('h',$medicina[$i]["hora"]),date('i',$medicina[$i]["hora"]),date('s',$medicina[$i]["hora"]),date("m",$hoy),date("d",$hoy),date("Y",$hoy));
		$sql="SELECT tomada FROM medicina_hoy WHERE id=".$medicina[$i][id]." AND fecha=".$dosis;
		$tomada=modeloSelectMysql($sql);
		if($tomada[0]["tomada"]==1) $medicina[$i]["dado"]=1; 
		else $medicina[$i]["dado"]=0;
	}
echo vistaTablaMedicinas($medicina);

echo '</center>';
echo vistaPie();