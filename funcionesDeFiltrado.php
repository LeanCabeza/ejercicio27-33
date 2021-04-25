<?php

include "entidades/usuario.php";
include "entidades/producto.php";
include "entidades/venta.php";

$Punto = $_GET['Punto'];

switch ($Punto) {
    case 'A':
    case 'a':
            /*A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
            alfabéticamente de forma ascendente o descendente.
            ASC (ascendente) o DESC (desendente) */
            echo "<br>EJERCICIO A)";
            $listadoUsuariosOrdenados = Usuario::TraerUsuariosOrdenarlosAlfabeticamente('ASC');
            Usuario::ImprimirUsuarios($listadoUsuariosOrdenados);
            break;
    case 'B':
    case 'b':
        echo "<br>EJERCICIO B)";
        /*B. Obtener los detalles completos de todos los productos y poder ordenarlos
             alfabéticamente de forma ascendente y descendente.
             ASC (ascendente) o DESC (desendente) */
            $listadoProductosOrdenados = Producto::TraerProductoOrdenarlosAlfabeticamente('ASC');
            Producto::ImprimirProductos($listadoProductosOrdenados);
            break;
    case 'C':
    case 'c':
            echo "<br>EJERCICIO C)";
            /*C. Obtener todas las compras filtradas entre dos cantidades.*/
            $listadoVentasOrdenadas2Cant = Venta::ObtenerComprasEntreCantidades(1,5);
            Venta::ImprimirVentas($listadoVentasOrdenadas2Cant);
            break;
    case 'D':
    case 'd':
            echo "<br>EJERCICIO D)";
            /*  D. Obtener la cantidad total de todos los productos vendidos entre dos fechas. */
            $ArrayVentasEntreFechas = Venta::ObtenerComprasEntreFechas('2020-01-01','2020-05-05');
            echo "<br>La cantidad de Ventas es : ".Venta::ObtenerCantidadVentas($ArrayVentasEntreFechas)."<br>";
            break;
    case 'E':
    case 'e':
            echo "<br>EJERCICIO E)";
            /*E. Mostrar los primeros “N” números de productos que se han cargado.*/
            $ArrayNNumerosCargados = Producto::MostrarNProductosCargados(1);
            Producto::ImprimirProductos($ArrayNNumerosCargados);   
            break;
    case 'F':
    case 'f':
            echo "<br>EJERCICIO F)";
            /*F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.*/
            $ArrayVentasConNombreYproducto = Venta::TraerTodasVentasConNombreYProducto();
            Venta::ImprimirVentas($ArrayVentasConNombreYproducto);
            break;
    case 'G':
    case 'g':
            echo "<br>EJERCICIO G)";
            /*G. Indicar el monto (cantidad * precio) por cada una de las ventas.*/
            $precioXVenta = Venta::CantidadxPrecio();
            Venta::ImprimirVentas($precioXVenta);
            break;
    case 'H':
    case 'h':
            echo "<br>EJERCICIO H)";
            /*H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario(ejemplo: 104).*/
            $cantidadTotalVentasPorId = Venta::CantidadTotalProducto(1003,104);
            echo "<br>La cantidad de Ventas es : ".Venta::ObtenerCantidadVentas($cantidadTotalVentasPorId)."<br>";
            break;
    case 'I':
    case 'i':
            /*I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).*/
            $arrayVentasxLocalidad = Venta::cantidadxLocalidad('Quilmes');
            Venta::ImprimirVentas($arrayVentasxLocalidad);
            break;
    case 'J':
    case 'j':
            echo "<br>EJERCICIO J)";
            /*J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o apellido.*/
            $arrayContenidos = Usuario::TraerUsuariosQueContengan('a');
            Usuario::ImprimirUsuarios($arrayContenidos);
            break;
    case 'K':
    case 'k':
            echo "<br>EJERCICIO K)";
            /*K. Mostrar las ventas entre dos fechas del año.*/
            $ArrayVentasEntreFechas2 = Venta::ObtenerComprasEntreFechas('2020-01-01','2020-08-05');
            Venta::ImprimirVentas($ArrayVentasEntreFechas2);
            break;
    default:
        echo "No ingresaste una letra valida , debe ser de la A  - K ";
        break;
}


