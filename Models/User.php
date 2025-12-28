<?php
abstract class User {
    protected $pdo;

    public $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password; 
    protected $role;    

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new user
    public function create($data) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)"
        );

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $hashedPassword,
            $data['role']
        ]);
    }

    
      public static function findByEmail(PDO $pdo, string $email): array|false {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
     } 

    // check if the user is loged in 
    public function login($email, $password) {
         $user = self::findByEmail($this->pdo, $email);
        if ($user && password_verify($password, $user['password'])) {

            $this->id = $user['id'];
            $this->firstName = $user['firstName'];
            $this->lastName = $user['lastName'];
            $this->email = $user['email'];
            $this->role = $user['role'];
            return true;
        }
        return false;
    }
}
?>
