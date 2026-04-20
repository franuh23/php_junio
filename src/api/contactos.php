<?php
/**
 * API REST para gestión de contactos
 * 
 * Este archivo implementa una API REST para realizar operaciones CRUD
 * sobre la tabla de contactos. Soporta los métodos HTTP GET, POST y PUT.
 * 
 * @author Francisco Miguel Utrera Huedo
 * @version 1.0.0
 * @package ProyectoAgendaMVC
 * @category API
 */

header("Content-Type: application/json");

// Incluimos los archivos necesarios
require_once "../db/conexion.php";
require_once "../models/Contacto.php";

$metodo = $_SERVER['REQUEST_METHOD'];

/**
 * Procesa la petición según el método HTTP
 * 
 * Esta función hará una función u otra dependiendo de la petición que recibamos
 * 
 * @return void
 */
function procesarPeticion($metodo, $pdo) {
    switch ($metodo) {
        case 'GET':
            manejarGet($pdo);
            break;
            
        case 'POST':
            manejarPost($pdo);
            break;
            
        case 'PUT':
            manejarPut($pdo);
            break;
            
        default:
            http_response_code(405);
            echo json_encode([
                "error" => "Método no permitido"
            ]);
    }
}

/**
 * Maneja las peticiones GET
 * 
 * Esta función hará una cosa u otra dependiendo de si recibe un id o no
 * Si hay id, busca ese contacto, si no, lista todos
 * 
 * @param PDO $pdo Conexión a la base de datos
 * @return void
 */
function manejarGet($pdo) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        obtenerContacto($pdo, $id);
    } else {
        listarContactos($pdo);
    }
}

/**
 * Lista todos los contactos de la base de datos
 * 
 * Esta función obtiene todos los contactos de la tabla y los devuelve en formato JSON
 * 
 * @param PDO $pdo Conexión a la base de datos
 * @return void
 */
function listarContactos($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM contactos");
        $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
         echo json_encode([
            
            "contactos" => $contactos
     ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al obtener contactos"]);
    }
}

/**
 * Obtiene un contacto específico por su ID
 * 
 * Esta función busca en la base de datos el contacto con el ID que nos pasan
 * Si lo encuentra lo devuelve, si no, devuelve error
 * 
 * @param PDO $pdo Conexión a la base de datos
 * @param mixed $id ID del contacto a buscar
 * @return void
 */
function obtenerContacto($pdo, $id) {
    try {
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["error" => "ID debe ser numérico"]);
            return;
        }
        
        $stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = ?");
        //bindparam
        $stmt->execute([$id]);
        $contacto = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($contacto) {
            echo json_encode([
                
                "contacto" => $contacto
            ]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Contacto no encontrado"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al buscar contacto"]);
    }
}

/**
 * Maneja las peticiones POST para crear nuevos contactos
 * 
 * Esta función se ejecuta cuando se crea un contacto nuevo, lee los datos, los valida y los guarda en la BD
 * 
 * @param PDO $pdo Conexión a la base de datos
 * @return void
 */
function manejarPost($pdo) {
    try {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        
        if (!$datos) {
            http_response_code(400);
            echo json_encode(["error" => "Datos JSON inválidos"]);
            return;
        }
        
        if (empty($datos['name']) || empty($datos['email'])) {
            http_response_code(400);
            echo json_encode(["error" => "Nombre y email son obligatorios"]);
            return;
        }
        
        // Creamos y guardamos el nuevo contacto
        $contacto = new Contacto(
            $datos['name'],
            $datos['email'],
            $datos['phone'] ?? ''
        );
        
        if ($contacto->crearContacto($pdo)) {
            http_response_code(201);
            echo json_encode([
               
                "mensaje" => "Contacto creado",
                "id" => $pdo->lastInsertId()
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al crear contacto"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error en el servidor"]);
    }
}

/**
 * Maneja las peticiones PUT para actualizar contactos existentes
 * 
 * Esta función actualiza un contacto de la BD, necesita el id del contacto y los nuevos datos
 * 
 * @param PDO $pdo Conexión a la base de datos
 * @return void
 */
function manejarPut($pdo) {
    try {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "Se requiere ID"]);
            return;
        }
        
        $id = $_GET['id'];
        
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["error" => "ID debe ser numérico"]);
            return;
        }
        
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        
        if (!$datos) {
            http_response_code(400);
            echo json_encode(["error" => "Datos JSON inválidos"]);
            return;
        }
        
        // Verificamos que el contacto existe
        $stmt = $pdo->prepare("SELECT id FROM contactos WHERE id = ?");
        $stmt->execute([$id]);
        
        if (!$stmt->fetch()) {
            http_response_code(404);
            echo json_encode(["error" => "Contacto no encontrado"]);
            return;
        }
        
        // Consulta de actualización
        $campos = [];
        $valores = [];
        
        if (isset($datos['name'])) {
            $campos[] = "name = ?";
            $valores[] = $datos['name'];
        }
        
        if (isset($datos['email'])) {
            $campos[] = "email = ?";
            $valores[] = $datos['email'];
        }
        
        if (isset($datos['phone'])) {
            $campos[] = "phone = ?";
            $valores[] = $datos['phone'];
        }
        
        if (empty($campos)) {
            http_response_code(400);
            echo json_encode(["error" => "No hay campos para actualizar"]);
            return;
        }
        
        // Añadimos el ID para la condición del WHERE
        $valores[] = $id;
        
        // Ejecutamos la actualización
        $sql = "UPDATE contactos SET " . implode(", ", $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($valores)) {
            echo json_encode([
                
                "mensaje" => "Contacto actualizado"
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al actualizar"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error en el servidor"]);
    }
}

// Ejecutamos la petición
procesarPeticion($metodo, $pdo);
?>