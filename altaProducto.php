<?php

/*
    Alumno : Cabeza Leandro

        Aplicación No 30 ( AltaProducto BD)
        Archivo: altaProducto.php
        método:POST.
        Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
        , carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
        verificar si es un producto existente,
        si ya existe el producto se le suma el stock , de lo contrario se agrega .
        Retorna un :
        “Ingresado” si es un producto nuevo
        “Actualizado” si ya existía y se actualiza el stock.
        “no se pudo hacer“si no se pudo hacer
        Hacer los métodos necesarios en la clase.

*/

include "entidades/producto.php";

if (isset($_POST['codigo_de_barra'])&&isset($_POST['nombre']) &&isset($_POST['tipo'])&&isset($_POST['stock'])&&isset($_POST['precio'])&&isset($_POST['fecha_de_creacion'])&&isset($_POST['fecha_de_modificacion']))
{
    // Primero validar si el producto ya existe en la BDD
    $flag = false;

    $ArrayDeProductos = Producto::TraerTodoLosProductos();
    
    if (Producto::ExisteProducto($_POST['codigo_de_barra'],$ArrayDeProductos)){
        /*Si existe actualizoStock*/
  
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

        if (Producto::UpdateStockProducto($_POST['codigo_de_barra'],$_POST['stock'],'+'))
        {
            echo "Stock actualizado"; 
        }else{
            echo "Error no se pudo actualizar el stock"; 
        }
    

    }else if (Producto::ExisteProducto($_POST['codigo_de_barra'],$ArrayDeProductos) == FALSE){
         // Si no existe lo doy de alta

        $unProducto = new Producto();
        $unProducto->codigo_de_barra= $_POST['codigo_de_barra'];
        $unProducto->nombre= $_POST['nombre'];
        $unProducto->tipo=$_POST['tipo'];
        $unProducto->stock=$_POST['stock'];
        $unProducto->precio=$_POST['precio'];
        $unProducto->fecha_de_creacion=$_POST['fecha_de_creacion'];
        $unProducto->fecha_de_modificacion=$_POST['fecha_de_modificacion'];
        $UltimoId=$unProducto->AltaProductoParametros();
        print("Dado de alta con exito <br>".$UltimoId);
    }else{
        echo "No se pudo hacer";
    }
}

