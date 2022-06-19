<?php require_once "helpers.php"; ?>

<aside id="sidebar">
    <!-- Barra de busqueda----------------------------------------------------------------------------------- -->
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="buscador" class="block-aside">
            <form action="buscador.php" method="POST">
                <label for="buscador">Buscar: </label>
                <input type="text" name="buscador">
                <input type="submit" value="Buscar">
            </form>
        </div>
    <?php endif; ?>

    <!-- Formulario de login-------------------------------------------------------------------------------- -->
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="block-aside">
            <h3>Usuario: <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']?></h3>
            <!-- Botones -->
            <a href="crearEntrada.php" class="boton">Nueva entrada</a>
            <a href="crearCategoria.php" class="boton">Crear categoria</a>
            <a href="modificarUserData.php" class="boton-verde">Modificar datos</a>
            <a href="mostrarUsu.php" class="boton-verde">Mostrar lista de usuarios</a>
            <a href="cerrarSesion.php" class="boton-naranja">Cerrar Sesión</a>
        </div>
    <?php endif; ?>


    <?php if(!isset($_SESSION['usuario'])): ?>
    <div id="login" class="block-aside">
        <h3>Identificate</h3>
        
        <?php if(isset($_SESSION['error_login'])): ?>
        <div class="alerta alerta-danger">
            <h3><?=$_SESSION['error_login']?></h3>
        </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Login">
        </form>
    </div>

    <!-- Formulario de registro-------------------------------------------------------------------------------- -->
        <div id="registro" class="block-aside">
        <h3>Registrate</h3>
        <?php if (isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?=$_SESSION['completado']?>
            </div>
        <?php elseif (isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-danger">
                <?=$_SESSION['errores']['general']?>
            </div>
        <?php endif; ?>


        <form action="registro.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ""; ?>
            
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ""; ?>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ""; ?>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ""; ?>
            
            <input type="submit" name="submit" value="Registrarse">
        </form>

        <?php borrarErrores(); ?>
        <?php borrarErrorLogin(); ?>
    
        </div>
        <?php endif; ?>

</aside>