<?php

// require_once "src/Entities/User.php";
require_once __DIR__ . "/../src/Entities/User.php"; 
$user = new User(1, "Ali", "xxx", "student");
// $user->getPassword("xxxxxx");
// استعمال getters
// echo "ID: " . $user->getId() . "<br>";
 echo $user->getRole() . "<br>";
echo $user->getPassword();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hi php</h1>
</body>
</html>