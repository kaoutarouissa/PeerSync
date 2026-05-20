<?php
// require_once 
class User{
    private $id;
    private $name;
    private $password;
    private $role;
    public function __construct($id, $name, $password, $role){
        $this->id=$id;
        $this->name=$name;
        $this->password=$password;
        $this->role=$role;
    }
     public function getId() {
        echo "this user id :" . $this->id;
    }
       public function getPassword(){
       echo "this le password : ".$this->password;
    }
    public function getRole(){
        echo "this role of user :". $this->role;
    }

}
?>