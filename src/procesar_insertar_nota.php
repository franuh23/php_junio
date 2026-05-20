<?php
require_once "db/conexion.php";
require_once "models/Nota.php";
require_once "utils/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos las funciones de validar campos
    $titulo = validarCampo($_POST['titulo']);
    $contenido = validarCampo($_POST['contenido']);
    $usuario_id = validarNumero($_POST['usuario_id']);

    if ($titulo && $contenido && $usuario_id) {
        try {
            $nota = new Nota($titulo, $contenido, $usuario_id);
            $nota->insertarNota($pdo);
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    } else {
        echo "Alguno de los campos no pasó la validación";
    }
}
?>
