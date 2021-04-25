<?php
/*
Alumno : Leandro Cabeza

    Aplicación No 31 (RealizarVenta BD )
    Archivo: RealizarVenta.php
    método:POST
    Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
    POST .
    Verificar que el usuario y el producto exista y tenga stock.
    Retorna un :
    “venta realizada”Se hizo una venta
    “no se pudo hacer“si no se pudo hacer
    Hacer los métodos necesarios en las clases
*/

include_once "entidades/usuario.php";
include_once "entidades/producto.php";
include_once "entidades/venta.php";



if (isset($_POST['idProducto'])&&isset($_POST['idUsuario'])&&isset($_POST['cantidad']))
{
    $idProducto = $_POST['idProducto'];
    $idUsuario = $_POST['idUsuario']; 
    $cantidad = $_POST['cantidad'];
    $flagProducto = false ;
    $flagUsuario = false ;

    // Primero valido que sea un id producto valido , que haya suficiente stock y un id usuario valido 

    $ArrayDeProductos = Producto::TraerTodoLosProductos();
    $ArrayDeUsuarios = Usuario::TraerTodoLosUsuarios();


 
    if (  Producto::ValidarIdUProdyStock($ArrayDeProductos,$idProducto,$cantidad)==FALSE || Usuario::UsuarioExistente($ArrayDeUsuarios,$idUsuario) ==FALSE){
        echo "No se pudo hacer, STOCK Insuficiente o Usuario NO exitente";
    }

        if (Producto::ValidarIdUProdyStock($ArrayDeProductos,$idProducto,$cantidad)==TRUE && Usuario::UsuarioExistente($ArrayDeUsuarios,$idUsuario) ==TRUE){
        //Doy de alta la venta 
            $auxVenta = new Venta();
            $auxVenta->idProducto= $_POST['idProducto'];
            $auxVenta->idUsuario= $_POST['idUsuario'];
            $auxVenta->cantidad=$_POST['cantidad'];
            $auxVenta->fechaDeVenta=date("y/m/d");
            $auxVenta->AltaVentaParametros();

            // Previamente ya corrobore que tenga stock suficiente , lo actualizo  
            
            if (Producto::UpdateStockProductoPorId($idProducto,$cantidad,'-')==TRUE){
                print("Venta Realizada <br>");
            }else{
                print("Error Con la venta <br>");
            }
            
            

        }
}else{
    echo "DaTOS iNCOMPLETOS";
}