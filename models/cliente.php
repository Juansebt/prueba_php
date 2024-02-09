<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Cliente {
    private $idCliente;
    private $nombreCliente;
    private $conexion;

    /**
     * Función para obtener la conexión a la base de datos e inicializar el objeto de la clase cliente
     */
    function __construct() {
        $this->conexion = new \Conexion();
    }

    /**
     * Función que ejecuta la consulta para obtener todos los registros de la tabla cliente
     * @return array|string
     */
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

    /**
     * Función que ejecuta la consulta para obtener los datos de un cliente
     * de acuerdo a su id
     * @return array|string
     */
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