<?php
session_start();

require_once __DIR__ . "/../config/Database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php");
    exit;
}

$db = new Connection();
$conn = $db->connect();

$user_id = $_SESSION['user_id'];

if(isset($_POST['skills'])){

    foreach($_POST['skills'] as $skill_id){

        // avoid duplicates
        $check = $conn->prepare("SELECT * FROM users_skills WHERE id_user=? AND id_skill=?");  
      $check->execute([$user_id, $skill_id]);

        if($check->rowCount() == 0){

            $sql = "INSERT INTO users_skills (id_user, id_skill) VALUES (?, ?)";
            $stm = $conn->prepare($sql);
            $stm->execute([$user_id, $skill_id]);

        }
    }
header("Location: ../public/dachboard.php");
exit;
}