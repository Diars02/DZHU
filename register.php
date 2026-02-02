<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'config/databaze.php'; 
include_once 'klasa/user.php'; 

$mesazhi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    
    if($db) {
        $userObj = new User($db);
        $u = $_POST['perdoruesi'] ?? '';
        $p = $_POST['fjalekalimi'] ?? '';

        if (!empty($u) && !empty($p)) {
            if ($userObj->register($u, $p)) {
                header("Location: login.php?sukses=1");
                exit();
            } else {
                $mesazhi = "Gabim: Ky përdorues ekziston ose ka problem me tabelën.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Regjistrimi - Radio Dardania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Regjistrohu</h2>
        <?php if($mesazhi != "") echo "<p style='color:red;'>$mesazhi</p>"; ?>
        
        <form method="POST">
            <input type="text" name="perdoruesi" placeholder="Username" required>
            <input type="password" name="fjalekalimi" placeholder="Password" required>
            <button type="submit">Regjistrohu</button>
        </form>
        
        <br>
        <a href="login.php" style="text-decoration: none; color: blue;">Kthehu te Login</a>
    </div>
</body>
</html>