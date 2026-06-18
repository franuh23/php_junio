<?php
/*
==========================================================
EJERCICIO 1 - Gestión de productos (array multidimensional)
==========================================================
 
Tienes un array de productos ya cargado en el código (sin formularios).
Cada producto es un array asociativo con "nombre", "categoria" y "precio".
 
Implementa:
a) Mostrar todos los productos en una tabla HTML.
b) Calcular y mostrar:
   - Precio medio de todos los productos.
   - Producto más caro.
   - Producto más barato.
   - Número total de productos.
c) Filtrar los productos por una categoría fija (definida en una variable,
   por ejemplo $categoriaFiltro = "Plantas";) y mostrar solo esos productos
   en otra tabla.
*/
 
$productos = [
    ["nombre" => "Tomatera",   "categoria" => "Plantas",     "precio" => 5],
    ["nombre" => "Maceta",     "categoria" => "Accesorios",  "precio" => 8.5],
    ["nombre" => "Geranio",    "categoria" => "Plantas",     "precio" => 6.2],
    ["nombre" => "Abono",      "categoria" => "Fertilizantes","precio" => 12],
    ["nombre" => "Regadera",   "categoria" => "Accesorios",  "precio" => 15],
    ["nombre" => "Cactus",     "categoria" => "Plantas",     "precio" => 4.5],
];
 
$categoriaFiltro = "Plantas";
 
// ---------------------------------------------------------
// TU CÓDIGO AQUÍ
// ---------------------------------------------------------
 
// a) Tabla de productos
 
 
// b) Precio medio, más caro, más barato, total
$arrayPrecios = array_column($productos, "precio");
$precioCaro = max($arrayPrecios);
$precioBarato = min($arrayPrecios);
$precioMedio = array_sum($arrayPrecios) / count($productos);
$precioTotal = array_sum($arrayPrecios);

 
// c) Filtrado por categoría

$arrayFiltrado = [];
foreach ($productos as $producto) {
    if ($producto['categoria'] == $categoriaFiltro) {
        $arrayFiltrado[] = $producto;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tabla de productos (Apartado A)</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <?php foreach ($producto as $cosa): ?>
                    <td><?= $cosa ?></td>
                <?php endforeach;?>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Apartado B</h2>
    <p>Precio medio: <?= $precioMedio ?>€</p>
    <p>Precio más caro: <?= $precioCaro ?>€</p>
    <p>Precio más barato: <?= $precioBarato ?>€</p>
    <p>Precio total: <?= $precioTotal ?>€</p>

    <h2>Apartado C</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($arrayFiltrado as $producto): ?>
            <tr>
                <?php foreach ($producto as $cosa): ?>
                    <td><?= $cosa ?></td>
                <?php endforeach;?>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
