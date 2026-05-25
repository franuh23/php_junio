<?php
require_once "db/conexion.php";
class Nota
{
    private $id;
    private $titulo;
    private $contenido;
    private $fecha_creacion;
    private $usuario_id;

    public function __construct($titulo, $contenido, $usuario_id, $fecha_creacion = null)
    {
        
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha_creacion = $fecha_creacion;
        $this->usuario_id = $usuario_id;
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

    public function insertarNota($pdo)
    {
        try {
            $sql = "INSERT INTO notas (titulo, contenido, usuario_id) VALUES(:titulo, :contenido, :usuario_id)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":titulo", $this->titulo);
            $stmt->bindParam(":contenido", $this->contenido);
            $stmt->bindParam(":usuario_id", $this->usuario_id);

            $stmt->execute();

            echo "Nota insertada correctamente";
        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public static function listarNotas($pdo)
    {
        try {
            $sql = "SELECT id, titulo, usuario_id FROM notas LIMIT 50";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $notas;

        } catch (PDOException $error) {
            echo "Error en el select de listar notas" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    // recuperar nota
    public static function verNota($pdo, $id) {
        try {
            $sql = "SELECT id, titulo, contenido, fecha_creacion, usuario_id FROM notas WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            $nota = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($nota) {
                return $nota;
            } else {
                return null;
            }

        } catch (PDOException $error) {
            echo "Error al ver la nota." . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function actualizarNota($pdo) {
        try {    
            // Si existe, actualizamos
            $sql = "UPDATE notas SET titulo = :titulo, contenido = :contenido WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':contenido', $this->contenido);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            echo "Nota actualizada correctamente";
            return true;

        } catch (PDOException $error) {
            echo "Error al actualizar la nota: " . $error->getMessage();
            return false;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function borrarNota ($pdo) {
        try {
            // Si existe, borramos
            $sql = "DELETE FROM notas WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            echo "Nota borrada correctamente";
            return true;
            
        } catch (PDOException $error) {
            echo "Error al borrar la nota: " . $error->getMessage();
            return false;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
}
?>