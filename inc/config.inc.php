<?php

define("TITULO","Senior Track Colegio de la UPB 2024");


DEFINE ("USUARIOS_SESSION","SeniorTrack");

define("MYSQL_USER","usr_seniortrack");
define("MYSQL_PASSWORD","usr_seniortrack");
define("MYSQL_DB","usr_seniortrack");
define("MYSQL_HOST","localhost");
define("MYSQL_PORT","3306");


session_start("USUARIOS_SESSION");
$tituloMenu="Senior Track";
$textoPiedePagina="Nos preocupamos por ti, queremos saber que cada dia estas mejor";

$menuprincipal=array(
array("?view=animo","Estado de animo","nav-link"),
array("?view=cita","Citas","nav-link"),
array("?view=medicina","Medicinas","nav-link"),
array("?view=comida","Comidas","nav-link"),
array("?view=suministro","Suministros","nav-link"),
array("?view=cambio","Cambios","nav-link"),
array("?view=ajuste","Ajustes","nav-link"),
array("?view=logout","Salir","nav-link")
);
?>
