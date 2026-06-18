<?php
/*
==========================================================
EJERCICIO 2 - Matriz 3x3
==========================================================
 
No puedes usar echo. Usa <?= ?> para imprimir valores y la sintaxis
alternativa de bucles (<?php for(...): ?> ... <?php endfor; ?>)
cuando necesites mezclar bucles con HTML.
 
Implementa:
a) Recorre la matriz con bucles anidados y muéstrala así:
   1 2 3
   4 5 6
   7 8 9
 
b) Calcula y muestra la suma total de todos los elementos.
 
c) Define $numeroBuscado y comprueba si existe en la matriz.
   Muestra el resultado, indicando fila y columna si se encuentra.
 
*/
 
$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
 
$numeroBuscado = 77;
 
// ---------------------------------------------------------
// Calcula aquí en PHP puro lo que necesites para b) y c)
// (suma total, si se ha encontrado el número, fila, columna...)
// ---------------------------------------------------------
$sumaTotal = 0;
foreach ($matriz as $fila) {
    foreach ($fila as $numero) {
        $sumaTotal += $numero;
    }
}

$columna = 0;
$fila = 0;
$busqueda = false;

foreach ($matriz as $indiceFila => $fila) {
    foreach ($fila as $indiceColumna => $numero) {
        if ($numeroBuscado == $numero) {
            $numeroColumna = $indiceColumna + 1;
            $numeroFila = $indiceFila + 1;
            $busqueda = true;
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
    <h2>Apartado A</h2>
    <?php foreach ($matriz as $fila): ?>
        <?php foreach ($fila as $numero): ?>
            <?= $numero ?>
        <?php endforeach; ?>
    <br>
    <?php endforeach; ?>

    <h2>Apartado B</h2>
    <p>Suma total: <?= $sumaTotal ?> </p>

    <h2>Apartado C</h2>
    <p>Numero a buscar: <?= $numeroBuscado ?> </p>
    <?php if ($busqueda): ?>
        <p>El número introducido se encuentra en la fila <?= $numeroFila ?> y la columna <?= $numeroColumna ?> </p>
        <?php else : ?>
            <p>El número a buscar no se encuentra en la matriz</p>
    <?php endif; ?>
</body>
</html>