<?php

/*
    Aplicación Nº 28 ( Listado BD)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
    cada objeto o clase tendrán los métodos para responder a la petición
    devolviendo un listado <ul> o tabla de html <table>

*/

include "entidades/usuario.php";
include "entidades/producto.php";
include "entidades/venta.php";

$listadoMostrar = $_GET['DATO'];

switch ($listadoMostrar) {
    case 'usuarios':
        $ArrayDeUsuarios = Usuario::TraerTodoLosUsuarios();
        Usuario::ImprimirUsuarios($ArrayDeUsuarios);
        break;
    case 'productos':
        $ArrayDeProductos = Producto::TraerTodoLosProductos();
        Producto::ImprimirProductos($ArrayDeProductos);
    
        break;
    case 'ventas':
        $ArrayDeVentas = Venta::TraerTodasVentas();
        Venta::ImprimirVentas($ArrayDeVentas);
         break;
    default:
        echo "No coincidio con ninguno";
        break;
}