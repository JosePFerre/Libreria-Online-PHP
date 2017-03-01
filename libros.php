<style>
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
		overflow-x: hidden;
	}
	
	div{
		font-family: monospace;
	}
	
	#tituloLibros{
		color:darkblue;
		background-color: rgba(255,255,255,0.8);
	}
	
	.tarjetaLibro{
		background-color: transparent !important;
		border-color: transparent !important
	}
	
	.cabeceraLibro{
		background-color: #f7b231;
	}	
	
	.cuerpoLibro{
		font-size: 16px;
		text-align: center;
		background-color: #fcc050;
		color: black;
	}
	
	#pieLibro{
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
$tituloPagina="Libros"; 
$pagina="libros";
include('inc/header.php');
$lista=$bd->listarProductos();
?>
    <div class='row'>
    	<div class='col-md-12'><h1 style="text-align:center;" id='tituloLibros'>Nuestra Biblioteca</h1></div>
    </div>
    <div class="container-products container">
<?php
foreach ($lista as $key => $value){
	echo '
	<div class="col-md-4">
	<div class="panel panel-default tarjetaLibro">  
	<form method="POST">
		<div class="panel-heading cabeceraLibro">
	    	<input type="text" name="pedido" value="'.$value['idproducto'].'" style="display: none"/>
	        <a href="libro.php?libro='.$value['idproducto'].'">
	            <img class="producto-img" src="img/'.$value['imagen'].'">
	            	
	        </a></div>
			<div class="panel-body cuerpoLibro">
	        <h4>
	           <a href="libro.php?libro='.$value['idproducto'].'" class="titulo">'.$value['nombre'].'</a>
	        </h4>
	        <p>'.$value['autor'].'</p>
	        <p>'.$value['precio'].'€ </p>
			</div>
			<div class="panel-footer" id="pieLibro">
	        	<input class="btn btn-primary btn-block" type="submit" name="add" value="Añadir">
	    </div>
	</form></div></div>';
}
?>
      
    </div>
<?php include('inc/footer.php'); ?>