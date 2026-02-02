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

    public function fshijLajm($id) {
     $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
     $stmt = $this->conn->prepare($sql);
     return $stmt->execute([$id]);
    }

    public function merrLajminSipasId($id) {
      $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLajm($id, $titulli, $permbajtja) {
     $sql = "UPDATE " . $this->table . " SET titulli = ?, permbajtja = ? WHERE id = ?";
     $stmt = $this->conn->prepare($sql);
     return $stmt->execute([$titulli, $permbajtja, $id]);
    }
}
?>