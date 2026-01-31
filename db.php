<?php
$conn = new mysqli("localhost", "root", "", "lajme_db");

if ($conn->connect_error) {
    die("Lidhja deshtoi");
}
