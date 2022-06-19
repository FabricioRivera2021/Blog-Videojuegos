<?php

if(isset($_POST)){
    //incluir la conexion a la base de datos
    require_once "includes/conexion.php";

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $desc = isset($_POST['desc']) ? mysqli_real_escape_string($db, $_POST['desc']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];

    //array de errores
    $error = array();

    //Validar los datos antes de guardarlos en la base de datos
    //Validar 
    if(!empty($titulo)){
        $titulo_valido = true;
    } else {
        $titulo_valido = false;
        $error['titulo'] = "el titulo no es valido";
    }

    
    if(!empty($desc)){
        $desc_valida = true;
    } else {
        $desc_valida = false;
        $error['descripcion'] = "la descripcion no es valido";
    }

    
    if(!empty($categoria) && is_numeric($categoria)){
        $categoria_valida = true;
    } else {
        $categoria_valida = false;
        $error['categoria'] = "la categoria no es valida";
    }

    //comprobar si no llegan errores
    //MODIFICAMOS ESTE ARCHIVO PARA QUE DEPENDIENDO DE LO QUE SE QUIERA HACER SE CREE UNA ENTRADA O SE ACTUALIZE UNA EXISTENTE
    if(count($error) == 0){
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];
            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$desc', categoria_id=$categoria
                    WHERE id = $entrada_id AND usuario_id = $usuario_id";
        } else {
            $sql = "INSERT INTO entradas VALUES(null, '$usuario', '$categoria', '$titulo', '$desc', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);

        //Redireccion al index
        header('location: index.php');
    } else {

        $_SESSION['errores_entrada'] = $error;
        if(isset($_GET['editar'])){
            header('location: editarEntrada.php?id='.$_GET['editar']);
        } else {
            header('location: crearEntrada.php');
        }
    }
}
