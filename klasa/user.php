<?php
class User {
    private $conn;
    private $table = "users"; 

    public function __construct($db) { 
        $this->conn = $db; 
    }

    public function register($user, $pass, $role = 'user') {
        $hashed = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `" . $this->table . "` (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user, $hashed, $role]);
    }

    public function login($user, $pass) {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($u && password_verify($pass, $u['password'])) {
            return $u;
        }
        return false;
    }
}
?>