<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'config/databaze.php';
include_once 'klasa/lajme.php';

$database = new Database();
$db = $database->getConnection();
$lajmiObj = new Lajme($db);
$lajmet = $lajmiObj->merrLajmet();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ballina - Radio Dardania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="text-align: center; color: white; padding-top: 20px;">
        <h1>Mirësevjen, <?php echo $_SESSION['username']; ?>!</h1>
        
        <div style="background: rgba(255,255,255,0.9); padding: 15px; border-radius: 10px; display: inline-block; color: black;">
            <a href="raporto.php" style="text-decoration: none; color: green; font-weight: bold;">+ Raporto Lajm</a> | 
            <a href="logout.php" style="text-decoration: none; color: red;">Dil</a>
        </div>

        <div style="margin: 50px auto; max-width: 800px; text-align: left; background: white; color: black; padding: 20px; border-radius: 10px; opacity: 0.95;">
            <h2 style="text-align: center; border-bottom: 2px solid red;">Lajmet e Fundit</h2>
            
            <?php if ($lajmet): ?>
                <?php foreach ($lajmet as $l): ?>
                    <div style="border-bottom: 1px solid #ccc; margin-bottom: 15px; padding-bottom: 10px;">
                        <h3><?php echo htmlspecialchars($l['titulli']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($l['permbajtja'])); ?></p>
                        <small>Postuar nga: <strong><?php echo $l['autori']; ?></strong> me datë <?php echo $l['data_krijimit']; ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nuk ka asnjë lajm të raportuar ende.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>