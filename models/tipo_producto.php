<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Tipo_producto {
    private $idTipoProducto;
    private $nombreTipoProducto;
    private $fabricaTiposProducto;
    private $conexion;

    /**
     * Función para obtener la conexión a la base de datos e inicializar el objeto de la clase tipo_producto
     */
    function __construct() {
        $this->conexion = new \Conexion();
    }

    /**
     * Función que ejecuta la consulta para obtener todos los registros
     * de la tabla tipo_producto
     * @return array|string
     */
    function getTiposProductos() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM tipo_producto");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);  
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener los tipos de productos: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para obtener los datos de un registro
     * de la tabla tipo_producto de acuerdo a su id
     * @return array|string
     */
    function getTipoProductosById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM tipo_producto WHERE idTipoProducto=?");
            $query->bindParam(1, $this->idTipoProducto);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener el tipo de producto por el id: ". $e->getMessage();
        }
    }

    /**
     * Get the value of idTipoProducto
     */
    public function getIdTipoProducto() {
        return $this->idTipoProducto;
    }

    /**
     * Set the value of idTipoProducto
     */
    public function setIdTipoProducto($idTipoProducto): self {
        $this->idTipoProducto = $idTipoProducto;
        return $this;
    }

    /**
     * Get the value of nombreTipoProducto
     */
    public function getNombreTipoProducto() {
        return $this->nombreTipoProducto;
    }

    /**
     * Set the value of nombreTipoProducto
     */
    public function setNombreTipoProducto($nombreTipoProducto): self {
        $this->nombreTipoProducto = $nombreTipoProducto;
        return $this;
    }

    /**
     * Get the value of fabricaTiposProducto
     */
    public function getFabricaTiposProducto() {
        return $this->fabricaTiposProducto;
    }

    /**
     * Set the value of fabricaTiposProducto
     */
    public function setFabricaTiposProducto($fabricaTiposProducto): self {
        $this->fabricaTiposProducto = $fabricaTiposProducto;
        return $this;
    }
}