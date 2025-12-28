<?php  


require_once __DIR__ . "/../Config/Connection.php";

require_once __DIR__ . '/User.php';

class Admin extends User {

// manage the books(crud);

public function addBook($data){

$stmt = $this->pdo->prepare(

"INSERT INTO books (title , author ,year , status) 
VALUES(?, ?, ?, 'available')"
);
return $stmt->execute([

$data['title'],
$data['author'],
$data['year'],

]);
}

//Update book info
public function updateBook($bookId , $data){

$stmt = $this->pdo->prepare(
"UPDATE books
SET title = ? , author = ? , year = ?
WHERE id = ? "
);

return $stmt->execute([
$data['title'],
$data['author'],
$data['year'],
$bookId
]);
}

//delete a book

public function deleteBook($bookId){

$stmt = $this->pdo->prepare(
"DELETE FROM books WHERE id = ?"
);

return $stmt->execute([$bookId]);


}

//this for getting all the books 

public function getAllBooks(){

$stmt = $this->pdo->query(
"SELECT * FROM books ORDER BY title Asc"

);

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function getAllBorrows(){

$stmt = $this->pdo->query(

"SELECT br.* , u.firstName , u.lastName , bk.title 
 FROM borrows br 
 JOIN users u ON br.readerId = u.id 
 JOIN books bk ON br.bookId = bk.id 
 ORDER BY br.borrowDate DESC"
);

return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}