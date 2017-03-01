<style>
	.modal-header{
		font-size: 20px;
		text-align: center;
		background-color: #ffd07c;
		border-radius: 5px;
	}
	
	.modal-body{
		font-size: 16px;
		text-align: center;
		background-color: #ffe5b7;
		border-radius: 5px;
	}
	
	.modal-footer{
		font-size: 16px;
		text-align: center;
		background-color: #ffd07c;
		border-radius: 5px;
	}
	
</style>


<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $tituloPagina; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
				
			div{
				font-family: monospace;
			}
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<?php
require_once 'BD.php';
$bd=BD::getInstance();
$activo = true;
session_start();
if(!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "invitado";
  }
if(isset($_POST['change_pass'])) {
  if($bd->cambiarPass($_SESSION['usuario'],$_POST['password_confirmation'],$_POST['password'])) {
    $_SESSION['pass'] = $_POST['password'];
    echo '<script language="javascript">alert("Clave Cambiada");</script>';
  } else {
      echo '<script language="javascript">alert("Error al cambiar de clave");</script>';
  }
}
    
if(isset($_POST['delete_user'])) {
  if($bd->deleteUser($_SESSION['usuario'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    echo '<script language="javascript">alert("Usuario eliminado");</script>';
  } else {
      echo '<script language="javascript">alert("Error al eliminar usuario");</script>';
  }     
}

if(isset($_POST) && $_POST != null) {
  if(isset($_POST['add'])) {
    if (!isset($_SESSION['carro'])) {
      $_SESSION['carro'] = array();
    }
    if(isset($_POST['pedido'])) {
      $lista = $bd->listarProducto($_POST['pedido']);
      if(!isset($_SESSION['carro'][$lista['idproducto']])) {
        $_SESSION['carro'][$lista['idproducto']] = array (
            "nombre" => $lista['nombre'],
            "id" => $lista['idproducto'],
            "precio" => $lista['precio'],
            "cantidad" => 1
        );
      } else {
        $_SESSION['carro'][$lista['idproducto']]['cantidad'] += 1;
      }
        $activo = true;
        if ($_SESSION['usuario'] != "invitado") {
          $activo=false;
        }
    } else {
      $activo = true;   
      if ($_SESSION['usuario'] != "invitado") {
        $activo=false;
      }
    }
  }
  if(isset($_POST['register'])) {
    $error = "";
    
    if(!isset($_POST['email']) && $_POST['email'] == "") {
      $error .= "* Debe introducir un email correcto";
    }
    if(!isset($_POST['password']) && $_POST['password'] == "") {
      $error .= "* Debe introducir una contraseña correcta";
    }
    if(!isset($_POST['password_confirmation']) && $_POST['password_confirmation'] == "") {
      $error .= "* Debe introducir una confirmacion de contraseña correcta";
    }
    if(isset($_POST['password_confirmation']) && isset($_POST['password'])) {
      if($_POST['password_confirmation'] != $_POST['password']) {
        $error .= "* Las contraseñas debe coincidir";
      }
    }
    if($error == "") {
      if($bd->insertUser($_POST['email'],$_POST['password'])) {
        $_SESSION['usuario']=$_POST['email'];
        $_SESSION['pass'] = $_POST['password'];
        $_SESSION['tipo'] = "normal";
            $_SESSION['tiempo']=time();
        $activo=false;
      }
      else {
        echo '<script language="javascript">alert("El usuario ya esta registrado.");</script>';
      }
    }
    else {
      echo '<script language="javascript">alert("'.$error.'");</script>';
    }
  }
      
}
if ($_SESSION['usuario'] != "invitado") {
  $activo=false;
}

?>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Libreria Online</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if ($pagina=='inicio') { echo 'active'; } ?>"><a href="index.php">Inicio</a></li>
            <li class="<?php if ($pagina=='libros') { echo 'active'; } ?>"><a href="libros.php">Libros</a></li>

<?php
if ($activo) {
  $elementos = 0;
  if(isset($_SESSION['carro'])) {
    foreach ($_SESSION['carro'] as $key => $value) {
      $elementos += $value['cantidad'];
    }
  }
  echo '
            <li class="';if ($pagina=='registro') { echo 'active'; }; echo'"><a href="registro.php">Regístrate</a></li>
          </ul>
          <form id="formulario" class="navbar-form navbar-right" action="checkLogin.php" role="form" method="POST">
            <div class="form-group">
              <input id="user" type="text" placeholder="Usuario" class="form-control" name="txtusuario">
            </div>
            <div class="form-group">
              <input id="password" type="password" placeholder="Contraseña" class="form-control" name="txtpassword">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>';
} else {
  $elementos = 0;
  if(isset($_SESSION['carro'])) {
    foreach ($_SESSION['carro'] as $key => $value) {
      $elementos += $value['cantidad'];
    }
  }
  echo '
            <li><a href="javascript:void(0)" class="btn" data-toggle="modal" data-target="#perfil">'.$_SESSION['usuario'].'</a></li>
          ';
  if($_SESSION['tipo'] == "admin"){
    echo '<li class="';if ($pagina=='usuarios') { echo 'active'; }; echo'"><a href="usuarios.php">Usuarios</a></li>
      <li class="';if ($pagina=='admin_prod') { echo 'active'; }; echo'"><a href="admin_prod.php">Productos</a></li>
    ';
  }
  echo '<li><a href="Cerrar.php">Cerrar Sesion</a></li></ul>';
}
?>

          
          <ul class="nav navbar-nav navbar-right">
            <li class="<?php if ($pagina=='carrito') { echo 'active'; } ?>"><a href="carrito.php"><span class="glyphicon glyphicon-shopping-cart"></span><?php echo $elementos ?></a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>



<!-- Cambio de contraseña y eliminacion de perfil -->
<div class="modal fade" id="perfil" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cambie su contraseña aquí</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" style="padding: 10px;">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Contraseña anterior">
            </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Contraseña nueva">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12 controls">
                  <button type="submit" name="change_pass" class="btn btn-primary pull-center">Modificar contraseña</button>
                  <button type="submit" name="delete_user" class="btn btn-primary pull-center">Darse te baja. Te echaremos de menos :( </button>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    
  </div>
</div>