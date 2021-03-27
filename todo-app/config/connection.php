<?php

class Database{

    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'todo_app');
        $db->query('set names utf8');

        return $db;
    }

}
