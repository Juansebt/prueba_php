<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Cliente {
    private $idCliente;
    private $nombreCliente;
    private $conexion;

    function __construct() {
        $this->conexion = new \Conexion();
    }

    function getClientes() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM cliente");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener los clientes: ". $e->getMessage();
        }
    }

    function getClienteById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM cliente WHERE idCliente=?");
            $query->bindParam(1, $this->idCliente);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener el cliente por el id: ". $e->getMessage();
        }
    }

    /**
     * Get the value of idCliente
     */
    public function getIdCliente() {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     */
    public function setIdCliente($idCliente): self {
        $this->idCliente = $idCliente;
        return $this;
    }

    /**
     * Get the value of nombreCliente
     */
    public function getNombreCliente() {
        return $this->nombreCliente;
    }

    /**
     * Set the value of nombreCliente
     */
    public function setNombreCliente($nombreCliente): self {
        $this->nombreCliente = $nombreCliente;
        return $this;
    }
}