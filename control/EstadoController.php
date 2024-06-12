<?php
require_once '../modelo/Estado.php';
require_once '../cad/EstadoCAD.php'; 


$objCAD = new EstadoCAD();
$estado = $objCAD->listar();


