<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Blog de Videojuegos</title>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>
        </div>
    <!-- Menu -->
    <nav id="nav">
        <ul>
            <li> <a href="index.php">Inicio</a> </li>

            <!-- Se llama a la funcion para sacar la lista de categorias de la DB -->
            <?php $categorias = conseguirCategorias($db); 
                if (!empty($categorias)): ?>
                    <!-- Mientras halla filas para sacar se crea un LI con los datos de la id y el nombre -->
                    <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
                    <?php endwhile;
                endif; ?>    

            <li> <a href="index.php">About me</a> </li>
            <li> <a href="index.php">Contacto</a> </li>
        </ul>
    </nav>
    </header>

    <div id="container">
