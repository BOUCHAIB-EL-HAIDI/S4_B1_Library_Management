 CREATE DATABASE library ;


 USE library ;



--Create the user table 

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('reader','admin') NOT NULL
);

--Create the books table

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150) NOT NULL,
    year INT NOT NULL,
    status ENUM('available','borrowed') NOT NULL DEFAULT 'available'
);


--Create the borrow tables 