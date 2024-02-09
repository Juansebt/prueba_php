<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Venta {
    private $idVenta;
    private $productoVenta;
    private $clienteVenta;
    private $cantidadProductoVenta;
    private $totalVenta;
    private $observacionVenta;
    private $conexion;

    /**
     * Función para obtener la conexión a la base de datos e inicializar el objeto de la clase venta
     */
    function __construct() {
        $this->conexion = new \Conexion();
    }

    /**
     * Función que ejecuta la consulta para obtener todos los registros de la tabla venta,
     * no trae los registros de las tablas asociadas a la tabla venta
     * @return array|string
     */
    function getVentas() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM venta");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener las ventas: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para obtener todos los registros de las ventas
     * junto con los registros de las tablas asociadas, y los ordena por el id de la venta
     * @return array|string
     */
    function getVentasProductos() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM venta INNER JOIN cliente ON venta.clienteVenta = cliente.idCliente INNER JOIN producto ON venta.productoVenta = producto.idProducto INNER JOIN tipo_producto ON producto.tipoProducto = tipo_producto.idTipoProducto INNER JOIN fabrica ON tipo_producto.fabricaTipoProducto = fabrica.idFabrica ORDER BY idVenta");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener las ventas: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para obtener los datos de un registro de
     * una venta de acuerdo a su id
     * @return array|string
     */
    function getVentasById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM venta INNER JOIN cliente ON venta.clienteVenta = cliente.idCliente INNER JOIN producto ON venta.productoVenta = producto.idProducto INNER JOIN tipo_producto ON producto.tipoProducto = tipo_producto.idTipoProducto INNER JOIN fabrica ON tipo_producto.fabricaTipoProducto = fabrica.idFabrica WHERE idVenta=?");
            $query->bindParam(1, $this->idVenta);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener la venta por el id: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para registrar una venta en la base de datos
     * @return string
     */
    function create() {
        try {
            $this->conexion->getConection()->beginTransaction();

            $query = $this->conexion->getConection()->prepare("INSERT INTO venta(productoVenta, clienteVenta, cantidadProductoVenta, totalVenta, observacionVenta) VALUES (?, ?, ?, ?, ?)");
            $query->bindParam(1, $this->productoVenta);
            $query->bindParam(2, $this->clienteVenta);
            $query->bindParam(3, $this->cantidadProductoVenta);
            $query->bindParam(4, $this->totalVenta);
            $query->bindParam(5, $this->observacionVenta);
            $query->execute();

            $this->conexion->getConection()->commit();
            return "La venta se ha registrado con exito";
        } catch (PDOException $e) {
            $this->conexion->getConection()->rollBack();
            return "Error al registrar la venta: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para actualizar un registro de una venta
     * @return string
     */
    function update() {
        try {
            $this->conexion->getConection()->beginTransaction();

            $query = $this->conexion->getConection()->prepare("UPDATE venta SET productoVenta=?, clienteVenta=?, cantidadProductoVenta=?, totalVenta=?, observacionVenta=? WHERE idVenta=?");
            $query->bindParam(1, $this->productoVenta);
            $query->bindParam(2, $this->clienteVenta);
            $query->bindParam(3, $this->cantidadProductoVenta);
            $query->bindParam(4, $this->totalVenta);
            $query->bindParam(5, $this->observacionVenta);
            $query->bindParam(6, $this->idVenta);
            $query->execute();

            $this->conexion->getConection()->commit();
            return "Se ha actualizado correctamente el registro de la venta";
        } catch (PDOException $e) {
            $this->conexion->getConection()->rollBack();
            return "Error al actualizar el registro de la venta: ". $e->getMessage();
        }
    }

    /**
     * Función que ejecuta la consulta para eliminar un registro de la tabla venta
     * @return string
     */
    function delete() {
        try {
            $this->conexion->getConection()->beginTransaction();

            $query = $this->conexion->getConection()->prepare("DELETE FROM venta WHERE idVenta=?");
            $query->bindParam(1, $this->idVenta);
            $query->execute();

            $this->conexion->getConection()->commit();
            return "Se ha eliminiado correctamente el registro de la venta";
        } catch (PDOException $e) {
            $this->conexion->getConection()->rollBack();
            return "Error al eliminar el registro de la venta: ". $e->getMessage();
        }
    }

    /**
     * Get the value of idVenta
     */
    public function getIdVenta() {
        return $this->idVenta;
    }

    /**
     * Set the value of idVenta
     */
    public function setIdVenta($idVenta): self {
        $this->idVenta = $idVenta;
        return $this;
    }

    /**
     * Get the value of productoVenta
     */
    public function getProductoVenta() {
        return $this->productoVenta;
    }

    /**
     * Set the value of productoVenta
     */
    public function setProductoVenta($productoVenta): self {
        $this->productoVenta = $productoVenta;
        return $this;
    }

    /**
     * Get the value of clienteVenta
     */
    public function getClienteVenta() {
        return $this->clienteVenta;
    }

    /**
     * Set the value of clienteVenta
     */
    public function setClienteVenta($clienteVenta): self {
        $this->clienteVenta = $clienteVenta;
        return $this;
    }

    /**
     * Get the value of cantidadProductoVenta
     */
    public function getCantidadProductoVenta() {
        return $this->cantidadProductoVenta;
    }

    /**
     * Set the value of cantidadProductoVenta
     */
    public function setCantidadProductoVenta($cantidadProductoVenta): self {
        $this->cantidadProductoVenta = $cantidadProductoVenta;
        return $this;
    }

    /**
     * Get the value of totalVenta
     */
    public function getTotalVenta() {
        return $this->totalVenta;
    }

    /**
     * Set the value of totalVenta
     */
    public function setTotalVenta($totalVenta): self {
        $this->totalVenta = $totalVenta;
        return $this;
    }

    /**
     * Get the value of observacionVenta
     */
    public function getObservacionVenta() {
        return $this->observacionVenta;
    }

    /**
     * Set the value of observacionVenta
     */
    public function setObservacionVenta($observacionVenta): self {
        $this->observacionVenta = $observacionVenta;
        return $this;
    }
}