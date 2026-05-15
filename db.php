<?php

$host = "sql5.freesqldatabase.com";
$dbname = "sql5826932";
$user = "sql5826932";
$pass = "CZMTpRWzE3";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
