<?php

function validar_formulario()
	{		
		$sql="SELECT * FROM usuario WHERE usuario='".$_POST['user']."' AND password='".$_POST['pass']."' LIMIT 1";
		$usuario_datos=modeloSelectMysql($sql);
		session_name('USUARIOS_SESSION');
		session_start();
		session_cache_limiter('nocache,private');
		$_SESSION['usuario_id']=$usuario_datos[0]['id'];
		$_SESSION['usuario_login']=$usuario_datos[0]['usuario'];
		$_SESSION['usuario_password']=$usuario_datos[0]['password'];
		$_SESSION['usuario_nombre']=$usuario_datos[0]['nombre'];
		if (isset($usuario_datos[0]['usuario']) && !empty($usuario_datos[0]['usuario'])) 
			{
	        return "SIP";
	    	}
	}

function validaAutenticacion()
	{
	if (isset($_SESSION['usuario_login']) && !empty($_SESSION['usuario_login'])) 
		{
        return "SIP";
    	} 
    else {
    	if (isset($_POST['user']) && !empty($_POST['user'])) 
    		{
        	return validar_formulario();
    		}
    	}
	}

function destruyeSesion() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start("USUARIOS_SESSION");
    }
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: index.php");
    exit();
}