<?php
include_once "AccesoDatos.php";

class Producto
{
	public $codigo_de_barra;
 	public $nombre;
  	public $tipo;
  	public $stock;
    public $precio; 
    public $fecha_de_creacion;
    public $fecha_de_modificacion;

    public function __construct() {

	}

	public function AltaProductoParametros()
	 {
		 //INSERT into producto(codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)
																			   values(:codigo_de_barra,:nombre,:tipo,:stock,:precio,:fecha_de_creacion,:fecha_de_modificacion)");
				$consulta->bindValue(':codigo_de_barra',$this->codigo_de_barra, PDO::PARAM_INT);
				$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
				$consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
				$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
				$consulta->bindValue(':fecha_de_creacion', $this->fecha_de_creacion, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_de_modificacion', $this->fecha_de_modificacion, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

  	public static function TraerTodoLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS,"producto");		
	}

	public static function ExisteProducto($codigoDeBarra,$ArrayDeProductos){
		foreach ($ArrayDeProductos as $p) {
            if($p->codigo_de_barra == $codigoDeBarra ){
                     return  true ;
                     break;
                 }
             }
        return false;
    }

	public static function UpdateStockProducto($codigoDeBarra,$stockParaAgregar,$signo){

			if (isset($codigoDeBarra) && isset($stockParaAgregar))
			{
				if ($signo == '+'){
					$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
					$consulta =$objetoAccesoDato->RetornarConsulta("
					update producto
					set stock= stock + $stockParaAgregar
					WHERE codigo_de_barra=$codigoDeBarra");
					$consulta->execute();
					return true ;
				}else if ($signo == '-'){
					$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
					$consulta =$objetoAccesoDato->RetornarConsulta("
					update producto
					set stock= stock - $stockParaAgregar
					WHERE codigo_de_barra=$codigoDeBarra");
					$consulta->execute();
					return true ;
				}else{
					echo "Signo ingresado Invalido";
					return false ;
				}
			}else{
				echo "No ingresaste los datos";
				return false ;
			}
	}

	public static function UpdateProducto($codigoDeBarra,$nombre,$tipo,$stock,$precio){
			if (isset($codigoDeBarra) && isset($nombre) && isset($tipo) && isset($stock) && isset($precio) )
			{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$fecha = (string)date("Y-m-d");
                $consulta =$objetoAccesoDato->RetornarConsulta("
                update producto
                set nombre = '$nombre',
                tipo = '$tipo',
                stock = '$stock',
                precio = '$precio'
                WHERE codigo_de_barra = '$codigoDeBarra'");
                $consulta->execute();
				return true ;
			}else{
				return false ;
			}		
	}

	public static function UpdateStockProductoPorId($idProducto,$stockParaAgregar,$signo){

		if (isset($idProducto) && isset($stockParaAgregar))
		{
			if ($signo == '+'){
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto
				set stock= stock + $stockParaAgregar
				WHERE id=$idProducto");
				$consulta->execute();
				return true ;
			}else if ($signo == '-'){
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto
				set stock= stock - $stockParaAgregar
				WHERE id=$idProducto");
				$consulta->execute();
				return true ;
			}else{
				echo "Signo ingresado Invalido";
				return false ;
			}
		}else{
			echo "No ingresaste los datos";
			return false ;
		}
}
	

	public static function ImprimirProductos($array){

		foreach($array as $prod)
		{
			echo "<ul>";
			foreach($prod as $item)
			{
				echo "<li>$item</li>";
			}
			echo "</ul>";
		}
	}

	
    public static function ValidarIdUProdyStock($array,$idProd,$cant){
        $flag = false ;
        foreach ($array as $p) {
            if($p->id == $idProd && $p->stock >= $cant){
                     $flag = true ;
                     break;
                 }
            }
        return $flag ;
    }



	public static function TraerProductoOrdenarlosAlfabeticamente($ordenamiento)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto ORDER BY nombre $ordenamiento ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}
	

	///*E. Mostrar los primeros “N” números de productos que se han enviado.*/

	public static function MostrarNProductosCargados (string $nProductos){

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto ORDER BY nombre DESC LIMIT :nProductos");
		$consulta->bindValue(':nProductos',$nProductos, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS,"producto");		
	}

/// JSON 
	public static function Guardar($prod, $mode)
    {
        $retorno = false;

        $archivo = fopen("C:/xampp/htdocs/Noguera/ejercicio25/producto.json", $mode);

        if($archivo != false)
        {
            if(fwrite($archivo, json_encode($prod->Producto_toArray()) . "\n") != false)
            {
                $retorno = true;
            }

            fclose($archivo);
        }

        return $retorno;
    }

    public static function Leer()
    {
        $retorno = false;
        $vec = array();

        $archivo = fopen("C:/xampp/htdocs/Noguera/ejercicio25/producto.json", "r");

        if($archivo != false)
        {
            while(!feof($archivo))
            {
                $lectura = fgets($archivo);
                $auxVec = json_decode($lectura, true);

                if($auxVec != null)
                {
                    $prod = new Producto($auxVec["codigoBarra"], $auxVec["nombre"], $auxVec["tipo"], $auxVec["stock"], $auxVec["precio"], $auxVec["id"]);

                    array_push($vec, $prod);
                }
            }
        }

        return $vec;
    }


}