<?php
function mostrarError($errores, $campo){
    $alert = "";
    if (isset($errores[$campo]) && !empty($campo)){
        $alert = "<div class='alerta alerta-danger'>" . $errores[$campo] . "</div>";
    }
    return $alert;
}

//Estas 2 funciones no deberian de existir pero bueno
function borrarErrores(){
    $_SESSION['errores'] = null;
    unset($_SESSION['errores']);
}
function borrarErrorLogin(){
    $_SESSION['error_login'] = null;
    unset($_SESSION['error_login']);
}
function borrarErrorEntrada(){
    $_SESSION['errores_entrada'] = null;
}
function borrarErrorActualizacion(){
    $_SESSION['errores_actualizar'] = null;
}
function borrarSuccess(){
    $_SESSION['success'] = null;
}
function borrarError(){
    $_SESSION['error'] = null;
}


//Usa una consulta sql para obtener todas las consultas de la base de datos
function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1){//Si devuelve filas estas se guardan en un array
        $resultado = $categorias;
    } else {
        $resultado = "Error";
    }
    return $resultado;
}

function conseguirCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1){//Si devuelve filas estas se guardan en un array
        $resultado = mysqli_fetch_assoc($categorias);
    } else {
        $resultado = "Error";
    }
    return $resultado;
}

//funcion para ver las ultimas entradas del blog
//esta funcion tambien se utuliza para listar todas las entradas
//si no se le pasa un valor al parametro limit muestra todas
function conseguirEntradas($conexion, $limit = false, $categoria = null){
    $lim = "";
    $where = "";
    if($limit == true){
      //$sql = $sql."LIMIT 4" seria lo mismo que abajo concatenando el limit a la consulta sql
      $lim = "LIMIT 4";
      }
    if($categoria != null){
      //agregamos el where a la consulta sql
      $where = "WHERE entradas.categoria_id = $categoria";
    }
    
    $sql ="SELECT entradas.*, categorias.nombre AS 'categoria', CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS 'usuario' FROM entradas
          INNER JOIN categorias ON entradas.categoria_id = categorias.id
          INNER JOIN usuarios ON entradas.usuario_id = usuarios.id
          {$where}
          ORDER BY entradas.id DESC 
          {$lim}";


    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
    }
    return $resultado;
}


//funcion similar a conseguir entradas para buscar las estradas con la barra de busqueda
function buscarEntradas($conexion, $busqueda){    
    $sql ="SELECT entradas.*, categorias.nombre AS 'categoria', CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS 'usuario' FROM entradas
          INNER JOIN categorias ON entradas.categoria_id = categorias.id
          INNER JOIN usuarios ON entradas.usuario_id = usuarios.id
          WHERE entradas.titulo LIKE '%$busqueda%'
          ORDER BY entradas.id DESC ";

    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
    }
    return $resultado;
}


//Funcion para ver todos los usuarios que estan registrados en el blog
function mostrarUsuarios($conexion){
    $sql = "SELECT usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.fecha AS 'Fecha de registro', count(entradas.usuario_id) AS 'entradas' 
            FROM usuarios
            LEFT JOIN entradas ON usuario_id = usuarios.id
            GROUP BY usuarios.id";

    $usuarios = mysqli_query($conexion, $sql);

    $resultado = array();
    if($usuarios && mysqli_num_rows($usuarios) >= 1){
        $resultado = $usuarios;
    }
    return $resultado;
}


//funcion para conseguir una entrada en especifico
function conseguirEntrada($conexion, $id){
    $sql = "SELECT entradas.*, categorias.nombre as 'categoria', CONCAT(usuarios.nombre, ' ', usuarios.apellido) as 'usuario' FROM entradas
            INNER JOIN categorias ON entradas.categoria_id = categorias.id
            INNER JOIN usuarios ON entradas.usuario_id = usuarios.id
            WHERE entradas.id = $id;";

    $entrada = mysqli_query($conexion, $sql);
    $resultado = array();

    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;
}