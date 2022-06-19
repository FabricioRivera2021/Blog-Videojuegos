<?php require_once 'includes/header.php'; ?>

        <!-- Contenido Principal -->
        <div id="principal">
            <?php
                $categoria = conseguirCategoria($db, $_GET['id']);
                if(!isset($categoria['id'])){
                    header('location: index.php');
                }
            ?>
            <h1>Entradas de <?=$categoria['nombre']?></h1>

            <?php
            //Empieza la magia de las ultimas entradas..
            $entradas = conseguirEntradas($db, false, $_GET['id'] );
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
                <br>
                <hr>
            <?php
                endwhile;
            else:
            ?>
                <br>
                <div class="alert">No Hay entradas para esta categoria</div>
            <?php
            endif;
            ?>
        </div>
        
        <!-- Sidebar -->
        <?php require_once 'includes/barra_lateral.php' ?>

    <!-- Footer -->
    <?php require_once 'includes/footer.php' ?>

</body>
</html>