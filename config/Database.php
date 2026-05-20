<?php
class Connection{
private $servername;
private $username;
private $password;
private $dbname;
public function connect(){
    $this->servername="localhost";
    $this->username="root";
    $this->password="";
    $this->dbname="Peersync";
    $conn=new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if($conn->connect_error){
        die("Pas de connextion : ". $conn->connect_error);
    }
    return $conn;
}
}
?>