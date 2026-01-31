<?php session_start(); ?>

<?php if (isset($_SESSION["user"])): ?>
    <p>Mirësevjen, <?= $_SESSION["user"] ?></p>
    <button onclick="goRaporto()">Raporto lajm</button>
    <a href="logout.php">Logout</a>

    <?php else: ?>
     <a href="login.php">Login</a>
    <?php endif; ?>