<style>
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
		overflow-x: hidden;
	}
	
	div{
		font-family: monospace;
	}
	
	#jumbo{
		background-color: rgba(252, 192, 80,0.6);
		margin: 0;
		padding: 2%;
	}
	
	#tituloDestacados{
		color:darkblue;
		background-color: rgba(255,255,255,0.8);
	}
	
	.tarjetaDestacado{
		background-color: transparent !important;
		border-color: transparent !important;
	}
	
	.cabeceraDestacado{
		background-color: #f7b231;
	}	
	
	.cuerpoDestacado{
		font-size: 16px;
		text-align: center;
		background-color: #fcc050;
	}
	
	#pieDestacado{
		background-color: #d3a247;
		border: 1px solid gray;
	}
	
	.titulo{
		font-size: 24px;
		transition: font-size 1s;
	}
	
	.titulo:hover{
		font-size: 26px;
		text-decoration: none;
		color: black;
	}
	
	.producto-img{
		width: 250px;
		height: 325px;
		margin-left: 12.5%;
	}
</style>

<?php
$tituloPagina="Libreria Online"; 
$pagina="inicio";
include('inc/header.php');
$lista=$bd->listarProductos();
?>
   
  <div class="jumbotron" id='jumbo'>
    <h1>Libreria Online</h1> 
    <p>Tu librería online mas completa. Para disfrutar de una buena lectura donde y cuando quieras.</p> 
  </div>
    <div class='row'>
    	<div class='col-md-12'><h1 style="text-align:center;" id='tituloDestacados'>Libros destacados</h1></div>
    </div>
    <div class="container-products container">

<?php
foreach ($lista as $key => $value){
	echo '
	<div class="col-md-4 panel panel-default tarjetaDestacado">
	<div class=""> 
	<form method="POST">
		<div class="panel-heading cabeceraDestacado">
	    	<input type="text" name="pedido" value="'.$value['idproducto'].'" style="display: none"/>
	        <a href="libro.php?libro='.$value['idproducto'].'">
	            <img class="producto-img" src="img/'.$value['imagen'].'">
	            	
	        </a></div>
			<div class="panel-body cuerpoDestacado">
	        <h4>
	           <a href="libro.php?libro='.$value['idproducto'].'" class="titulo">'.$value['nombre'].'</a>
	        </h4>
	        <p>'.$value['autor'].'</p>
	        <p>'.$value['precio'].'€ </p>
			</div>
			<div class="panel-footer" id="pieDestacado">
	        	<input class="btn btn-primary btn-block" type="submit" name="add" value="Añadir">
	    </div>
	</form></div></div>';
	if($value['idproducto'] == 3){
		break;
	}
}
?>
      </div>
    
<?php include('inc/footer.php'); ?>
   