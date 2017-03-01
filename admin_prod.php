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
	
</style>

<?php
$tituloPagina="Administracion de productos";
$pagina="admin_prod";
include('inc/header.php'); 


if(isset($_POST['insertar']))
	{
		$error = "";
		if($_POST['nombre'] != ""){
			$nombre = $_POST['nombre'];
		}else{
			$error .= "nombre";
		}
		
		if($_POST['autor'] != ""){
			$autor = $_POST['autor'];
		}else{
			$error .= "autor";
		}
		
		if($_POST['imagen'] != ""){
			$imagen = $_POST['imagen'];
		}else{
			$error .= "imagen";
		}
		
		if($_POST['descripcion'] != ""){
			$descripcion = $_POST['descripcion'];
		}else{
			$error .= "descripcion";
		}
		
		
		if($_POST['disponibles'] != ""){
			$disponibles = $_POST['disponibles'];
		}else{
			$error .= "disponibles";
		}
		
		if($_POST['precio'] != ""){
			$precio = $_POST['precio'];
		}else{
			$error .= "precio";
		}
		
		if($error == ""){
			if($bd->insertProducto($autor,$imagen,$nombre,$disponibles,$precio,$descripcion)){
				echo '<script language="javascript">alert("Producto introducido correctamente");</script>';
			}else{
				echo '<script language="javascript">alert("Error al introducir el producto");</script>';
			}
		}else{
			echo '<script language="javascript">alert("Introduzca bien los datos");</script>';
		}
		
	}
	if(isset($_POST['eliminar'])){
		if($bd->deleteProducto($_POST['linea'])){
			echo '<script language="javascript">alert("Producto eliminado");</script>';
		}
	}    
?>
<div class="modal fade" id="insert_producto" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inserta un nuevo producto:</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" style="padding: 10px;">
          			<div class="col-xs-6 col-sm-6 col-md-6">
    					<div class="form-group">
    						<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
    					</div>
    				</div>
     				<div class="col-xs-6 col-sm-6 col-md-6">
    					<div class="form-group">
    						<input type="text" name="autor" id="autor" class="form-control input-sm" placeholder="Autor del libro">
    					</div>
    				</div>
      				<div class="col-xs-6 col-sm-6 col-md-6">
    					<div class="form-group">
    						<input type="text" name="imagen" id="imagen" class="form-control input-sm" placeholder="Ruta Imagen">
    					</div>
    				</div>
    				<div class="col-xs-6 col-sm-6 col-md-6">
    					<div class="form-group">
    						<input type="text" name="disponibles" id="disponibles" class="form-control input-sm" placeholder="Existencias">
    					</div>
    				</div>
			  <div class="col-xs-3 col-sm-3 col-md-3"></div>
    				<div class="col-xs-6 col-sm-6 col-md-6">
    					<div class="form-group">
    						<input type="text" name="precio" id="precio" class="form-control input-sm" placeholder="Precio">
    					</div>
    				</div>
    				<div class="col-xs-12 col-sm-12 col-md-12">
    					<div class="form-group">
							<textarea type="text" name="descripcion" id="descripcion" class="form-control input-sm" placeholder="Descripcion"></textarea>
    					</div>
    				</div>
            <div class="form-group">
            	<div class="col-sm-12 controls">
                    <button type="submit" name="insertar" class="btn btn-primary pull-center">Insertar nuevo producto</button>                        
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<table class="table tablaUsuarios">
       <?php 
	       	$lista = $bd->listarProductos();
			if(count($lista) != 0){
				$tabla_prod = "<tr><th>Nombre</th><th>Autor</th><th>Precio</th><th>Disponibles</th><th>Imagen</th><th>Accion</th></tr>";
				foreach ($lista as $key => $value){
					$tabla_prod.= "<tr><form method='POST'><input type='text' name='linea' value='".$value['nombre']."' style='display: none'/><td style='min-widht: 200px;'>". $value['nombre']. "</td><td>".$value['autor']."</td><td>".$value['precio']."</td><td>".$value['disponibles']."</td><td>".$value['imagen']."</td><td><button class='btn btn-primary' name='eliminar' type='submit' ><span class='glyphicon glyphicon-trash'></span></button></td></form></tr>";
				}
				echo $tabla_prod.'<input type="submit" data-toggle="modal" data-target="#insert_producto" value="Inserta un nuevo producto" class="btn btn-primary btn-block" tyl>';
        	}else{
				echo "No hay productos disponibles.";
			}
        ?>
</table>




<?php include('inc/footer.php'); ?>
   