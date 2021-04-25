<?php
/*
    Aplicación No 32(Modificacion BD)
    Archivo: ModificacionUsuario.php
    método:POST
    Recibe los datos del usuario(nombre, claveNueva, claveVieja,mail )por POST ,
    crear un objeto y utilizar sus métodos para poder hacer la modificación,
    guardando los datos la base de datos
    retorna si se pudo agregar o no.
    Solo pueden cambiar la clave
*/

include "entidades/usuario.php";

if (isset($_POST['nombre'])&&isset($_POST['claveNueva'])&&isset($_POST['claveVieja'])&&isset($_POST['mail']))
{
    $auxNombre = $_POST['nombre'];
    $auxClaveNueva =$_POST['claveNueva'] ; 
    $auxClaveVieja = $_POST['claveVieja'] ;
    $auxMail = $_POST['mail'] ; 

    $ArrayDeUsuarios = Usuario::TraerTodoLosUsuarios();
    $flagUsuario = FALSE ;

    if (Usuario::ValidarClaveEmail($ArrayDeUsuarios,$auxClaveVieja,$auxMail) == TRUE){
        if (Usuario::UpdateClave($auxClaveNueva,$auxMail,$auxClaveVieja)== TRUE){
            print("Clave Actualizada <br>");
        }else{
            print("Algo salio mal <br>");
        }
    }else{
        print("No se pudo realizar el cambio de clave , datos erroneos <br>");
    }
}else{
    echo "Datos cargados invalidos ";
}