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

$id = isset($_GET['id']) ? $_GET['id'] : die('ID e lajmit mungon!');

$lajmi = $lajmiObj->merrLajminSipasId($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulli = $_POST['titulli'];
    $permbajtja = $_POST['permbajtja'];

    if ($lajmiObj->updateLajm($id, $titulli, $permbajtja)) {
        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Gabim gjatë përditësimit!";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndrysho Lajmin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: url('flamuri.jpg'); background-size: cover; color: white; font-family: sans-serif;">

    <div style="max-width: 500px; margin: 100px auto; background: rgba(0,0,0,0.8); padding: 30px; border-radius: 15px; text-align: center;">
        <h2>Ndrysho Lajmin</h2>
        <hr>
        
        <form method="POST">
            <div style="margin-bottom: 15px; text-align: left;">
                <label>Titulli:</label><br>
                <input type="text" name="titulli" value="<?php echo htmlspecialchars($lajmi['titulli']); ?>" 
                       style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;" required>
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label>Përmbajtja:</label><br>
                <textarea name="permbajtja" rows="5" 
                          style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;" required><?php echo htmlspecialchars($lajmi['permbajtja']); ?></textarea>
            </div>

            <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; width: 100%;">
                Ruaj Ndryshimet
            </button>
            <br><br>
            <a href="index.php" style="color: #ffc107; text-decoration: none;">Anulo dhe kthehu</a>
        </form>
    </div>

</body>
</html>