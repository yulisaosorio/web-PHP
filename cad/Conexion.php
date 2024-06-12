<?php


class Conexion {
    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    private $mensaje;
    
    public function __construct() {
        $this->host = "localhost";
        $this->user = "root"; 
        $this->pass = "";
        $this->db = "administrador_educativo";
        $this->port = 3306;
        $this->mensaje = "";
        
    }
    
    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db, $this->port);
   
        //si logro conectar
        if ($conexion->connect_error) {
            $this->mensaje ="no se logro conectar: ". $conexion->connect_error;
            return null;
        } else {
            return $conexion;
        }
    }
    
    public  function getMensaje(){
    return $this->mensaje;
    }
}
/* //para ver si conecta la base de datos
$c = new Conexion();

if ($c->conectar()) {
    echo "funciona";
} else {
    echo $c->getMensaje();
}   */
