<?php

require_once "../config/Database.php";

$db = new Connection();
$conn = $db->connect();

$request_id = $_POST['request_id'];

$commentaire = $_POST['commentaire'];

$sql = "UPDATE help_requests
        SET status = 'RESOLUE',
            commentaire = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->execute([
    $commentaire,
    $request_id
]);

header("Location: ../public/dashboard.php");
exit;