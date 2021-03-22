<?php if(isset($edit) && isset($edit_user) && is_object($edit_user)): ?>

    <?php if(isset($_SESSION['edit']) && $_SESSION['edit'] == 'failed'): ?>
        <strong>Error al actualizar datos de usuario</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('edit'); ?>

    <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
        <strong>Error al intentar eliminar cuenta</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('delete'); ?>

    <h2>Editar datos de usuario</h2>

    <form action="<?=base_url?>usuarios/update_user&id=<?=$id?>" method="post">

    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Introduce un e-mail válido" value="<?=$edit_user->email?>" required>

    <label for="nickname">Nombre de usuario</label>
    <input type="text" name="nickname" placeholder="Hasta 15 caracteres" value="<?=$edit_user->nickname?>" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" placeholder="Actual o nueva" required>

    <input type="submit" value="Actualizar">

    </form>

    <button><a href="<?=base_url?>usuarios/eliminar_usuario&id=<?=$id?>">Eliminar cuenta</a></button>
    <button><a href="<?=base_url?>tareas/lista_de_tareas">Cancelar</a></button>

<?php else: ?>

    <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'user exists'): ?>
        <strong class="fail">Este email ya está registrado</strong>
    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <strong class="fail">Error al registrarse, verifica los datos ingresados</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>

    <h2>Registrarse</h2>

    <form action="<?=base_url?>usuarios/create" method="post">

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Introduce un e-mail válido" required>

        <label for="nickname">Nombre de usuario</label>
        <input type="text" name="nickname" placeholder="Hasta 15 caracteres" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" placeholder="Al menos 8 caracteres" required>

        <input type="submit" value="Registrarse">

    </form>

    <p><a href="<?=base_url?>">Volver al inicio</a></p>

<?php endif; ?>

