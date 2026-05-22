<?php
require_once __DIR__ . "/../src/Repositories/UserRepository.php";
// require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../src/Entities/User.php";

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
if($user && password_verify($password, $user->getPassword()) && $user->getEmail() == $email && trim($user->getRole()) == trim($role))    
  {     $_SESSION['user'] = $user->getName();
        $_SESSION['user_id'] = $user->getId();  
    $_SESSION['role'] = $user->getRole();

//     echo "Bienvenue". $user->name;
//     // echo $user->name;
// echo $user->email;
$_SESSION['message'] = "bienvenu".$user->getName();
    header('Location: ../public/dashboard.php');
    exit;
    
    
} else {
    // echo "Email ou mot de passe incorrect";
    
    
$_SESSION['error'] = "Email ou mot de passe incorrect";
    header("Location:../public/index.php");
    exit;
}
?>