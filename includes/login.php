<?php


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once "connect-db.php";
    require "functions.php";
    require "error-handling.php";

    if (emptyInputLogin($username, $password) === true) {
        header("location: ../index.php?login=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password);
} else {
    header("location: ../index.php");
    exit();
}
