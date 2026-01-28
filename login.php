<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);

    foreach ($users as $u) {
        list($u_name, $u_pass) = explode("|", $u);
        if ($u_name === $user && password_verify($pass, $u_pass)) {
            $_SESSION["user"] = $user;
            header("Location: index.php");
            exit;
        }
    }

    $error = "Login i gabuar";
}
?>