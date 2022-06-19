<?php

//Recoger los valores del formulario de registro
if(isset($_POST)){
    //incluir la conexion a la base de datos
    require_once "includes/conexion.php";
    //Inciar una sesion
    if (!isset($_SESSION)){
        session_start();
    }

    //Para agregarle mas seguridad a la base de datos el tito victor recomienda usar mysqli_real_escape_string
    //y asi escapar simbolos especiales y comillas que puedan intentar cambiar la consulta sql
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $pass = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
}

//array de errores de formulario de registro
$error = array();

//Validar los datos antes de guardarlos en la base de datos
//Validar nombre
if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
    $nombre_validado = true;
} else {
    $nombre_validado = false;
    $error['nombre'] = "el nombre no es valido";
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

//validar contraseña
if(!empty($pass)){
    $password_validado = true;
} else {
    $password_validado = false;
    $error['password'] = "La contraseña esta vacía";
}

if (count($error) === 0){
    $insertUser = true;
    //cifrar la contraseña
    $passCypher = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>4]);
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$passCypher', CURDATE())";
    $guardar = mysqli_query($db, $sql);

    if ($guardar){
        $_SESSION['completado'] = "El registro se ha completado con exito";
    } else {
        $_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";
    }

} else {
    $_SESSION['errores'] = $error;
    header('location: index.php');
}

header('location: index.php');