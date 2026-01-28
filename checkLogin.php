<?php
session_start();
echo isset($_SESSION["user"]) ? "OK" : "NO";
?>