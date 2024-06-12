<?php
class ConeccionDB
{
    public function conectarMysql()
    {
        return new mysqli('localhost','root','','administrador_educativo',3306);
    }
}

// Probar coneccion
// $con = ConeccionDB::conectarMysql();
// if($con){
//     echo 'conectado!!!';
// }
