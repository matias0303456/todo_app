<?php

class Database{

    public static function connect(){
        $db = new mysqli('localhost', 'matias0303456', 'positivo2MaTiAs', 'todo_app');
        $db->query('set names utf8');

        return $db;
    }

}