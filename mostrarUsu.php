<?php require_once 'includes/header.php'; ?>

        <!-- Contenido Principal -->
        <div id="principal">
            <h1>Entradas</h1>

            <?php
            //Empieza la magia de las ultimas entradas..
            $usuarios = mostrarUsuarios($db);
            echo '<article class="entrada">';
            echo '<table id="tabla">';
            echo '<tr><th>Nombre</th><th>Apellido</th><th>Email</th><th>Fecha de registro</th><th>Cantidad de entradas en el blog</th></tr>';
            if(!empty($usuarios)):
                while ($usuario = mysqli_fetch_assoc($usuarios)):
                    ?>
                    <!-- aqui irian las filas -->
                    <tr><td><?=$usuario['nombre']?></td><td><?=$usuario['apellido']?></td><td><?=$usuario['email']?></td><td><?=$usuario['Fecha de registro']?></td><td><?=$usuario['entradas']?></td></tr>
                    <?php
                endwhile;
            endif;
            echo '</table>';
            echo '</article>';
            //Aqui termina la magia de las entradas al blog
            ?>
            
        </div>
        
        <!-- Sidebar -->
        <?php require_once 'includes/barra_lateral.php' ?>

    <!-- Footer -->
    <?php require_once 'includes/footer.php' ?>

</body>
</html>