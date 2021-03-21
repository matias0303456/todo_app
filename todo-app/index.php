<?php
session_start();

require_once './autoload.php';
require_once './config/parameters.php';
require_once 'helpers/utils.php';
require_once './config/connection.php';

include 'views/layout/header.php';


function show_error(){
    $error = new errorController();
    $error->error();
}


if(isset($_GET['controller'])){

    $controller_name = $_GET['controller'].'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

    $controller_name = default_controller;

}else{

    show_error();

}

if(class_exists(($controller_name))){

    $controller = new $controller_name();

    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){

        $action = $_GET['action'];
        $controller->$action();

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

        $action = default_action;
        $controller->$action();

    }else{
    
        show_error();

    }

}else{

    show_error();

}


include 'views/layout/footer.php';