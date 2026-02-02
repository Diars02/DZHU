<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'config/databaze.php';
include_once 'klasa/lajme.php';

$mesazhi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $lajmiObj = new lajme($db);

    $titulli = $_POST['titulli'] ?? '';
    $teksti = $_POST['permbajtja'] ?? '';
    $autori = $_SESSION['username'];
    if (!empty($titulli) && !empty($teksti)) {
        if ($lajmiObj->shtoLajm($titulli, $teksti, $autori)) {
            $mesazhi = "<p style='color:green;'>Lajmi u dërgua me sukses!</p>";
        } else {
            $mesazhi = "<p style='color:red;'>Gabim gjatë dërgimit.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Raporto Lajm - Radio Dardania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Raporto një Lajm të Ri</h2>
        <p>Përdoruesi: <strong><?php echo $_SESSION['username']; ?></strong></p>
        
        <?php echo $mesazhi; ?>

        <form method="POST">
            <input type="text" name="titulli" placeholder="Titulli i lajmit" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            <textarea name="permbajtja" placeholder="Shkruaj lajmin këtu..." required style="width: 100%; height: 150px; padding: 8px;"></textarea>
            <br><br>
            <button type="submit">Dërgo Lajmin</button>
        </form>

        <br>
        <a href="index.php">Kthehu te Ballina</a>
    </div>
</body>
</html>