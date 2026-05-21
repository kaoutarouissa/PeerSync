<?php
// require_once "User.php";
require_once __DIR__ . "/../Entities/User.php";
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
            if(!$usermail){
            return null;
        }
        return new User(
            $usermail->id,
    $usermail->name,
    $usermail->password,
    $usermail->role,
    $usermail->email

        );

    }

     public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute([$id]);

        return $stm->fetch(PDO::FETCH_OBJ);
    }
}
?>
