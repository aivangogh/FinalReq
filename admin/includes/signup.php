<?php
session_start();
if (isset($_SESSION["id"])) {
    if ($_SESSION["role"] === "admin") {
        if (isset($_POST["save-btn"])) {

            if ($_SESSION['mode'] === 'edit') {
                $_SESSION['edit'] = 'edit';
                echo "edit mode";
                updateData();
                unset($_SESSION["mode"]);
            } else {
                $_SESSION['add'] = 'add';
                addData();
                unset($_SESSION["mode"]);
            }
        }

        if (isset($_POST["cancel-btn"])) {
            cancelAction();
        }
    } else {
        header("location: ../home.php");
    }
} else {
    header("location: ../index.php");
}

function cancelAction() {
    unset($_SESSION["mode"]);
    $_SESSION['cancel'] = 'cancel';
    header('location: ../dashboard.php');
}

function updateData() {
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
    var_dump($id, $email, $firstName);

    updateUser($conn, $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role);
    header("location: ../dashboard.php?update=success");
}

function addData() {
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
        header("location: ../signup.php?signup=idtaken");
        exit();
    }

    if (emptyInputSignup($id, $firstName, $middleName, $lastName, $password) === true) {
        header("location: ../signup.php?signup=emptyinput");
        exit();
    }

    if ((nameValidation($firstName) || nameValidation($middleName) || nameValidation($lastName)) === true) {
        header("location: ../signup.php?signup=invalidinput");
    }

    if (emailValidation($email) === true) {
        header("location: ../signup.php?signup=invalidemail");
    }
    session_start();
    $_SESSION['demo'] = 'success';
    createUser($conn, $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role);
    header("location: ../dashboard.php?add=success");
}

function deleteData() {
    $id = trim($_POST["id"]);

    require_once "connect-db.php";
    require_once "functions.php";
    require_once "error-handling.php";

    createUser($id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role);
    header("location: ../dashboard.php?add=success");
}


