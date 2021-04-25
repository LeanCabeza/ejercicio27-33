<?php 

/*
Alumno : Cabeza Leandro 

    Aplicación No 33 ( ModificacionProducto BD)
    Archivo: modificacionproducto.php
    método:POST
    Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
    ,
    crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
    si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
    el código de barras .
    Retorna un :
    “Actualizado” si ya existía y se actualiza
    “no se pudo hacer“si no se pudo hacer
    Hacer los métodos necesarios en la clase
*/

include "entidades/producto.php";

if (isset($_POST['codigo_de_barra'])&&isset($_POST['nombre'])&&isset($_POST['tipo'])&&isset($_POST['stock'])&&isset($_POST['precio']))
{
    $auxCodigoDeBarra = $_POST['codigo_de_barra'] ; 
    $auxNombre = $_POST['nombre'];
    $auxTipo = $_POST['tipo'];
    $auxStock = $_POST['stock'];
    $auxPrecio = $_POST['precio'];

    $ArrayDeProductos = Producto::TraerTodoLosProductos();

    if (Producto::ExisteProducto($auxCodigoDeBarra,$ArrayDeProductos)){
        if (Producto::UpdateProducto($auxCodigoDeBarra,$auxNombre,$auxTipo,$auxStock,$auxPrecio)==TRUE){
            print("Producto Actualizado <br>");
        }else{
            print("Faltan ingresar Datos<br>");
        }

    }else{
        print("No se pudo realizar la actualizacion , codigo de barra erroneo <br>");
    }

}