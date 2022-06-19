<?php require_once 'includes/header.php'; ?>

        <!-- Contenido Principal -->
        <div id="principal">
        <?php
                $entrada_actual = conseguirEntrada($db, $_GET['id']);
                // if(!isset($entrada_actual['id'])){
                //     header('location: index.php');
                // }
            ?>
            <h1>Titulo: <?=$entrada_actual['titulo']?></h1>
            <h2>Categoria: <?=$entrada_actual['categoria']?></h2>
            <p>Descripcion: <?=$entrada_actual['descripcion']?></p>
            <span class="fecha">Fecha: <?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario']?></span>
                
            <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
                <a href="editarEntrada.php?id=<?=$entrada_actual['id']?>" class="boton">Editar entrada</a>
                <a href="borrarEntrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-naranja">Borrar entrada</a>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <?php require_once 'includes/barra_lateral.php' ?>

    <!-- Footer -->
    <?php require_once 'includes/footer.php' ?>

</body>
</html>