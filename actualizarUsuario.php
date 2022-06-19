<?php

if(isset($_POST)){
    //incluir la conexion a la base de datos
    require_once "includes/conexion.php";

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
    

    //errores al actualizar
    $error = array();

    //validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true; 
    } else {
        $nombre_validado = false;
        $error['nombre'] = "El nombre no es valido";
    }

    //Validar apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validado = true;
    } else {
        $apellido_validado = false;
        $error['apellido'] = "el apellido no es valido";
    }

    //validar email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    } else {
        $email_validado = false;
        $error['email'] = "el email no es valido";
    }
    
    //si no hay errores ejecutamos la validacion de la consulta sql
    if(count($error) == 0){
        //Comprobar que el email ya exite
        $usuario = $_SESSION['usuario'];
        $sql = "SELECT email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            $sql = "UPDATE usuarios SET 
                    nombre = '$nombre',
                    apellido = '$apellido',
                    email = '$email'
                    WHERE id = {$usuario['id']}";

            $actualizar = mysqli_query($db, $sql);
            if($actualizar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellido'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['success'] = "Datos actualizados";
            } else {
            }
        } else {
            $_SESSION['error']['general'] = "El usuario ya existe";
        }
    } else {
        $_SESSION['errores_actualizar'] = $error;
    }
}

//Redireccion al index
header('location: modificarUserData.php');