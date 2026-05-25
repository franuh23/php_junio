<?php
require_once "db/conexion.php";
require_once "models/Nota.php";
require_once "utils/validaciones.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Usamos las funciones de validar campos
        $nota_id = validarNumero($_POST['nota_id']);
        $nuevoTitulo = validarCampo($_POST['titulo']);
        $nuevoContenido = validarCampo($_POST['contenido']);

        if ($nota_id && $nuevoTitulo && $nuevoContenido) {
            $nota = Nota::verNota($pdo, $nota_id);

            if ($nota) {
                $nota->actualizarNota($pdo);
            } else {
                echo "La nota no existe.";
            }
        }
    } catch (Exception $error) {
        echo "Error: " . $error->getMessage();
    }

} else {
    echo "Alguno de los campos no pasó la validación";
}
?>