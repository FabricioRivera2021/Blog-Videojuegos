<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>


<!-- Contenido Principal -->
<div id="principal">
            <h1>Crear Categoria</h1>
            <br>
            <p>Añade nuevas categorias al post para que los usuarios puedan utilizarlas al crear sus entradas</p>
            <br>
            <form action="guardarCategoria.php" method="POST">
                <label for="categoria">Nombre de la categoria</label>
                <input type="text" name="categoria">
                <input type="submit" value="Guardar">
            </form>
            
        </div>
<?php require_once 'includes/barra_lateral.php' ?>

<!-- Footer -->
<?php require_once 'includes/footer.php' ?>