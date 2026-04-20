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

    // Getters y setters no mágicos
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getContenido() {
        return $this->contenido;
    }
    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }
    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getFecha_actualizacion() {
        return $this->fecha_actualizacion;
    }
    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
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