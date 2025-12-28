<?php

class Book {
    public int $id;
    public string $title;
    public string $author;
    public int $year;
    public string $status;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->title = $data['title'] ?? '';
        $this->author = $data['author'] ?? '';
        $this->year = $data['year'] ?? 0;
        $this->status = $data['status'] ?? 'available';
    }

    // Check if book is available
    public function isAvailable(): bool {
        return $this->status === 'available';
    }
}
?>
