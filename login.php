<?php
session_start();
include_once 'config/databaze.php';
include_once 'klasa/user.php';

$gabim = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $userObj = new User($db);

    $u = $userObj->login($_POST['username'], $_POST['password']);

    if ($u) {
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['username'] = $u['username'];
        header("Location: index.php");
        exit();
    } else {
        $gabim = "Username ose Password gabim!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Radio Dardania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Identifikohu</h2>
        <?php 
            if(isset($_GET['sukses'])) echo "<p style='color:green;'>Llogaria u krijua! Kyçu tani.</p>";
            if($gabim != "") echo "<p style='color:red;'>$gabim</p>";
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>