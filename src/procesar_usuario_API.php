<?php
header("Content-Type: application/json; charset=utf-8");

// Incluimos dependencias
require_once "models/Usuario.php";
require_once "db/conexion.php";
require_once "utils/utils.php";

// Comprobamos el método 
$metodo = $_SERVER["REQUEST_METHOD"];

// Validamos el método
echo $metodo;

// Recuperamos el ID
$id = $_GET['id'] ?? null;
if ($id === null) {
    $id = 0;
}


// Switch
switch ($metodo) {
    case 'GET':
        if ($id != 0) {
            $usuario = Usuario::recuperarUsuario($pdo, $id);
            formatearRespuesta($usuario, 200);

        } else {
            $usuarios = Usuario::listarUsuarios($pdo);
            formatearRespuesta($usuarios, 200);
        }
        break;

    case 'POST':
        $datos = obtenerDatosPeticion();
        
        $usuario = new Usuario($datos["nombre"], $datos["email"], $datos["password"]);
        $usuario->insertarUsuario($pdo);
        formatearRespuesta(["mensaje" => "Usuario insertado correctamente."], 200);
        break;
    
    default:
        formatearRespuesta(["error" => "Método no permitido"], 400);
        break;
}