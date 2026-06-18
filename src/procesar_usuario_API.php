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

        // Validamos campos
        $nombre = validarCampo($datos["nombre"]);
        $email = validarEmail($datos["email"]);
        $password = validarCampo($datos["password"]);

        if ($nombre && $email && $password) {
            $nuevoUsuario = new Usuario($nombre, $email, $password);
            $idNuevoUsuario = $nuevoUsuario->insertarUsuario($pdo);

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
        // Si el ID es cero
        if ($id == 0) {
            formatearRespuesta(["mensaje"=> "No se ha informado un ID válido."], 400);
        }

        // Obtenemos los datos de la petición
        $datos = obtenerDatosPeticion();

        // Validamos campos
        $nombre = validarCampo($datos["nombre"]);
        $email = validarEmail($datos["email"]);

        if ($nombre && $email) {
            // Comprobamos si el usuario existe
            $existe = Usuario::recuperarUsuario($pdo, $id);
            if ($existe) {
                $usuario = new Usuario($nombre, $email, $id);
                $usuario->actualizarUsuario($pdo);
                formatearRespuesta(["mensaje" => "Usuario actualizado correctamente."], 200);
            } else {
                formatearRespuesta(["mensaje" => "El usuario no existe."], 400);
            }
        } else {
            formatearRespuesta(["mensaje" => "No se han informado los datos correctamente."], 400);
        }   
        break;
    
    default:
        formatearRespuesta(["error" => "Método no permitido"], 400);
        break;
}