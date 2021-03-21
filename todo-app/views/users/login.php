<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'completed'): ?>
    <strong class="success">Registro realizado exitosamente</strong>
<?php Utils::deleteSession('register'); ?>
<?php elseif(isset($_SESSION['login']) && $_SESSION['login'] == 'failed'): ?>
    <strong class="fail">El usuario no existe o los datos ingresados son incorrectos</strong>
<?php endif; ?>
<?php Utils::deleteSession('login'); ?>

<?php if(isset($_SESSION['edit']) && $_SESSION['edit'] == 'completed'): ?>
        <strong class="success">Usuario actualizado con éxito</strong>
<?php endif; ?>
<?php Utils::deleteSession('edit'); ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
        <strong class="succes">La cuenta ha sido eliminada</strong>
    <?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<h2>Iniciar sesión</h2>

<form action="<?=base_url?>usuarios/login" method="post">

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <input type="submit" value="Iniciar sesión">

</form>

<p>¿No tienes cuenta? <a href="<?=base_url?>usuarios/registro">Registrarse</a></p>