<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $email;
    public $password;
    public $name;
    public $bio;
    public $avatar;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET username = :username, 
                      email = :email, 
                      password = :password, 
                      name = :name,
                      created_at = NOW()";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':name', $this->name);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUsername($username) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $name, $bio) {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, bio = :bio 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $bio = htmlspecialchars(strip_tags($bio));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function updateAvatar($id, $avatar) {
        $query = "UPDATE " . $this->table . " SET avatar = :avatar WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function changePassword($id, $currentPassword, $newPassword) {
        $user = $this->getById($id);
        
        if($user && password_verify($currentPassword, $user['password'])) {
            $query = "UPDATE " . $this->table . " SET password = :password WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function usernameExists($username) {
        $query = "SELECT id FROM " . $this->table . " WHERE username = :username LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
