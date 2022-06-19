<?php
//Iniciar la sesion y la conexion
require_once 'includes/helpers.php';
require_once 'includes/conexion.php';

if(isset($_SESSION['error_login'])){//Borrar el error si habia alguno
    unset($_SESSION['error_login']);
}
//Recoger datos del formulario de login
if (isset($_POST)){
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    //Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if(mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login); //Guardar el resultado de la fila en una variable
        //comprobar la contraseña
        $verify = password_verify($pass, $usuario['password']);
        if($verify){
            //Utilizar la sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
        } else {
            //si algo falla enviar una sesion con el fallo
            $_SESSION['error_login'] = "Contraseña incorrecta";
        }
    } else {//Si no sale ninguna fila en la consulta o directamente no hay registro
        $_SESSION['error_login'] = "Login incorrecto";
    }
    
}

//redirigir al index
header('location: index.php');