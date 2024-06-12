<?php

require_once('./modelo/Categoria_MDL.php');
require_once('./cad/Categoria_CAD.php');

$objCategCAD = new CategoriaCAD();
$categorias = $objCategCAD->listarCategorias();
