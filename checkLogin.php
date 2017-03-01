<?php

	require_once 'BD.php';
	$bd=BD::getInstance();
	
 
/* @var $_POST type */
$nombre= $_POST["txtusuario"];
$pass= $_POST["txtpassword"];
if($nombre != "" && $pass != ""){
 $si = $bd->iniciaSesion($nombre, $pass);
 
 if ($si){
 	 	 session_start();
        $_SESSION['usuario']=$nombre;
		$_SESSION['pass'] = $pass;
        $_SESSION['tiempo']=time();
        $_SESSION['tipo'] = $bd->tipoUser($nombre);
		
 	 header("Location:index.php"); 
	 
 }else{
  header("Location:index.php?error=1"); 
 }

}else{
	header("Location:index.php?error=error-login");
}

?>