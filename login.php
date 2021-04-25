<?php
/*
    Aplicación Nº 29( Login con bd)
    Archivo: Login.php
    método:POST
    Recibe los datos del usuario(clave,mail )por POST , 
    crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la base de datos,
    Retorna un :
    “Verificado” si el usuario existe y coincide la clave también.
    “Error en los datos” si esta mal la clave.
    “Usuario no registrado si no coincide el mail“
    Hacer los métodos necesarios en la clase usuario.

*/

include "entidades/usuario.php";


if (isset($_POST['mail'])&&isset($_POST['clave']))
{
    $ArrayDeUsuarios = Usuario::TraerTodoLosUsuarios();
    $flagRegistrado = false ;

    $mailIngresado = $_POST['mail'];
    $claveIngresada= $_POST['clave'] ; 


    foreach ($ArrayDeUsuarios as $usu) {
       if($mailIngresado == $usu->mail){
            if($claveIngresada == $usu->clave)
            {
                echo "Verificado";
                $flagRegistrado = true ;
                break;
            }else{ 
               echo "Email bien , clave mal";
               $flagRegistrado = true ;
                break;
            }  
        }
    }

    if ($flagRegistrado == false)
    {
        echo "No esta registrado";
    }
       
}

    





