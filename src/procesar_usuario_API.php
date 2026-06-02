<?php
header("Content-Type: application/json; charset=utf-8");

// Incluimos dependencias
require_once "models/Usuario.php";
require_once "db/conexion.php";
require_once "utils/utils.php";

// Comprobamos el método 
$metodo = $_SERVER["REQUEST_METHOD"];

// Recuperamos el ID
$id = $_GET['id'] ?? null;
if ($id === null) {
    $id = 0;
}

// Switch
switch ($metodo) {

    // Consultar usuarios o usuario
    case 'GET':
        // Comprobamos si el ID es cero
        if ($id != 0) {
            // Comprobamos si el usuario existe
            $usuario = Usuario::recuperarUsuario($pdo, $id);
            if ($usuario) {
                formatearRespuesta($usuario, 200);
            } else {
                formatearRespuesta(["mensaje" => "El usuario no existe."], 400);
            }
        } else {
            // Si no recibe ID pinta todos los usuarios
            $usuarios = Usuario::listarUsuarios($pdo);
            if ($usuarios) {
                formatearRespuesta($usuarios, 200);
            } else {
                formatearRespuesta(["mensaje" => "No se han encontrado usuarios."], 400);
            }
        }
        break;

    // Insertar usuario
    case 'POST':
        // Obtenemos los datos de la petición
        $datos = obtenerDatosPeticion();

        if ($datos) {
            $usuario = new Usuario($datos["nombre"], $datos["email"], $datos["password"]);
            $idNuevoUsuario = $usuario->insertarUsuario($pdo);

            // Recuperamos el usuario insertado
            $usuario = Usuario::recuperarUsuario($pdo, $idNuevoUsuario);
            if ($usuario) {
                formatearRespuesta($usuario, 200);
            } else {
                formatearRespuesta(["mensaje" => "El usuario no existe."], 400);
            }

        } else {
            formatearRespuesta(["mensaje" => "No se han informado los datos correctamente."], 400);
        }
        break;

    // Actualizar usuario
    case 'PUT':
        // Obtenemos los datos de la petición
        $datos = obtenerDatosPeticion();

        // Comprobamos si el ID es cero
        if ($id != 0) {
            // Si no es cero recuperamos el usuario
            $usuario = Usuario::recuperarUsuario($pdo, $id);
            // Comprobamos si el usuario existe
            if ($usuario) {
                $usuario->actualizarUsuario($pdo);
                formatearRespuesta(["mensaje" => "Usuario actualizado correctamente."], 200);
            } else {
                formatearRespuesta(["mensaje" => "El usuario no existe."], 400);
            }
        } else {
            // Si es cero lanzamos error
            formatearRespuesta(["mensaje" => "No se ha informado un ID."], 400);
        }   
        break;
    
    default:
        formatearRespuesta(["error" => "Método no permitido"], 400);
        break;
}