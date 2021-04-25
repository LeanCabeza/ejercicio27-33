<?php
include_once "AccesoDatos.php";

class Venta
{
	public $idProducto;
 	public $idUsuario;
  	public $cantidad;
  	public $fechaDeVenta;

    public function __construct() {

	}

	public function AltaVentaParametros()
	 {
		//iNSERT INTO ventas(idProducto,idUsuario,cantidad,fechaDeVenta) values(1001,101,2,"2020-07-19");
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ventas(idProducto,idUsuario,cantidad,fechaDeVenta)
																			   values(:idProducto,:idUsuario,:cantidad,:fechaDeVenta)");
				$consulta->bindValue(':idProducto',$this->idProducto, PDO::PARAM_INT);
				$consulta->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_STR);
				$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_STR);
				$consulta->bindValue(':fechaDeVenta', $this->fechaDeVenta, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

  	public static function TraerTodasVentas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

	public static function ImprimirArrayVentas($ArrayDeVentas){

		foreach ($ArrayDeVentas as $v){
            echo " 	<ul>
                        <li>".$v->idProducto."</li>
                        <li>".$v->idUsuario."</li>
                        <li>".$v->cantidad."</li>
                        <li>".$v->fechaDeVenta."</li>
                         
                    </ul>";
        }	
	}

	public static function ImprimirIdVentas($ArrayDeVentas){

		foreach ($ArrayDeVentas as $v){
            echo " 	<ul>
                        <li>".$v->idProducto."</li>             
                    </ul>";
        }	
	}

	public static function ImprimirVentas($array){

		foreach($array as $v)
		{
			echo "<ul>";
			foreach($v as $item)
			{
				echo "<li>$item</li>";
			}
            
			echo "</ul>";
		}

	}

	
	public static function ObtenerComprasEntreCantidades($cantidadDesde,$cantidadHasta)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ventas WHERE cantidad >= $cantidadDesde && cantidad <= $cantidadHasta");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

	
	public static function ObtenerComprasEntreFechas($fechaInicial, $fechaFinal){
        	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from ventas 
			WHERE ventas.fechaDeVenta >= '$fechaInicial' AND ventas.fechaDeVenta <= '$fechaFinal'");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
   }

   public static function ObtenerCantidadVentas($ArrayVentas){
	   $cantidadVentas = 0 ; 
		foreach ($ArrayVentas as $v){
			$cantidadVentas = $cantidadVentas +  $v->cantidad; 
		}
   		return $cantidadVentas;
	}
	

	public static function TraerTodasVentasConNombreYProducto()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT CONCAT(usuarios.nombre,' ',usuarios.apellido), producto.nombre,ventas.cantidad,ventas.fechaDeVenta
		FROM usuarios,ventas,producto
		WHERE (ventas.idProducto = producto.id AND ventas.idUsuario = usuarios.id )");	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}

	/*G. Indicar el monto (cantidad * precio) por cada una de las ventas.*/

	public static function CantidadxPrecio()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select ventas.fechaDeVenta,round(ventas.cantidad * producto.precio,2) from ventas,producto WHERE (ventas.idProducto = producto.id)");	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}

		/*
    H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
        (ejemplo: 104).
	*/

	public static function CantidadTotalProducto (string $idProductoIngresado,string $idVendedorIngresado){

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
		SELECT *
		FROM ventas
		WHERE ventas.idProducto = :idProductoIngresado AND ventas.idUsuario = :idVendedorIngresado ");
		$consulta->bindValue(':idProductoIngresado',$idProductoIngresado, PDO::PARAM_STR);	
		$consulta->bindValue(':idVendedorIngresado',$idVendedorIngresado, PDO::PARAM_STR);	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

	public static function CantidadxLocalidad ($localidadIngresada){

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
		select v.idProducto from ventas v 
        inner join usuarios u on u.id = v.idUsuario
        where u.localidad = :localidadIngresada");
        $consulta->bindValue(':localidadIngresada',$localidadIngresada, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);	
	}


}