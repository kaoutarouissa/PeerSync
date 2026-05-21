<?php
require_once __DIR__ . "/../src/Repositories/UserRepository.php";
// require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/Database.php";

session_start();
$db = new Connection();
$conn = $db->connect();


$userRepo = new UserRepository($conn);

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$user = $userRepo->getUserByemail($email);
// echo $user;
// foreach($user as $key => $value){
//     echo $key . " : " . $value . "<br>";
// } 
if($user && trim($user->password) == trim($password) && $user->email == $email && trim($user->role) == trim($role))    
  {  $_SESSION['user'] = $user->name;

//     echo "Bienvenue". $user->name;
//     // echo $user->name;
// echo $user->email;
$_SESSION['message'] = "bienvenu".$user->name;
    header('Location: ../public/dachboard.php');
    exit;
    
    
} else {
    // echo "Email ou mot de passe incorrect";
    
    
$_SESSION['error'] = "Email ou mot de passe incorrect";
    header("Location:../public/index.php");
    exit;
}
?>