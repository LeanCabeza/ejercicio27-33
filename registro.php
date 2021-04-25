<?php

/*
Alumno Leandro Cabeza

Aplicación Nº 27 (Registro BD) 
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST , 
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos  la base de datos 
retorna si se pudo agregar o no.
*/

include "entidades/usuario.php";



if (isset($_POST['nombre'])&&isset($_POST['apellido']) &&isset($_POST['clave'])&&isset($_POST['mail'])&&isset($_POST['fecha_de_registro'])&&isset($_POST['localidad']))
{
    //utilización del método estatico
    $unUsuario = new Usuario();
    $unUsuario->nombre= $_POST['nombre'];
    $unUsuario->apellido= $_POST['apellido'];
    $unUsuario->clave=$_POST['clave'];
    $unUsuario->mail=$_POST['mail'];
    $unUsuario->fecha_de_registro=$_POST['fecha_de_registro'];
    $unUsuario->localidad=$_POST['localidad'];

    $UltimoId=$unUsuario->AltaUsuarioParametros();
    print("Dado de alta con exito<br>".$UltimoId);
}




