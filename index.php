<?php require_once 'includes/header.php'; 
//Como caso especial devo limpiar los posibles errores que se crearon al actualizar una entrada
borrarErrorEntrada();
?>
        <!-- Contenido Principal -->
        <div id="principal">
            <h1>Ultimas entradas</h1>
            <?php
            //Empieza la magia de las ultimas entradas..
            $entradas = conseguirEntradas($db, true);
            if(!empty($entradas)):
                while ($entrada = mysqli_fetch_assoc($entradas)):
            ?>
                <article class="entrada">
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                        <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha'].' | '.$entrada['usuario']?></span>
                        <p>
                            <?=$entrada['descripcion']?>
                        </p>
                    </a>
                </article>
            <?php
                endwhile;
            endif;
            //Aqui termina la magia de las entradas al blog
            ?>
            <div id="verTodas">
                <a href="entradas.php">Ver todas las entradas</a>
            </div>
        </div>
        
        <!-- Sidebar -->
        <?php require_once 'includes/barra_lateral.php' ?>

    <!-- Footer -->
    <?php require_once 'includes/footer.php' ?>

</body>
</html>