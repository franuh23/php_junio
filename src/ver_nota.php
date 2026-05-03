<?php

require_once "db/conexion.php";
require_once "models/Nota.php";

$nota = Nota::verNota($pdo, 2);

if ($nota) {
    echo "ID de la nota: " . $nota['id'] . "<br>";
    echo "Título: " . $nota['titulo'] . "<br>";
    echo "Contenido: " . $nota['contenido'] . "<br>";
    echo "Fecha de creación: " . $nota['fecha_creacion'] . "<br>";
    echo "ID del usuario que la creó: " . $nota['usuario_id'] . "<br>";
} else {
    echo "Nota no encontrada";
}

?>