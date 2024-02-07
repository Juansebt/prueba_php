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

    function __construct() {
        $this->conexion = new \Conexion();
    }

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

    function getVentasById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM venta WHERE idVenta=?");
            $query->bindParam(1, $this->idVenta);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener la venta por el id: ". $e->getMessage();
        }
    }

    function create() {
        try {
            $query = $this->conexion->getConection()->prepare("INSERT INTO venta(productoVenta, clienteVenta, cantidadProductoVenta, totalVenta, observacionVenta) VALUES (?, ?, ?, ?, ?)");
            $query->bindParam(1, $this->productoVenta);
            $query->bindParam(2, $this->clienteVenta);
            $query->bindParam(3, $this->cantidadProductoVenta);
            $query->bindParam(4, $this->totalVenta);
            $query->bindParam(5, $this->observacionVenta);
            $query->execute();
            return "La venta se ha registrado con exito";
        } catch (PDOException $e) {
            return "Error al registrar la venta: ". $e->getMessage();
        }
    }

    function update() {
        try {
            $query = $this->conexion->getConection()->prepare("UPDATE venta SET productoVenta=?, clienteVenta=?, cantidadProductoVenta=?, totalVenta=?, observacionVenta=? WHERE idVenta=?");
            $query->bindParam(1, $this->productoVenta);
            $query->bindParam(2, $this->clienteVenta);
            $query->bindParam(3, $this->cantidadProductoVenta);
            $query->bindParam(4, $this->totalVenta);
            $query->bindParam(5, $this->observacionVenta);
            $query->bindParam(6, $this->idVenta);
            $query->execute();
            return "Se ha actualizado correctamente el registro de la venta";
        } catch (PDOException $e) {
            return "Error al actualizar el registro de la venta: ". $e->getMessage();
        }
    }

    function delete() {
        try {
            $query = $this->conexion->getConection()->prepare("DELETE FROM venta WHERE idVenta=?");
            $query->bindParam(1, $this->idVenta);
            $query->execute();
            return "Se ha eliminiado correctamente el registro de la venta";
        } catch (PDOException $e) {
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