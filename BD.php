<!-- 
s=string 
i=integer
-->


<?php
Class BD extends mysqli{

   private $servidor='localhost';
   private $usuario='root';
   private $password='';
   private $base_datos='libreria_online';
   private $link;
   private $stmt;
   private $array;
   static $_instance;

   private function BD(){
      $this->conectar();
   }

   private function __clone(){ }

   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
      return self::$_instance;
   }

	
	private function conectar(){
	  $this->link=mysqli_connect($this->servidor, $this->usuario, $this->password, $this->base_datos);

	  @mysqli_query("SET NAMES 'utf8'");
	}
   
    public function iniciaSesion($nombre, $clave){
		$this->stmt=mysqli_query($this->link, "SELECT count(*) as valido FROM usuarios where nombre='$nombre' and clave=PASSWORD('$clave')");
		$contador=mysqli_num_rows($this->stmt);	
		if($contador != 0){	
			if($ro = mysqli_fetch_array($this->stmt)){ 
	  			if ($ro['valido']==1){
					return true;			
				}else{
					return false;
				}
			}
		}
   	}
	
	//Obtención de un solo producto
   public function listarProducto($producto){
		$this->stmt=mysqli_query($this->link, "select idproducto, autor, imagen, nombre, disponibles, precio, descripcion from libros where idproducto=". $producto);
		$contador=mysqli_num_rows($this->stmt);
		$lista = array();	
		if($contador != 0){
			while($ro = mysqli_fetch_array($this->stmt)){
					
					$lista['autor']= $ro['autor'];
					$lista['imagen']= $ro['imagen'];
					$lista['descripcion']= $ro['descripcion'];
					$lista['idproducto'] = $ro['idproducto'];
					$lista['nombre']= $ro['nombre'];
					$lista['disponibles']= $ro['disponibles'];
					$lista['precio']= $ro['precio'];
					
			}
			return $lista;
	   }
   }
	
   //Obtencion de todos los productos
   public function listarProductos(){
		$this->stmt=mysqli_query($this->link, "select idproducto, autor, imagen, nombre, disponibles, precio, descripcion from libros");
		$contador=mysqli_num_rows($this->stmt);
		$lista = array();	
		$cuenta =0;
		if($contador != 0){
			while($ro = mysqli_fetch_array($this->stmt)){
					$lista[$cuenta]= array();
					$lista[$cuenta]['autor']= $ro['autor'];
					$lista[$cuenta]['imagen']= $ro['imagen'];
					$lista[$cuenta]['idproducto'] = $ro['idproducto'];
					$lista[$cuenta]['nombre']= $ro['nombre'];
					$lista[$cuenta]['disponibles']= $ro['disponibles'];
					$lista[$cuenta]['precio']= $ro['precio'];
					$lista[$cuenta]['descripcion']= $ro['descripcion'];
					$cuenta++;
			}
			return $lista;
	   }
   }
	
   //Añadir un usuario a la base de datos
   public function insertUser($email,$pass,$tipo = "normal")
   {
   		if($this->iniciaSesion($email, $pass) == false)
		{
			$this->stmt = mysqli_prepare($this->link,"Insert Into usuarios (nombre,clave,tipo) values (?,PASSWORD(?),?);");
			$this->stmt->bind_param("sss", $email, $pass, $tipo);
			$this->stmt->execute();
			return true;
		}
		else
		{
			return false;
		}
   		
   }
	
   //Añadir un producto a la base de datos
   public function insertProducto($autor,$imagen,$nombre,$disponibles,$precio,$descripcion)
   {
	   	$this->stmt=mysqli_query($this->link, "SELECT count(*) as valido FROM libros where nombre='$nombre';");
		$contador=mysqli_num_rows($this->stmt);	
		if($contador != 0){	
			if($ro = mysqli_fetch_array($this->stmt)){ 
	  			if ($ro['valido']==0){
					$this->stmt = mysqli_prepare($this->link,"Insert Into libros (autor,imagen,nombre,disponibles,precio,descripcion) values (?,?,?,?,?,?);");
					$this->stmt->bind_param("sssiis", $autor,$imagen,$nombre,$disponibles,$precio,$descripcion);
					if($this->stmt->execute())
					{
						return true;
					}
					else
					{
						return false;
					}			
				}else{
					return false;
				}
			}
		}
			   		
		
   }
	
   //Determinar si el usuario es administrador o un usuario normal
   public function tipoUser($user)
   {
   		$this->stmt = mysqli_prepare($this->link,"Select tipo from usuarios where nombre = ?");
		$this->stmt->bind_param("s", $user);
		
		if($this->stmt->execute())
		{
			$this->stmt->bind_result($tipo);
			while ($this->stmt->fetch())
			{
		        return $tipo;
		    }
		}
		else
		{
			return "error";
		}
		
   }
	
   //Listar todos los usuarios registrados
   public function listarUsuarios()
   {
   		$this->stmt = mysqli_prepare($this->link,"Select nombre,clave,tipo from usuarios;");
		
		if($this->stmt->execute())
		{
			$this->stmt->bind_result($nombre,$clave,$tipo);
			$array = array();
			while ($this->stmt->fetch())
			{
		        $array[]= array(
		        	"nombre" => $nombre,
		        	"clave" => $clave,
		        	"tipo" => $tipo 
				);
		    }
			return $array;
		}
		else
		{
			return false;
		}
		
   }
   //cambio de contraseña 
   public function cambiarPass($user,$old_pass,$new_pass)
   {
   		if($this->iniciaSesion($user, $old_pass))
		{
			$this->stmt = mysqli_prepare($this->link,"Update usuarios set clave=PASSWORD(?) where nombre=?;");
			$this->stmt->bind_param("ss", $new_pass, $user );
			$this->stmt->execute();
			return true;
		}
		else
		{
			return false;
		}
   }
	
   //Borramos un usuario de la base de datos
   public function deleteUser($id)
   {
   		$this->stmt = mysqli_prepare($this->link,"Delete from usuarios where nombre = ?;");
		$this->stmt->bind_param("s", $id);
		if($this->stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
   }
	
   //Borramos un producto de la base de datos
   public function deleteProducto($id)
   {
   		$this->stmt = mysqli_prepare($this->link,"Delete from libros where nombre = ?;");
		$this->stmt->bind_param("s", $id);
		if($this->stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
   }
}
?>