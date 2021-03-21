<?php
require_once './models/Todo.php';

class tareasController{

    public function crear_nueva_tarea(){

        if(isset($_SESSION['identity'])){
            include './views/todos/create-update.php';
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function create_todo(){

        if(isset($_SESSION['identity'])){

            if(isset($_POST)){
                $content = $_POST['content'];
                $todo = new Todo();
                $todo->setContent($content);
                $todo_created = $todo->create();

                if($todo_created){
                    $_SESSION['create'] = 'completed';
                    header('Location:'.base_url.'tareas/lista_de_tareas');

                }else{
                    $_SESSION['create'] = 'failed';
                }
            }else{
                $_SESSION['create'] = 'failed';

            }
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function lista_de_tareas(){

        $todo_list = new Todo();
        $result = $todo_list->read();

        include './views/todos/todo-list.php';
        
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function editar_tarea(){

        if(isset($_SESSION['identity'])){

            if(isset($_GET)){

                $id = $_GET['id'];
                $edit = true;

                $todo = new Todo();
                $todo->setId($id);
                $edit_todo = $todo->get_todo();

                require_once './views/todos/create-update.php';

            }else{
                header('Location:'.base_url.'tareas/lista_de_tareas');
            }
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update_todo(){

        if(isset($_SESSION['identity'])){

            if(isset($_GET['id'])){

                $id = $_GET['id'];
                $content = $_POST['content'];
                
                $todo = new Todo();
                $todo->setId($id);
                $todo->setContent($content);
                $edit_todo = $todo->update();

                if($edit_todo){
                    $_SESSION['edit'] = 'completed';
                    header('Location:'.base_url.'tareas/lista_de_tareas');
                }else{
                    $_SESSION['edit'] = 'failed';
                }
            }else{
                $_SESSION['edit'] = 'failed';

            }
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function eliminar_tarea(){

        if(isset($_SESSION['identity'])){

            if($_GET){

                $id = $_GET['id'];
                $delete_todo = new Todo();
                $delete_todo->setId($id);
                $delete_todo->delete();

                if($delete_todo){
                    $_SESSION['delete'] = 'completed';

                }else{
                    $_SESSION['delete'] = 'failed';

                }
            }else{
                $_SESSION['delete'] = 'failed';

            }
            header('Location:'.base_url.'tareas/lista_de_tareas');
        
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

} // CONTROLLER END








