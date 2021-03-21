<?php

function load_controller($classname){
    include './controllers/' . $classname . '.php';
}

spl_autoload_register('load_controller');
