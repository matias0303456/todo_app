<?php
require_once './models/User.php';

class usuariosController{

    public function registro(){
        require_once './views/users/register-update.php';
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function iniciar_sesion(){

        if(isset($_GET)){
            $token = Utils::generateToken();
            $_SESSION['token'] = $token;

        }
        require_once './views/users/login.php';

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function create(){

            if(isset($_POST)){

                $email = $_POST['email'];
                $nickname = $_POST['nickname'];
                $password = $_POST['password'];

                if($email && strlen($nickname)<15 && strlen($password)>=8){

                $user = new User();
                
                $user->setEmail($email);
                $user->setNickname($nickname);
                $user->setPassword($password);

                $user_exists = $user->verifyEmail($email);
                $result = $user->create();

                if($result){
                    $_SESSION['register'] = 'completed';
                    header('Location:'.base_url);

                }elseif($user_exists){
                    $_SESSION['register'] = 'user exists';
                    header('Location:'.base_url.'usuarios/registro');

                }elseif(!$result){
                    $_SESSION['register'] = 'failed';
                    header('Location:'.base_url.'usuarios/registro');

                }

            }else{
                $_SESSION['register'] = 'failed';

                header('Location:'.base_url.'usuarios/registro');

            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function login(){

        if(empty($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])){
            header('Location:'.base_url.'error/error');

        }else{
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);

            $identity = $user->login();

            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                header('Location:'.base_url.'tareas/lista_de_tareas');

            }else{
                $_SESSION['login'] = 'failed';
                header('Location:'.base_url);

            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function cerrar_sesion(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
            header('Location:'.base_url);

        }

        if(isset($_SESSION['token'])){
            unset($_SESSION['token']);
            header('Location:'.base_url);

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function editar_usuario(){

        if(isset($_SESSION['identity'])){

            if(isset($_GET)){
                $token = Utils::generateToken();
                $_SESSION['token'] = $token;
                $edit = true;
                $id = $_GET['id'];

                $user = new User();
                $user->setId($id);
                $edit_user = $user->get_user();

                require_once './views/users/register-update.php';

            }else{
                header('Location:'.base_url);

            }
        }else{
            header('Location:'.base_url.'error/error');

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update_user(){

        if(isset($_SESSION['identity'])){

            if(isset($_GET)){

                if(empty($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])){
                    header('Location:'.base_url.'error/error');

                }else{
                    $id = $_GET['id'];
                    $email = $_POST['email'];
                    $nickname = $_POST['nickname'];
                    $password = $_POST['password'];

                    $user = new User();
                    $user->setId($id);
                    $user->setEmail($email);
                    $user->setNickname($nickname);
                    $user->setPassword($password);
                    $edit_user = $user->update();

                    if($edit_user){
                        $_SESSION['edit'] = 'completed';
                        header('Location:'.base_url);
                    }else{
                        $_SESSION['edit'] = 'failed';
                    }
                }
            }
        }else{
            header('Location:'.base_url.'error/error');

        }
    }   

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function eliminar_usuario(){

        if(isset($_SESSION['identity'])){
            if($_GET){

                $id = $_GET['id'];
                $delete_user = new User();
                $delete_user->setId($id);
                $delete_user->delete();

                if($delete_user){
                    $_SESSION['delete'] = 'completed';

                }else{
                    $_SESSION['delete'] = 'failed';

                }
            }else{
                $_SESSION['delete'] = 'failed';

            }
            header('Location:'.base_url);

        }else{
            header('Location:'.base_url.'error/error');

        }
    }

} // CONTROLLER END