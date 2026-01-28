<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);

    foreach ($users as $u) {
        if (explode("|", $u)[0] === $user) {
            die("Ky user ekziston");
        }
    }

    file_put_contents("users.txt", "$user|$pass\n", FILE_APPEND);
    header("Location: login.php");
}
?>