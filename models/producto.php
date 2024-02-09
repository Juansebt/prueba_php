<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Producto {
    private $idProducto;
    private $nombreProducto;
    private $codigoProducto;
    private $precioProducto;
    private $fechaFabricacionProducto;
    private $imagenProducto;
    private $tipoProducto;
    private $conexion;

    /**
     * Función para obtener la conexión a la base de datos e inicializar el objeto de la clase producto
     */
    function __construct() {
        $this->conexion = new \Conexion();
    }

    /**
     * Función que ejecuta la consulta para obtener todos los registros de la tabla productos
     * @return array|string
     */
    function getProductos() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM producto INNER JOIN tipo_producto ON producto.tipoProducto = tipo_producto.idTipoProducto");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener los productos: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para obtener los datos de un producto
     * de acuerdo a su id
     * @return array|string
     */
    function getProductoById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM producto WHERE idProducto=?");
            $query->bindParam(1, $this->idProducto);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener el producto por el id: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para obtener los datos de un producto
     * de acuerdo a su nombre
     * @return array|string
     */
    function getProductoByName() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM producto WHERE nombreProducto=?");
            $query->bindParam(1, $this->nombreProducto);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Errror al obtener el producto por el nombre: ". $e->getMessage();
        }
    }

    /**
     * Get the value of idProducto
     */
    public function getIdProducto() {
        return $this->idProducto;
    }

    /**
     * Set the value of idProducto
     */
    public function setIdProducto($idProducto): self {
        $this->idProducto = $idProducto;
        return $this;
    }

    /**
     * Get the value of nombreProducto
     */
    public function getNombreProducto() {
        return $this->nombreProducto;
    }

    /**
     * Set the value of nombreProducto
     */
    public function setNombreProducto($nombreProducto): self {
        $this->nombreProducto = $nombreProducto;
        return $this;
    }

    /**
     * Get the value of codigoProducto
     */
    public function getCodigoProducto() {
        return $this->codigoProducto;
    }

    /**
     * Set the value of codigoProducto
     */
    public function setCodigoProducto($codigoProducto): self {
        $this->codigoProducto = $codigoProducto;
        return $this;
    }

    /**
     * Get the value of precioProducto
     */
    public function getPrecioProducto() {
        return $this->precioProducto;
    }

    /**
     * Set the value of precioProducto
     */
    public function setPrecioProducto($precioProducto): self {
        $this->precioProducto = $precioProducto;
        return $this;
    }

    /**
     * Get the value of fechaFabricacionProducto
     */
    public function getFechaFabricacionProducto() {
        return $this->fechaFabricacionProducto;
    }

    /**
     * Set the value of fechaFabricacionProducto
     */
    public function setFechaFabricacionProducto($fechaFabricacionProducto): self {
        $this->fechaFabricacionProducto = $fechaFabricacionProducto;
        return $this;
    }

    /**
     * Get the value of imagenProducto
     */
    public function getImagenProducto() {
        return $this->imagenProducto;
    }

    /**
     * Set the value of imagenProducto
     */
    public function setImagenProducto($imagenProducto): self {
        $this->imagenProducto = $imagenProducto;
        return $this;
    }

    /**
     * Get the value of tipoProducto
     */
    public function getTipoProducto() {
        return $this->tipoProducto;
    }

    /**
     * Set the value of tipoProducto
     */
    public function setTipoProducto($tipoProducto): self {
        $this->tipoProducto = $tipoProducto;
        return $this;
    }
}