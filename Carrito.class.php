<?php
session_start();
 
class Carrito
{
 
	//Este array es el contenedor de los productos.
	private $carrito = array();
 
	//Definimos el carrito exista o no exista en el constructor
	public function __construct()
	{
		
		if(!isset($_SESSION["carrito"]))
		{
			$_SESSION["carrito"] = null;
			$this->carrito["precio_total"] = 0;
			$this->carrito["articulos_total"] = 0;
		}
		$this->carrito = $_SESSION['carrito'];
	}
 
	//Añadir un producto
	public function add($articulo = array())
	{
		//Se comprueba el producto nuevo, si está vacío o no es un 
		//array lanzamos una excepción y cortamos la ejecución
		if(!is_array($articulo) || empty($articulo))
		{
			throw new Exception("Error, el articulo no es un array!", 1);	
		}
 
		//Nuestro carro debe tener siempre un id producto, cantidad y precio articulo
		if(!$articulo["id"] || !$articulo["cantidad"] || !$articulo["precio"])
		{
			throw new Exception("Error, el articulo debe tener un id, cantidad y precio!", 1);	
		}
 
		//Nuestro carro debe tener siempre un id producto, cantidad y precio articulo
		if(!is_numeric($articulo["id"]) || !is_numeric($articulo["cantidad"]) || !is_numeric($articulo["precio"]))
		{
			throw new Exception("Error, el id, cantidad y precio deben ser números!", 1);	
		}
 
		//Se crea un identificador único para cada producto
		$unique_id = md5($articulo["id"]);
 
		//Creamos la id única para el producto
		$articulo["unique_id"] = $unique_id;
		
		//Si no está vacío el carrito lo recorremos 
		if(!empty($this->carrito))
		{
			foreach ($this->carrito as $row) 
			{
				//Comprobamos si este producto ya estaba en el 
				//carrito para actualizar el producto o insertar
				//un nuevo producto	
				if($row["unique_id"] === $unique_id)
				{
					//Sumamos la cantida en caso de que ya existiese en el carrito
					$articulo["cantidad"] = $row["cantidad"] + $articulo["cantidad"];
				}
			}
		}
 
		//Filtramos que solo puedan introducirse valores numéricos en cantidad y precio
		$articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
	    $articulo["precio"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["precio"]));
 
	    //Mostramos la cuantía total de los productos en el carrito para 
	    //saber el precio total de la suma de este artículo
	    $articulo["total"] = $articulo["cantidad"] * $articulo["precio"];
 
	    //Primero debemos eliminar el producto si es que estaba en el carrito
	    $this->unset_producto($unique_id);
 
	    //Añadir producto al carro
	    $_SESSION["carrito"][$unique_id] = $articulo;
 
	    //Actualizar carro
	    $this->update_carrito();
 
	    //Actualizamos el precio total y el número de artículos del carrito
	    $this->update_precio_cantidad();
 
	}
 
	//Actualización el precio total y la cantidad
	//de productos total del carrito
	private function update_precio_cantidad()
	{
		//Establecemos las variables precio y artículos a 0
		$precio = 0;
		$articulos = 0;
 
		//Recorrer el contenido del carrito para actualizar
		//el precio total y el número de artículos
		foreach ($this->carrito as $row) 
		{
			$precio += ($row['precio'] * $row['cantidad']);
			$articulos += $row['cantidad'];
		}
 
		//Asignacion del numero de articulos y del precio el precio actual
		$_SESSION['carrito']["articulos_total"] = $articulos;
		$_SESSION['carrito']["precio_total"] = $precio;
 
		//Actualizamos el carrito
		$this->update_carrito();
	}
 
	//Método que retorna el precio total del carrito
	public function precio_total()
	{
		//Si no está definido el elemento precio_total o no existe el carrito
		//el precio total será 0
		if(!isset($this->carrito["precio_total"]) || $this->carrito === null)
		{
			return 0;
		}
		//Si no es númerico lanzamos una excepción porque no es correcto
		if(!is_numeric($this->carrito["precio_total"]))
		{
			throw new Exception("El precio total del carrito debe ser un número", 1);	
		}
		//En cualquier otro caso devolvemos el precio total
		return $this->carrito["precio_total"] ? $this->carrito["precio_total"] : 0;
	}
 
	//Método que retorna el número de artículos del carrito
	public function articulos_total()
	{
		//Si no está definido el elemento articulos_total o no existe el carrito
		//el número de artículos será de 0
		if(!isset($this->carrito["articulos_total"]) || $this->carrito === null)
		{
			return 0;
		}
		//Si no es númerico lanzamos una excepción
		if(!is_numeric($this->carrito["articulos_total"]))
		{
			throw new Exception("El número de artículos del carrito debe ser un número", 1);	
		}
		//En cualquier otro caso devolvemos el número de artículos del carrito
		return $this->carrito["articulos_total"] ? $this->carrito["articulos_total"] : 0;
	}
 
	//Obtener el contenido del carrito
	public function get_content()
	{
		//Asignamos el carrito a una variable
		$carrito = $this->carrito;
		//Debemos eliminar del carrito el número de artículos
		//y el precio total para poder mostrar bien los artículos
		//ya que estos datos los devuelven los métodos 
		//articulos_total y precio_total
		unset($carrito["articulos_total"]);
		unset($carrito["precio_total"]);
		return $carrito == null ? null : $carrito;
	}
 
	//Método que llamamos al insertar un nuevo producto al 
	//carrito para eliminarlo si existia, así podemos insertarlo
	//de nuevo pero actualizado
	private function unset_producto($unique_id)
	{
		unset($_SESSION["carrito"][$unique_id]);
	}
 
	//para eliminar un producto debemos pasar la clave única
	//que contiene cada uno de ellos
	public function remove_producto($unique_id)
	{
		//Si no existe el carrito
		if($this->carrito === null)
		{
			throw new Exception("El carrito no existe!", 1);
		}
 
		//Si no existe la id única del producto en el carrito
		if(!isset($this->carrito[$unique_id]))
		{
			throw new Exception("La unique_id $unique_id no existe!", 1);
		}
 
		//En otro caso, eliminamos el producto, actualizamos el carrito y 
		//el precio y cantidad totales del carrito
		unset($_SESSION["carrito"][$unique_id]);
		$this->update_carrito();
		$this->update_precio_cantidad();
		return true;
	}
 
	//Eliminamos todo el contenido del carrito
	public function destroy()
	{
		unset($_SESSION["carrito"]);
		$this->carrito = null;
		return true;
	}
 
	//Actualizamos el contenido del carrito
	public function update_carrito()
	{
		self::__construct();
	}
 
}