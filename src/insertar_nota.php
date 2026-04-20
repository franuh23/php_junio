<?php
require_once "db/conexion.php";
require_once "models/Nota.php";

try {
    $nota = new Nota();

    $nota->titulo = "Nota de prueba";
    $nota->contenido = "Esta nota es de prueba";
    $nota->usuario_id = 1;

    $nota->insertarNota($pdo);
} catch (PDOException $error) {
    echo "Error en la inserción" . $error->getMessage();
}
?>