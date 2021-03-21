<?php

class Todo{

    public $id;
    public $user_id;
    public $content;
    public $created_at;
    public $completed;
    public $db;

    public function __construct(){
        $this->db = Database::connect();
        $this->user_id = $_SESSION['identity']->id;
    }

    function getId(){
        return $this->id;
    }

    function getUser_id(){
        return $this->user_id;
    }

    function getContent(){
        return $this->content;
    }

    function getCreated_at(){
        return $this->created_at;
    }

    function getCompleted(){
        return $this->completed;
    }

    function setId($id){
        $this->id = $id;
    }

    function setContent($content){
        $this->content = $content;
    }

    function setCreated_at($created_at){
        $this->created_at = $created_at;
    }

    function setCompleted(){
        $this->completed = false;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function create(){

        $sql = "INSERT INTO todos (user_id, content) VALUES ('{$this->getUser_id()}', '{$this->getContent()}');";
        $save = $this->db->query($sql);

        if($save){
            return $save;
        }

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function read(){

        $result = false;
        $user_id = $this->user_id;

        $sql = "SELECT * FROM todos WHERE user_id = '$user_id';";
        $read_todos = $this->db->query($sql);

        if($read_todos && $read_todos->num_rows > 0){
            $result = $read_todos->fetch_all();

        }
        return $result;

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update(){
        $sql = "UPDATE todos SET content = '{$this->getContent()}' WHERE id = '{$this->id}';";
        $save = $this->db->query($sql);

        if($save){
            return $save;
        }

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get_todo(){
        
        $id = $this->id;
        $sql = "SELECT * FROM todos WHERE id = '$id'";
        $todo = $this->db->query($sql);
        return $todo->fetch_object();

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete(){

        $result = false;
        $id = $this->id;
        $sql = "DELETE FROM todos WHERE id = '$id';";
        $delete_todo = $this->db->query($sql);

        if($delete_todo){
            $result = true;
        }
        return $result;

    }

} // MODEL END