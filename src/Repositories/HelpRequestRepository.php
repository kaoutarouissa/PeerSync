<?php

class HelpRequestRepository
{
    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($helpRequest, $user_id)
    {
        $sql = "INSERT INTO help_requests
                (title, description, technologie, status, id_student)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([

            $helpRequest->getTitle(),

            $helpRequest->getDescription(),

            $helpRequest->getTechnologie(),

            $helpRequest->getStatus()->value,

            $user_id
        ]);
    }
}