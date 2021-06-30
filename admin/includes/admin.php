<?php


if (isset($_POST["delete-data"])) {
    require_once "connect-db.php";
    require_once "functions.php";

    $id = $_POST["delete-id"];

    deleteUser($conn, $id);
}
