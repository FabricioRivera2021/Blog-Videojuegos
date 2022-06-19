<?php

if(isset($_POST)){
    //incluir la conexion a la base de datos
    require_once "includes/conexion.php";

    $categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($db, $_POST['categoria']) : false;

    //array de errores de formulario de registro
    $error = array();

    //Validar los datos antes de guardarlos en la base de datos
    //Validar nombre
    if(!empty($categoria) && !is_numeric($categoria) && !preg_match("/[0-9]/", $categoria)){
        $categoria_valida = true;
    } else {
        $categoria_valida = false;
        $error['categoria'] = "el nombre de la categoria no es valido";
    }

    //comprobar si no llegan errores
    if(count($error) == 0){
        $sql = "INSERT INTO categorias VALUES(null, '$categoria');";
        $guardar = mysqli_query($db, $sql);
    }
}

//Redireccion al index
header('location: index.php');