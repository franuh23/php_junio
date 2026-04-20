<?php
require_once "db/conexion.php";
class Nota
{
    private $id;
    private $titulo;
    private $contenido;
    private $fecha_creacion;
    private $fecha_actualizacion;
    private $usuario_id;

    public function __construct($id, $titulo, $contenido, $fecha_creacion, $fecha_actualizacion, $usuario_id)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_actualizacion = $fecha_actualizacion;
        $this->usuario_id = $usuario_id;
    }

    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        return "Propiedad '$propiedad' no encontrada";
    }

    public function __set($propiedad, $valor)
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        throw new Exception("Propiedad '$propiedad' no encontrada", 1);
    }

    public function insertarNota($pdo)
    {
        try {
            $sql = "INSERT INTO notas (titulo, contenido, fecha_creacion, fecha_actualizacion, usuario_id) 
        VALUES(:titulo, :contenido, :fecha_creacion, :fecha_actualizacion, :usuario_id)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":titulo", $this->titulo);
            $stmt->bindParam(":contenido", $this->contenido);
            $stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
            $stmt->bindParam(":fecha_actualizacion", $this->fecha_actualizacion);
            $stmt->bindParam(":usuario_id", $this->usuario_id);

            $stmt->execute();

        } catch (PDOException $error) {
            echo "Error en la inserción" . $error->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
        ;
    }

}
?>