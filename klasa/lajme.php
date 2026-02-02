<?php
class Lajme {
    private $conn;
    private $table = "lajme"; 

    public function __construct($db) {
        $this->conn = $db;
    }
    public function shtoLajm($titulli, $permbajtja, $autori){
     $sql = "INSERT INTO " . $this->table . " (titulli, permbajtja, autori, data_krijimit) VALUES (?, ?, ?, NOW())";
     $stmt = $this->conn->prepare($sql);
     return $stmt->execute([$titulli, $permbajtja, $autori]);
    }

    public function merrLajmet() {
     $sql = "SELECT * FROM " . $this->table . " ORDER BY data_krijimit DESC";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>