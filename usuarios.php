<style>
	
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
		overflow-x: hidden;
	}
	
	div{
		font-family: monospace;
	}
	
	.tablaUsuarios{
		background-color: floralwhite;
		font-size: 18px;
		color: dimgray;
	}	
	
	#avisoUsuarios{
		color:darkblue;
		background-color: rgba(255,255,255,0.8);
	}
</style>

<?php
$tituloPagina="Usuarios";
$pagina="usuarios";
include('inc/header.php'); 
$lista = $bd->listarUsuarios();
if(isset($_POST['eliminar'])){
		if($bd->deleteUser($_POST['linea'])){
			echo '<script language="javascript">alert("Usuario eliminado");</script>';
		}
	}
?>
<div class='row'>
    	<div class='col-md-12'><h1 style='text-align:center;' id='avisoUsuarios'>Usuarios Registrados</h1></div>
    </div>"
 <div>
	<table class="table tablaUsuarios">
<?php 
	if(count($lista) != 0){
		$tabla_users = "<tr><th>Nombre</th><th>tipo</th><th>Accion</th></tr>";
		foreach ($lista as $key => $value){
			if($value['tipo'] != "admin"){
				$tabla_users.= "<tr><form method='POST'><input type='text' name='linea' value='".$value['nombre']."' style='display: none'/><td style='min-widht: 200px;'>". $value['nombre']. "</td><td>".$value['tipo']."</td><td><button class='btn btn-primary' name='eliminar' type='submit' ><span class='glyphicon glyphicon-trash'></span></button></td></form></tr>";
			}else{
				$tabla_users.= "<tr><form method='POST'><input type='text' name='linea' value='".$value['nombre']."' style='display: none'/><td style='min-widht: 200px;'>". $value['nombre']. "</td><td>".$value['tipo']."</td><td></td></form></tr>";
			}
			
		}
		echo $tabla_users;
	}
	else
	{
		echo "No hay usuarios disponibles.";
	}

?>
	</table>
</div>


<?php include('inc/footer.php'); ?>
   