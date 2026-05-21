<?php

require_once __DIR__ . '/../Enums/Status.php';

class HelpRequest
{
    private string $title;
    private string $description;
    private string $technologie;
    private Status $status ;
    public function __construct(
        string $title,
        string $description,
        string $technologie
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->technologie = $technologie;

        $this->status = Status::EN_ATTENTE;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTechnologie(): string
    {
        return $this->technologie;
    }
    public function resolve()
{
    $this->status = Status::RESOLUE;
}
}
?>