<?php
/*
==========================================================
EJERCICIO 3 - Temperaturas semanales
==========================================================
 
No puedes usar echo. Usa <?= ?> y la sintaxis alternativa de bucles
para mezclar PHP con HTML.
 
Tienes las temperaturas de 3 ciudades durante 7 días (una fila por ciudad).
 
Implementa:
a) Muestra los datos en una tabla HTML (filas = ciudades, columnas = días).
b) Calcula y muestra la temperatura media de cada ciudad.
c) Calcula y muestra la temperatura máxima global, indicando también
   (como reto extra) en qué ciudad y qué día se registró.
*/
 
$temperaturas = [
    [22, 24, 25, 21, 23, 26, 27], // Ciudad 1
    [18, 19, 20, 21, 20, 18, 17], // Ciudad 2
    [30, 31, 32, 29, 28, 30, 31], // Ciudad 3
];
 
$nombresCiudades = ["Madrid", "A Coruña", "Sevilla"];
$nombresDias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
 
// ---------------------------------------------------------
// Calcula aquí en PHP puro lo que necesites para b) y c)
// (medias por ciudad, máxima global, ciudad/día de la máxima...)
// ---------------------------------------------------------

// Apartado B
$mediasCiudades = [];
foreach ($temperaturas as $i => $ciudad) {
    $mediasCiudades[$i] = array_sum($ciudad) / count($ciudad);
}

// Apartado C
$todasTemperaturas = array_merge(...$temperaturas);
$maxGlobal = max($todasTemperaturas);

$ciudadRegistro = 0;
$diaRegistro = 0;

foreach ($temperaturas as $indiceFila => $ciudad) {
    foreach ($ciudad as $indiceColumna => $temp) {
        if ($temp == $maxGlobal) {
            $ciudadRegistro = $nombresCiudades[$indiceFila];
            $diaRegistro = $nombresDias[$indiceColumna];
        }
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
    <h2>Tabla temperaturas</h2>
    <table border="1">
        <tr>
            <?php foreach ($nombresDias as $dia): ?>
                <th><?= $dia ?> </th>
            <?php endforeach; ?>
        </tr>
    </table>

    <h2>Apartado B</h2>
    <?php foreach ($nombresCiudades as $i => $ciudad): ?>
        <p>La temperatura media de <?= $ciudad ?> es de <?= $mediasCiudades[$i] ?> ºC</p>
    <?php endforeach; ?>    

    <h2>Apartado C</h2>
    <p>La temperatura máxima global es <?= $maxGlobal ?> ºC</p>
    <p>Esta se ha registrado en la ciudad de <?= $ciudadRegistro ?> el <?= $diaRegistro ?> </p>
</body>
</html>