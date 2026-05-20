<?php
 require_once __DIR__ . "/../config/database.php";

class UserRepository {
    private $conn;
    public function __construct($conn) {    
        $this->conn = $conn;
    }
    public function getUserByName($name) {
        $sql="select * from users where name=?";
        $stm=$this->conn->prepare($sql);
        $stm->execute([$name]);
        $username=$stm->fetch(PDO::FETCH_ASSOC);
        return $username;

    }

    public function getUserById($id) {
      $sql="select * from users where id=?";
        $stm=$this->conn->prepare($sql);
        $stm->execute([$id]);
        $userid=$stm->fetch(PDO::FETCH_ASSOC);
        return $userid;
    }
}
?>
