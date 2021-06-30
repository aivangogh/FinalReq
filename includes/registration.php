<?php

if (isset($_POST["register"])) {

    $id = trim($_POST["id"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $firstName = trim($_POST["first-name"]);
    $middleName = trim($_POST["middle-name"]);
    $lastName = trim($_POST["last-name"]);
    $phone = trim($_POST["phone"]);
    $gender = trim($_POST["gender"]);
    $course = trim($_POST["course"]);
    $yearLevel = trim($_POST["year-level"]);
    $role = trim($_POST["role"]);

    require_once "connect-db.php";
    require_once "functions.php";
    require_once "error-handling.php";

    if (idExists($conn, $id) !== false) {
        header("location: ../registration.php?signup=idtaken");
        exit();
    }

    if (emptyInputSignup($id, $firstName, $middleName, $lastName, $password) === true) {
        header("location: ../registration.php?signup=emptyinput");
        exit();
    }

    if ((nameValidation($firstName) || nameValidation($middleName) || nameValidation($lastName)) === true) {
        header("location: ../registration.php?signup=invalidinput");
    }

    if (emailValidation($email) === true) {
        header("location: ../registration.php?signup=invalidemail");
    }

    createUser($conn, $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role);
} else {
    header("location: ../registration.php?signup=none");
    exit();
}
