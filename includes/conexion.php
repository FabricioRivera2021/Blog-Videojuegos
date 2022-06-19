<?php
//Conexion a la base de datos
//Variables de la conexion
$server = "localhost";
$username = "root";
$password = "";
$database = "blog_prueba";
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

//iniciar la session
if (!isset($_SESSION)){
    session_start();
}