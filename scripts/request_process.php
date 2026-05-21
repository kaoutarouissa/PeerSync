<?php

session_start();

require_once "../config/Database.php";
require_once "../src/Entities/HelpRequest.php";
require_once "../src/Repositories/HelpRequestRepository.php";

$db = new Connection();
$conn = $db->connect();

$helpRequest = new HelpRequest(

    $_POST['title'],

    $_POST['description'],

    $_POST['technologie']

);

$repo = new HelpRequestRepository($conn);

$repo->create($helpRequest, $_SESSION['user_id']);

header("Location: ../public/dashboard.php");
exit;