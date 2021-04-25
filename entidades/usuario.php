<?php
include "AccesoDatos.php";

class Usuario
{
	public $nombre;
 	public $apellido;
  	public $clave;
  	public $mail;
    public $fecha_de_registro; 
    public $localidad;

	public function __construct() {

	}

	public function AltaUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,apellido,clave,mail,fecha_de_registro,localidad)values(:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
                $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
                $consulta->bindValue(':fecha_de_registro', $this->fecha_de_registro, PDO::PARAM_STR);
                $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 
  	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->apellido."  ".$this->clave."  ".$this->mail."  ".$this->fecha_de_registro."  ".$this->localidad;
	}

	public static function UsuarioExistente($ArrayDeUsuarios,$id){
        $flag = false ;
        foreach ($ArrayDeUsuarios as $usu) {
            if($usu->id == $id){
                     $flag = TRUE;
                     break;
                 }
            }
        return $flag ;
    }

	public static function ValidarClaveEmail ($ArrayDeUsuarios,$clave,$mail){
        $flag = FALSE;
        foreach ($ArrayDeUsuarios as $usu) {
            if($usu->clave == $clave && $usu->mail == $mail){
                     $flag = TRUE;
                     break;
                 }
            }
        return $flag ;
    }

	public static function UpdateClave($claveNueva,$mail,$claveVieja){
		if (isset($claveNueva) && isset($mail)&& isset($claveVieja))
		{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
			update usuarios
			set clave = '$claveNueva'
			WHERE mail = '$mail' AND clave='$claveVieja'");
			$consulta->execute();
			return true ;
		}else{
			return false ;
		}
		
	}

	public static function ImprimirUsuarios($array){

		foreach($array as $usu)
		{
			echo "<ul>";
			foreach($usu as $item)
			{
				echo "<li>$item</li>";
			}
            
			echo "</ul>";
		}

	}

	/*
		A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
			alfabéticamente de forma ascendente o descendente.
	*/

	public static function TraerUsuariosOrdenarlosAlfabeticamente($ordenamiento)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios ORDER BY nombre $ordenamiento ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	/*10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.*/


	public static function TraerUsuariosQueContengan($valorABuscar){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
		SELECT usuarios.nombre
		FROM usuarios 
		WHERE usuarios.nombre like '%$valorABuscar%' ");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}

}