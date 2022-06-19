<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>

    <?php
        $entrada_actual = conseguirEntrada($db, $_GET['id']);
        // if(!isset($entrada_actual['id'])){
        //     header('location: index.php');
        // }
    ?>

<!-- Contenido Principal -->
<div id="principal">
            <h1>Editar Entradas</h1>
            <br>
            <p>Edita la entrada actual</p>
            <br>
            <form action="guardarEntrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
                <!-- TITULO DE LA ENTRADA -->
                <label for="titulo" class="entradaLabel">Titulo</label>
                <input type="text" id="entradaTitulo" name="titulo" value="<?=$entrada_actual['titulo']?>">
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ""; ?>
                
                <!-- DESCRIPCION DE LA ENTRADA -->
                <label for="desc" class="entradaLabel">Descripcion</label>
                <textarea name="desc" cols="60" rows="10"><?=$entrada_actual['descripcion']?></textarea>
                <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ""; ?>
                
                <!-- SELECCIONAR LA CATEGORIA -->
                <label for="categoria" class="entradaLabel">Categoria</label>
                <select name="categoria">
                    <?php $categorias = conseguirCategorias($db);
                        if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                                                             <!-- Operador ternario para seleccionar la categoria automaticamente -->
                        <option value="<?=$categoria['id']?>"<?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
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