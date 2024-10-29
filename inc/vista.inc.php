<?php
include('./inc/config.inc.php');
include('./inc/modelo.inc.php');
include('./inc/controlador.inc.php');
function xlsBOF()
        {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        return;
        }
function xlsEOF()
        {
        echo pack("ss", 0x0A, 0x00);
        return;
        }
function xlsWriteNumber($Row, $Col, $Value){
                        echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
                        echo pack("d", $Value);
                        return;
                        }
function xlsWriteLabel($Row, $Col, $Value)
        {
        $L = strlen($Value);
        echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
        echo $Value;
        return;
        }
function vistaheaderexcel($file)
        {
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=".$file.".xls" );
        header ("Content-Description: PHP/INTERBASE Generated Data" );
        }
function vistaExcelTabla($titulo,$data)
        {
        xlsBOF();
        $fila=0;
        for($i=0;$i<count($titulo);$i++) xlsWriteLabel(0, $i,$titulo[$i]);$fila++;
        for($i=0;$i<count($data,0);$i++)
                {
                for($j=0;$j<count($data[$i],0);$j++)
                        {
                        xlsWriteLabel($fila,$j,$data[$i][$j]);
                        }
                $fila++;
                }
        xlsEOF();
        return;
        }
function vistaHeader($mas_css=NULL)
	{
	$salida='
	<!DOCTYPE html>
	<html>
  	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<title>'.TITULO.'</title>
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="stylesheet" href="./css/bootstrap-icons.min.css">
        <link rel="stylesheet" href="./css/prism-okaidia.css">
        <link rel="stylesheet" href="./css/custom.min.css">
      '.$mas_css.'
  	</head>
  	<body>
		';
	return($salida);
	}
function vistaMostrarfecha($fecha)
  {
    $salida=date("Y-m-d",$fecha);
    return($salida);
  }  
function vistaNav()
          {
            global $menuprincipal;
            global $tituloMenu;
          $salida='<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top"> 
            <div class="container">
          <a class="navbar-brand" href="./">'.$tituloMenu.'</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
           aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto">
                  ';
                for($i=0;$i<count($menuprincipal,0);$i++)
                    {
                        $salida.='<li class="nav-item">
                    <a class="'.$menuprincipal[$i][2].'" href="'.$menuprincipal[$i][0].'">'.$menuprincipal[$i][1].'</a>
                  </li>';
                    }  
                  $salida.='

                </ul>
              </div>
          </div>
          </nav>
          <div class="container">
            ';
          $salida='<div class="navbar navbar-expand-lg fixed-top bg-primary" data-bs-theme="dark">
      <div class="container">
        <a href="./" class="navbar-brand">Senior Track</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            <li class="nav-item dropdown" data-bs-theme="light">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" id="themes">Funciones</a>
              <div class="dropdown-menu" aria-labelledby="themes">
                <a class="dropdown-item" href="?view=animo">Estado de animo</a>
                <a class="dropdown-item" href="?view=cita">Citas</a>
                <a class="dropdown-item" href="?view=medicina">Medicinas</a>
                <a class="dropdown-item" href="?view=comida">Comidas</a>
                <a class="dropdown-item" href="?view=suministro">Suministros</a>
                <a class="dropdown-item" href="?view=cambio">Cambios</a>
                <a class="dropdown-item" href="?view=ajuste">Ajustes</a>
                <a class="dropdown-item" href="?view=logout">Salir</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>';
          return($salida);
          }
function vistaPie($otroJS="") 
        {
        global $textoPiedePagina;
        $salida='
        </div>  
            <footer class="py-5 bg-primary">
                <div class="container">
              <p class="m-0 text-center text-white">';
        if (isset($_SESSION['usuario_login']) && !empty($_SESSION['usuario_login'])) 
            {
            $salida.="Bienvenido <b>".$_SESSION['usuario_nombre']."</b> nos alegra saber que te conectas, porque nos importa que cada dia estes mejor";
            }     
              $salida.='</p>
              
                </div>
            </footer><p><center><img src="./images/seniortrack-logo.png" width="150"></center></p>


                <script src="./jss/bootstrap.bundle.min.js"></script> 
                <script src="./jss/prism.js" data-manual></script>
    <!--        <script src="./jss/custom.js"></script>                      -->
        '.$otroJS.'
            </body>
        </html> ';  
        return($salida);
        }
function vistaHeaderRow()
        {
        $salida='<div class="row my-4">
        <div class="col-lg-12">  
          </div>
             </div>
            <div class="row my-4">
                <div class="col-lg-12">
                  
                </div>
              </div>
              </div>';
        return($salida);
        }
function vistaanimo($animo=NULL)
    {
        $salida='<div class="row my-4">
        <div class="col-lg-12">  
          </div>
             </div>
            <div class="row my-4">
                <div class="col-lg-12">';
                for($i=0;$i<count($animo,0);$i++)
                    {
                    $hora_registro=date('h:i:s j-m-Y',$animo[$i][2]);
                    $salida.='    
                    <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                      <div class="card-header">'.$hora_registro.'</div>
                      <div class="card-body">
                        <h4 class="card-title">'.$animo[$i][3].'</h4>
                        <p class="card-text">'.$animo[$i][4].'</p>
                      </div>
                    </div>';
                    }
                $salida.='</div>
              </div>
              </div>';
        return($salida);

    }
function vistaFormLogin()
    {
        $salida='
        <img src="./images/seniortrack-logo.png" width="350">
        <form method="post" action="?view=animo" enctype="multipart/form-data">
   <fieldset>
     <p><label for="usuario">Usuario:</label><br />
    <input type="text" name="user" id="username_1" tabindex="1"/></p>
       <p><label for="password">Password:</label><br />
    <input type="password" name="pass" id="password_1" tabindex="2" class="field"/></p>
       <p><input type="submit" name="cmdweblogin" class="button" value="Ingresar"  /></p>
      </fieldset>
    </form>';
        return($salida);
    }
function vistaFormIngresoAnimo()
    {
    $salida='    
    <form method="post" action="?view=animo&usuario=1&accion=insertarAnimo" enctype="multipart/form-data">
    <input type="radio" id="happy" name="mood" value="Feliz" required>
    <label for="happy">
        <img src="./images/feliz.png" alt="Feliz" width="50">
    </label>

    <input type="radio" id="sad" name="mood" value="Triste">
    <label for="sad">
        <img src="./images/triste.png" alt="Triste" width="50">
    </label>

    <input type="radio" id="angry" name="mood" value="Enojado">
    <label for="angry">
        <img src="./images/enojado.png" alt="Enojado" width="50">
    </label>

    <input type="radio" id="calm" name="mood" value="Calmado">
    <label for="calm">
        <img src="./images/pensativo.png" alt="Calmado" width="50">
    </label>

    <br>Razón de tu estado de ánimo:<br>
    <textarea name="reason" id="reason" rows="2" cols="50" required></textarea>
    
    <input type="submit" name="cmdweblogin" class="button" value="Ingresar"  />
        </form>';
    return($salida);
    }    
function vistaTablaMedicinas($medicina=NULL)
    {
        $salida='<table class="table table-hover">
                  <tbody>
                    <tr class="table-primary">
                      <th scope="row">Hora</th>
                      <td>Medicamento</td>
                      <td>Dado</td>
                    </tr>';
        for($i=0;$i<count($medicina,0);$i++)
            {
                if($medicina[$i]["dado"]==1) $salida.='<tr class="table-success">';
                else $salida.='<tr class="table-danger">';
                $salida.='<th scope="row">'.date('h:i j-m-Y',$medicina[$i]["hora"]).'</th>';
                $salida.='<td>'.$medicina[$i]["medicina"].'</td>';
                if($medicina[$i]["dado"]==1) $salida.='<td>Muy bien</td>';
                else $salida.='<td><form method="post" action="?view=medicina&accion=marcar&medicina='.$medicina[$i]["id"].'&hora='.$medicina[$i]["hora"].'" enctype="multipart/form-data">
                <input type="submit" value="Tomar"  /></form></td>';
                $salida.='</tr>';
            }
        $salida.='
                    </tbody>
                        </table>';
        return($salida);
    }
function vistaFormIngresoCita()
    {
        $salida='<form action="?view=cita&accion=ingresar" method="post">
    <label for="fecha_hora">Fecha y Hora de la Cita:</label><br>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br><br>

    <label for="informacion">Información de la Cita:</label><br>
    <textarea id="informacion" name="informacion" rows="4" cols="50" required></textarea><br><br>

    <button type="submit">Guardar Cita</button>
</form>';
        return($salida);
    }   
function vistaCita($cita=NULL)
    {
        $salida='<div class="row my-4">
        <div class="col-lg-12">  
          </div>
             </div>
            <div class="row my-4">
                <div class="col-lg-12">';
                for($i=0;$i<count($cita,0);$i++)
                    {
                    $hora_cita=date('h:i:s j-m-Y',$cita[$i][2]);
                    $salida.='    
                    <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                      <div class="card-header">'.$hora_cita.'</div>
                      <div class="card-body">
                        <h4 class="card-title">Cita Medica</h4>
                        <p class="card-text">'.$cita[$i][3].'</p>
                      </div>
                    </div>';
                    }
                $salida.='</div>
              </div>
              </div>';
        return($salida);

    }   
function vistaFormSubirCambio()
    {
        $salida='<form action="?view=cambio&accion=ingresar" method="post" enctype="multipart/form-data">
    <label for="selfie">Sube una imagen para validar los cambios</label><br><br>
    <input type="file" id="selfie" name="selfie" accept="image/*" capture="user" required><br><br>

    <button type="submit">Subir Selfie</button>
</form>';
        return($salida);
    }      
?>