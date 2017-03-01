<style>
	
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
		overflow-x: hidden;
	}
	
	div{
		font-family: monospace;
	}
	
	.contenedor{
		background-color: rgba(255,255,255,0.7);
	}
	
	.producto-img{
		width: 250px;
		height: 325px;
		margin-left: 12.5%;
	}
	
	.bloqueTexto{
		text-align: center;
	}
</style>


<?php
$tituloPagina="Libro";
$pagina="libro";
include('inc/header.php'); 
if(isset($_GET['libro'])) {
	$_SESSION['libro'] = $_GET['libro'];
}
$lista=$bd->listarProducto($_SESSION['libro']);
 echo '<div class="container-products row contenedor">
				
        	<form method="POST">
            <div class="col-md-3">
            	<input type="text" name="pedido" value="'.$lista['idproducto'].'" style="display: none"/>   
                <img class="producto-img" alt="Card image" src="img/'.$lista['imagen'].' ">
				<h3 style="text-align:center"><a href="javascript:void(0)">'.$lista['nombre'].'</a></h3>
				<h4 style="text-align:center">'.$lista['autor'].' </h4>
				<h4 style="text-align:center">'.$lista['precio'].'€ </h4>
             </div>
			 <div class="col-md-7">
                	<p class="bloqueTexto">'.$lista['descripcion'].'</p>
           </div>
		   <div class="col-md-1">
		   		<input class="btn btn-primary btn-block" style="height:10%;margin-top:30%;" type="submit" name="add" value="Añadir">
		   </div>
		   </form>
        </div>';

?>

<?php include('inc/footer.php'); ?>