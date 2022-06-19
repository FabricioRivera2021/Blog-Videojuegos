<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>


<!-- Contenido Principal -->
<div id="principal">
        <h1>Modificar Datos del usuario</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alerta alerta-exito">
                <?=$_SESSION['success']?>
            </div>
        <?php elseif (isset($_SESSION['error']['general'])): ?>
            <div class="alerta alerta-danger">
                <?=$_SESSION['error']['general']?>
            </div>
        <?php endif; ?>

        <form action="actualizarUsuario.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?=$_SESSION['usuario']['nombre']?>">
            <?php echo isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'], 'nombre') : ""; ?>
            
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?=$_SESSION['usuario']['apellido']?>">
            <?php echo isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'], 'apellido') : ""; ?>
            
            <label for="email">Email....</label>
            <input type="email" name="email" id="email" value="<?=$_SESSION['usuario']['email']?>">
            <?php echo isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'], 'email') : ""; ?>
            
            <input type="submit" name="submit" value="Actualizar">
            <a href="index.php" class="boton-naranja">Salir</a>
        </form>
        <?php borrarErrorActualizacion() ?>
        <?php borrarSuccess() ?>
        <?php borrarError() ?>
        
        </div>

<?php require_once 'includes/barra_lateral.php' ?>

<!-- Footer -->
<?php require_once 'includes/footer.php' ?>