<?php
require_once 'includes/conexion.php';

if(isset($_SESSION['usuario'])){
    $usuario_id = $_SESSION['usuario']['id'];
    $entrada_id = $_GET['id'];
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";

    mysqli_query($db, $sql);
}

header('location: index.php');