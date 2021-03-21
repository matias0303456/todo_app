<?php if(isset($edit) && isset($edit_todo) && is_object($edit_todo)): ?>

    <?php if(isset($_SESSION['edit']) && $_SESSION['edit'] == 'failed'): ?>
        <strong class="fail">Error al editar la tarea</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('edit'); ?>

    <h2>Editar tarea</h2>

    <form action="<?=base_url?>tareas/update_todo&id=<?=$id?>" method="post">

        <label for="content">Contenido</label>
        <input type="text" name="content" value="<?=$edit_todo->content?>" required>
        
        <input type="submit" value="Actualizar">

    </form>

    <button><a href="<?=base_url?>tareas/lista_de_tareas">Cancelar</a></button>



<?php else: ?>

    <?php if(isset($_SESSION['create']) && $_SESSION['create'] == 'failed'): ?>
        <strong class="fail">Error al crear la tarea</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('create'); ?>
    

    <h2>Crear nueva tarea</h2>
    
    <form action="<?=base_url?>tareas/create_todo" method="post">

        <label for="content">Contenido</label>
        <input type="text" name="content" placeholder="Escribe tu nueva tarea" required>
        
        <input type="submit" value="Guardar">

    </form>

    <button><a href="<?=base_url?>tareas/lista_de_tareas">Cancelar</a></button>

<?php endif; ?>

