<?php
$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER,MYSQL_PASSWORD,MYSQL_DB,MYSQL_PORT);

$tabla=array("ajuste",
"animo",
"cambio",
"cita",
"comida",
"suministro");

function modeloSelectMysql($sql)	
			{
	           global $mysqli;
	           $salida=array();
	           $result = $mysqli->query($sql);
	           for($i=0;$i<$result->num_rows;$i++)
	           $salida[]=$result->fetch_array(MYSQLI_BOTH);
	           return($salida);	
            }
function modeloSelectTabla($tabla,$min,$max)
    {
        $sql="SELECT * FROM ".$tabla;
        $sql.=(isset($min) && iiset($max))? " LIMIT $min,$max": ";";
        $salida=modeloSelectMysql($sql);
        return($salida);
    }
function modeloDeleteRowTable($id,$tabla)
    {
        global $mysqli;
        $sql="DELETE FROM $tabla WHERE id=$id LIMIT 1";
        $result = $mysqli->query($sql);
        return($salida);
    }        
function modeloInsertMysql($tabla,$columna,$valor)
    {
        global $mysqli;
        $campos=count($columna,0);
        $comas=$campos-1;
        for($i=0;$i<count($valor,0);$i++) $valor[$i]=str_replace("'"," ",$valor[$i]); 
            $sql="INSERT INTO `$tabla` (";
        for($i=0;$i<$campos;$i++)
        {
         $sql.="`".$columna[$i]."`";
         if($i<$comas) $sql.=",";
         }
         $sql.=") VALUES (";
         for($i=0;$i<$campos;$i++)
         {
             $sql.="'".$valor[$i]."'";
             if($i<$comas) $sql.=",";
         }  
         $sql.=");"; 
         $mysqli->query($sql);
         return($mysqli->insert_id);  
              
        }    
function modeloUpdateMysql($tabla,$columna,$valor,$condicion,$vcondicion)
        {
        global $mysqli;
        $sql="UPDATE $tabla SET ";
        for($i=0;$i<count($columna);$i++){
            if($i>0) $sql.=',';
            $sql.="`".$columna[$i]."` = '".$valor[$i]."'";
        }
        $sql.=" WHERE `".$condicion."` = '".$vcondicion."'";    
        $mysqli->query($sql);
        }
?>
