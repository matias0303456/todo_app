<?php

class User{

    public $id;
    public $email;
    public $nickname;
    public $password;
    public $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }

    function getEmail(){
        return $this->email;
    }

    function getNickname(){
        return $this->nickname;
    }

    function getPassword(){
        return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setId($id){
        $this->id = $id;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setNickname($nickname){
        $this->nickname = $this->db->real_escape_string($nickname);
    }

    function setPassword($password){
        $this->password = $password;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function verifyEmail($email){

        $email = $this->email;
        $user_exists = true;

        $sql_email = "SELECT * FROM users WHERE email = '$email';";
        $verify_email = $this->db->query($sql_email);

        if($verify_email->num_rows == 0){
            $user_exists = false;
        }

        return $user_exists;

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function create(){

        $sql = "INSERT INTO users VALUES (NULL, '{$this->getEmail()}', '{$this->getNickname()}', '{$this->getPassword()}');";
        $save = $this->db->query($sql);

        if($save){
            return $save;
        }

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function login(){

        $email = $this->email;
        $password = $this->password;

        $sql = "SELECT * FROM users WHERE email = '$email';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $user = $login->fetch_object();

            $verified_password = password_verify($password, $user->password);

            if($verified_password){
                return $user;
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update(){

        $id = $this->id;
        $email = $this->email;
        $nickname = $this->nickname;

        $sql = "UPDATE users SET email = '$email', nickname = '$nickname', password = '{$this->getPassword()}' WHERE id = '$id'";
        $update_user = $this->db->query($sql);

        if($update_user){
            return $update_user;
        }

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get_user(){
        
        $id = $this->id;
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $user = $this->db->query($sql);
        return $user->fetch_object();

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete(){

        $result = false;
        $id = $this->id;
        $sql = "DELETE FROM users WHERE id = '$id';";
        $delete_user = $this->db->query($sql);

        if($delete_user){
            $result = true;
        }
        return $result;

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function password_recover(){

    }

} // MODEL END