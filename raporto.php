<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lajmi = trim($_POST["lajmi"]);
    file_put_contents(
        "reports.txt",
        $_SESSION["user"] . ": " . $lajmi . "\n",
        FILE_APPEND
    );
    echo "Lajmi u dergua";
}
?>