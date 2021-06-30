<?php

$host_name = "localhost";
$usernameDb = "root";
$passwordDb = "";
$db_name = "school";

$conn = mysqli_connect($host_name, $usernameDb, $passwordDb, $db_name);

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
