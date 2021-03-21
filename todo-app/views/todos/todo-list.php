<?php if(isset($_SESSION['identity'])): ?>

    <div id="todo-view">

        <nav id="user-menu">

            <strong>¡Hola, <?=$_SESSION['identity']->nickname?>!</strong>
            <ul>
                <li><a href="<?=base_url?>tareas/crear_nueva_tarea">Crear nueva tarea</a></li>
                <li><a href="<?=base_url?>usuarios/editar_usuario&id=<?=$_SESSION['identity']->id?>">Editar usuario</a></li>
                <li><a href="<?=base_url?>usuarios/cerrar_sesion">Cerrar sesión</a></li>
            </ul>

            </nav>

        <div id="anouncement">

            <?php if(isset($_SESSION['create']) && $_SESSION['create'] == 'completed'): ?>
                <strong class="success">Tarea creada exitosamente</strong>
            <?php endif; ?>
            <?php Utils::deleteSession('create'); ?>

            <?php if(isset($_SESSION['edit']) && $_SESSION['edit'] == 'completed'): ?>
                <strong class="success">Tarea editada exitosamente</strong>
            <?php endif; ?>
            <?php Utils::deleteSession('edit'); ?>

            <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
                <strong class="success">Tarea eliminada exitosamente</strong>
            <?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'completed'): ?>
                <strong class="fail">Error al intentar borrar la tarea</strong>
            <?php endif; ?>
            <?php Utils::deleteSession('delete'); ?>

        </div>

        <div class="clearfix"></div>


    <div id="todo-menu">
                
        <?php if(empty($result)): ?>
            <h2>No tienes tareas por hacer</h2>

        <?php else: ?>
            <h2>Lista de tareas</h2>

            <ul>
                <?php foreach($result as $indice => $todo): ?>
                    <li>
                    <button><a href="<?=base_url?>tareas/editar_tarea&id=<?=$todo[0]?>">Editar</a></button>
                    <button><a href="<?=base_url?>tareas/eliminar_tarea&id=<?=$todo[0]?>">Eliminar</a></button>
                    <span class="todo"><?=$todo[2]?></span>
                    <span class="date"><?=$todo[3]?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            
        <?php endif; ?>
    
    </div>

<?php else: ?>
<?php header('Location:'.base_url.'error/error');?>
<?php endif; ?>

