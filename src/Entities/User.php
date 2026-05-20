<?php
// require_once 
class User{
    private $id;
    private $name;
    private $password;
    private $role;
    private $email;
    public function __construct($id, $name, $password, $role, $email){
        $this->id=$id;
        $this->name=$name;
        $this->password=$password;
        $this->role=$role;
        $this->email=$email;
    }
      public function getName() {
        return $this->name;
    }
      public function getEmail() {
        return $this->email;
    }
    public function getId() {
        return $this->id;
    }
       public function getPassword(){
       return $this->password;
    }
    public function getRole(){
        return $this->role;
    }

}
?>