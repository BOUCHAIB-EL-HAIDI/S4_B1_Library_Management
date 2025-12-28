# 📚 Library Management System

A simple library management system built with PHP, MySQL, and OOP principles.

## 🎯 Features

### For Readers
- Sign up and login
- Browse all available books
- Borrow available books
- Return borrowed books
- View personal borrowing history

### For Admins
- Add new books
- Edit existing books
- Delete books
- View all books in the library
- View all borrowing records from all readers

## 🛠️ Technologies Used

- **PHP** (Object-Oriented Programming)
- **MySQL** (Database)
- **PDO** (Database connection)
- **Tailwind CSS** (Styling)
- **Apache** (Web server with .htaccess)

## 📁 Project Structure

```
S4_B1_Library_Management/
│
├── Config/
│   └── Connection.php          # Database configuration
│
├── Controllers/
│   ├── about.php              # About page
│   ├── admin.php              # Admin dashboard (CRUD operations)
│   ├── books.php              # Display all books
│   ├── borrow.php             # Handle borrow/return logic
│   ├── contact.php            # Contact page
│   ├── home.php               # Homepage
│   ├── login.php              # Login logic
│   ├── logout.php             # Logout logic
│   ├── profile.php            # User profile & borrowing history
│   └── signup.php             # Registration logic
│
├── Models/
│   ├── User.php               # Abstract user class
│   ├── Reader.php             # Reader class (extends User)
│   ├── Admin.php              # Admin class (extends User)
│   └── Book.php               # Book class
│
├── Views/
│   ├── 404.view.php           # 404 error page
│   ├── about.view.php         # About page view
│   ├── admin.view.php         # Admin dashboard view
│   ├── books.view.php         # Books listing view
│   ├── contact.view.php       # Contact page view
│   ├── home.view.php          # Homepage view
│   ├── login.view.php         # Login form view
│   ├── profile.view.php       # Profile page view
│   └── signup.view.php        # Signup form view
│
├── Partials/
│   ├── header.php             # Header with navigation
│   └── footer.php             # Footer
│
├── Public/
│   ├── .htaccess              # URL rewriting rules
│   └── index.php              # Entry point
│
├── Router.php                  # Request routing
└── schema.sql                  # Database schema
```

## 🗄️ Database Schema

### users table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('reader','admin') NOT NULL
);
```

### books table
```sql
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150) NOT NULL,
    year INT NOT NULL,
    status ENUM('available','borrowed') NOT NULL DEFAULT 'available'
);
```

### borrows table
```sql
CREATE TABLE borrows (
    id INT AUTO_INCREMENT PRIMARY KEY,
    readerId INT NOT NULL,
    bookId INT NOT NULL,
    borrowDate DATETIME NOT NULL,
    returnDate DATETIME NULL,
    FOREIGN KEY (readerId) REFERENCES users(id),
    FOREIGN KEY (bookId) REFERENCES books(id)
);
```

## 🚀 Installation

### 1. Clone the repository
```bash
git clone https://github.com/yourusername/S4_B1_Library_Management.git
cd S4_B1_Library_Management
```

### 2. Create the database
```bash
mysql -u root -p
```

```sql
CREATE DATABASE library;
USE library;
SOURCE schema.sql;
```

### 3. Configure database connection
Edit `Config/Connection.php`:
```php
private $host = 'localhost';
private $user = 'root';
private $password = 'YOUR_PASSWORD';
private $dbname = 'library';
```

### 4. Start Apache server
Place the project in your Apache `htdocs` folder (XAMPP/WAMP/MAMP).

### 5. Access the application
```
http://localhost/S4_B1_Library_Management/Public/
```

## 👤 Default Users

### Reader Account
Sign up normally through the registration page.

### Admin Account
1. Sign up normally first
2. Manually change the role in the database:
```sql
UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
```

## 🔐 Security Features

- Password hashing with `password_hash()`
- SQL injection prevention with PDO prepared statements
- XSS protection with `htmlspecialchars()`
- Session-based authentication
- Role-based access control

## 📝 Usage

### As a Reader:
1. Sign up with your details
2. Login with your credentials
3. Browse available books
4. Click "Emprunter" to borrow a book
5. Go to "Profil" to see your borrowed books
6. Click "Retourner" to return a book

### As an Admin:
1. Sign up normally
2. Change your role to 'admin' in the database
3. Login and access the Admin Dashboard
4. Add, edit, or delete books
5. View all borrowing records

## 🎨 Design

The project uses Tailwind CSS for a clean, modern, and responsive design.

