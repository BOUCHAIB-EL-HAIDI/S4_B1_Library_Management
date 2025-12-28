<?php
require_once __DIR__ . "/../Config/Connection.php";
require_once __DIR__ . '/User.php';

class Reader extends User {

    public function borrowBook(int $bookId): bool {

        // Only borrow if book is available
        $stmt = $this->pdo->prepare(
            "UPDATE books 
             SET status = 'borrowed' 
             WHERE id = ? AND status = 'available'"
        );

        if (!$stmt->execute([$bookId]) || $stmt->rowCount() === 0) {
            return false;
        }

        // Insert borrow record
        $stmt = $this->pdo->prepare(
            "INSERT INTO borrows (readerId, bookId, borrowDate)
             VALUES (?, ?, NOW())"
        );

        return $stmt->execute([$this->id, $bookId]);
    }

    public function returnBook(int $borrowId): bool {

        // Get bookId first
        $stmt = $this->pdo->prepare(
            "SELECT bookId FROM borrows WHERE id = ? AND readerId = ?"
        );
        $stmt->execute([$borrowId, $this->id]);
        $borrow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$borrow) {
            return false;
        }

        // Close borrow
        $stmt = $this->pdo->prepare(
            "UPDATE borrows SET returnDate = NOW() WHERE id = ?"
        );
        $stmt->execute([$borrowId]);

        // Update book status
        $stmt = $this->pdo->prepare(
            "UPDATE books SET status = 'available' WHERE id = ?"
        );

        return $stmt->execute([$borrow['bookId']]);
    }

    public function myBorrows(): array {

        $stmt = $this->pdo->prepare(
            "SELECT b.*, bk.title
             FROM borrows b
             JOIN books bk ON b.bookId = bk.id
             WHERE b.readerId = ?
             ORDER BY b.borrowDate DESC"
        );

        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
