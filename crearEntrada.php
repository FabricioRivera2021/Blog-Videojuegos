<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>


<!-- Contenido Principal -->
<div id="principal">
            <h1>Crear Entradas</h1>
            <br>
            <p>Añade nuevas entradas al blog para que los usuarios puedan leer el maravilloso y amazing contenido de nuestro blog... ponele</p>
            <br>
            <form action="guardarEntrada.php" method="POST">
                <!-- TITULO DE LA ENTRADA -->
                <label for="titulo" class="entradaLabel">Titulo</label>
                <input type="text" id="entradaTitulo" name="titulo">
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ""; ?>
                
                <!-- DESCRIPCION DE LA ENTRADA -->
                <label for="desc" class="entradaLabel">Descripcion</label>
                <textarea name="desc" cols="60" rows="10"></textarea>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ""; ?>
                
                <!-- SELECCIONAR LA CATEGORIA -->
                <label for="categoria" class="entradaLabel">Categoria</label>
                <select name="categoria">
                    <?php $categorias = conseguirCategorias($db);
                        if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                        <option value="<?=$categoria['id']?>">
                            <?=$categoria['nombre']?>
                        </option>
                    <?php
                        endwhile;
                        endif;
                    ?>
                </select>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ""; ?>
                
                <input type="submit" value="Guardar">
            </form>
            
            

        </div>
<?php require_once 'includes/barra_lateral.php' ?>

<!-- Footer -->
<?php require_once 'includes/footer.php' ?>
