<?php
$empleados = [
    ["Nombre" => "Fran", "Departamento" => "RRHH", "Salario" => 1000, "Antiguedad" => 5],
    ["Nombre" => "Luis", "Departamento" => "Contabilidad", "Salario" => 1200, "Antiguedad" => 3],
    ["Nombre" => "Ana", "Departamento" => "RRHH", "Salario" => 1500, "Antiguedad" => 20],
    ["Nombre" => "Alicia", "Departamento" => "Contabilidad", "Salario" => 1300, "Antiguedad" => 10],
];

// Saco la indemnización y la almacena en un array
$indemnizacion = [];
foreach ($empleados as $empleado) {
    $indemnizacion[] = $empleado['Salario'] * $empleado['Antiguedad'];
}

// Saco la situación de cada empleado y la almacena en un array
$situacion = [];
foreach ($empleados as $empleado) {
    if ($empleado['Antiguedad'] >= 10) {
        $situacion[] = "Veterano";
    } else {
        $situacion[] = "Reciente";
    }
}

// Calculamos en empleado con mayor antiguedad
$empleadoMayor = "";
$mayorAntiguedad = 0;
foreach ($empleados as $empleado) {
    if ($empleado['Antiguedad'] > $mayorAntiguedad) {
        $empleadoMayor = $empleado['Nombre'];
        $mayorAntiguedad = $empleado['Antiguedad'];
    }
}

// Empleado en cada departamenteo
$contabilidad = 0;
$RRHH = 0;
$departamento = "RRHH";
foreach ($empleados as $empleado) {
    if ($empleado['Departamento'] == $departamento) {
        $RRHH ++;
    } else {
        $contabilidad ++;
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
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Salario</th>
            <th>Antiguëdad</th>
            <th>Indemnización estimada</th>
            <th>Situación</th>
        </tr>

        <?php foreach ($empleados as $indice => $empleado): ?>
            <tr>
                <td><?= $empleado['Nombre'] ?></td>
                <td><?= $empleado['Departamento'] ?></td>
                <td><?= $empleado['Salario'] ?>€</td>
                <td><?= $empleado['Antiguedad'] ?> años</td>
                <td><?= $indemnizacion[$indice] ?>€</td>
                <td><?= $situacion[$indice] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>El empleado con mayor antigüedad es  <?= $empleadoMayor ?> con <?= $mayorAntiguedad ?> años de antigüedad</h2>
    <h2>En el departamento de RRHH hay <?= $RRHH ?> empleados</h2>
    <h2>En el departamento de contabilidad hay <?= $contabilidad ?> empleados</h2>
</body>
</html>