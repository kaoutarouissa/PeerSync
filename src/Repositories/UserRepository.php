<?php

class UserRepository {
    private $conn;
    public function __construct($conn) {    
        $this->conn = $conn;
    }
    public function getUserByemail($email) {
        $sql="select * from users where email=?";
        $stm=$this->conn->prepare($sql);
        $stm->execute([$email]);
        $usermail=$stm->fetch(PDO::FETCH_OBJ);
        return $usermail;

    }

     public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute([$id]);

        return $stm->fetch(PDO::FETCH_OBJ);
    }
}
?>
