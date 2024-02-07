<?php
namespace modelo;

use PDOException;

include_once "conexion.php";

class Fabrica {
    private $idFabrica;
    private $nombreFabrica;
    private $conexion;

    function __construct() {
        $this->conexion = new \Conexion();
    }

    function getFabricas() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM fabrica");
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener las fabricas: ". $e->getMessage();
        }
    }

    function getFabricaById() {
        try {
            $query = $this->conexion->getConection()->prepare("SELECT * FROM fabrica WHERE idFabrica=?");
            $query->bindParam(1, $this->idFabrica);
            $query->execute();
            $response = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (PDOException $e) {
            return "Error al obtener la fabrica por el id: ". $e->getMessage();
        }
    }

    /**
     * Get the value of idFabrica
     */
    public function getIdFabrica() {
        return $this->idFabrica;
    }

    /**
     * Set the value of idFabrica
     */
    public function setIdFabrica($idFabrica): self {
        $this->idFabrica = $idFabrica;
        return $this;
    }

    /**
     * Get the value of nombreFabrica
     */
    public function getNombreFabrica() {
        return $this->nombreFabrica;
    }

    /**
     * Set the value of nombreFabrica
     */
    public function setNombreFabrica($nombreFabrica): self {
        $this->nombreFabrica = $nombreFabrica;
        return $this;
    }
}