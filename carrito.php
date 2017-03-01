<style>
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
		overflow-x: hidden;
	}
	
	.tablaCarrito{
		background-color: floralwhite;
		font-size: 18px;
		color: dimgray;
	}	
	
	#avisoCarrito{
		color:darkblue;
		background-color: rgba(255,255,255,0.8);
	}
	
	.botonCarrito{
		margin-left: 30%;
	}
</style>


<?php
$tituloPagina="Carrito de compra";
$pagina="carrito";
include('inc/header.php'); 

if(isset($_POST['comprar'])){
	unset($_SESSION['carro']);
	echo '<script language="javascript">alert("Compra realizada");</script>';
}
if(isset($_POST['eliminar'])){
	foreach ($_SESSION['carro'] as $key => $value){
		if($value['nombre'] == $_POST['linea']){
			unset($_SESSION['carro'][$key]);
			if(count($_SESSION['carro']) == 0){
				unset($_SESSION['carro']);
			}
		}
	}
}
	
if(isset($_POST['limpiar'])){
	unset($_SESSION['carro']);
}


?>
<table class="table tablaCarrito">
	
<?php
	if(isset($_SESSION['carro'])){
		$total = 0;
		echo "<form method='POST'>";
		$_SESSION['carrito'] = "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Accion</th></tr>";
		foreach ($_SESSION['carro'] as $key => $value){
			$total += $value['precio']*$value['cantidad'];
			$_SESSION['carrito'].= "<tr><form method='POST'><input type='text' name='linea' value='".$value['nombre']."' style='display: none'/><td>". $value['nombre']. "</td><td>". $value['precio']. "</td><td>". $value['cantidad']. "</td><td>". $value['precio']*$value['cantidad']."</td><td><button class='btn btn-primary' name='eliminar' type='submit' ><span class='glyphicon glyphicon-trash'></span></button></td></form></tr>";
		}
		$_SESSION['carrito'].= "<tr><td>Total</td><td></td><td></td><td>$total €</td><td></td></tr>";
		echo "    <div class='row'>
    	<div class='col-md-12'><h1 style='text-align:center;' id='avisoCarrito'>Carrito de compra</h1></div>
    </div>";
		echo "<input class='btn btn-primary botonCarrito' type='submit' value='Comprar' name='comprar' />
		<input class='btn btn-primary botonCarrito' type='submit' value='Limpiar' name='limpiar' />
		</form>".$_SESSION['carrito'];
	}
	else {
		echo "<h1 style='background-color:floralwhite;text-align:center;'>No hay ningun producto en el carrito.</h1>";
	}
	
?>


</table>

<?php include('inc/footer.php'); ?>
   