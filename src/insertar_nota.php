<?php
require_once "db/conexion.php";
require_once "models/Nota.php";

try {
    $nota = new Nota("Nota de prueba 2", "Esta nota es de prueba 2", 1);

    $nota->insertarNota($pdo);
    
} catch (PDOException $error) {
    echo "Error en la inserción" . $error->getMessage();
}
?>