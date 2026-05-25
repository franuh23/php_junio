<?php
require_once "db/conexion.php";
class Usuario
{
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;

    public function __construct($nombre, $email, $password, $fecha_registro = null)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro ?? date('Y-m-d');
    }

    // Getter mágico
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        return "Propiedad '$propiedad' no encontrada";
    }

    // Setter mágico
    public function __set($propiedad, $valor)
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        } else {
            throw new Exception("Propiedad '$propiedad' no encontrada", 1);
        }
    }

    public function insertarUsuario($pdo)
    {
        try {
            $sql = "INSERT INTO usuarios (nombre, email, password, fecha_registro) 
        VALUES(:nombre, :email, :password, :fecha_registro)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":fecha_registro", $this->fecha_registro);

            $stmt->execute();

            echo "Usuario insertado correctamente";
        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public static function listarUsuarios($pdo) {
        try {
            $sql = "SELECT nombre, email, fecha_registro FROM usuarios LIMIT 50";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;

        } catch (PDOException $error) {
            echo "Error al listar los usuarios" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public static function recuperarUsuario($pdo, $id) {
        try {
            $sql = "SELECT id, nombre, email, fecha_registro, password FROM usuarios WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                return $usuario;
            } else {
                return null;
            }

        } catch (PDOException $error) {
            echo "Error al ver el usuario." . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function actualizarUsuario($pdo) {
        try {
            // Si existe, actualizamos
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            echo "Usuario actualizado correctamente";
            return true;

        } catch (PDOException $error) {
            echo "Error al actualizar el usuario: " . $error->getMessage();
            return false;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function borrarUsuario ($pdo) {
        try {
            // Si existe, borramos
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            echo "Usuario borrado correctamente";
            return true;

        } catch (PDOException $error) {
            echo "Error al borrar el usuario: " . $error->getMessage();
            return false;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
}
?>