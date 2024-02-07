<?php 
class Conexion {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "prueba";
    private $con;

    public function __construct() {
        try {
            $this->con = new PDO("mysql:dbname=$this->database;host=$this->host",$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            // throw new Exception("",0, $e);
            echo "Error: ". $e->getCode() ."Message: ". $e->getMessage();
        }
    }

    /**
     * Get the value of conection
     */
    public function getConection() {
        return $this->con;
    }
}