<?php

class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function generateToken(){

        $token = hash('md5', random_int(1, 2147483647));
        return $token;
    }

}