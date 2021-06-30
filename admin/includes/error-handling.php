<?php

function emptyInputSignup($studentId, $firstName, $middleName, $lastName, $password) {
    $isInputEmpty = empty($studentId) || empty($firstName) || empty($middleName) || empty($lastName) || empty($password);
    if ($isInputEmpty) {
        return true;
    }
    return false;
}

function nameValidation($name) {
    $regex = "[A-Za-z]{1,15}";
    if (!preg_match($regex, $name)) {
        return true;
    }
    return false;
}

function emailValidation($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function emptyInputLogin($username, $password) {
    if (empty($username) || empty($password)) {
        return true;
    }
    return false;
}

function invalidUsername($username) {
    $regexStudent = "(^[A-Za-z0-9]+@student.buksu.edu.ph)|([0-9]){0,}";
    $regexAdmin = "(^[A-Za-z0-9]+@admin.buksu.edu.ph)|([0-9]){0,}";
    if (!preg_match($regexStudent, $username) || !preg_match($regexAdmin, $username)) {
        return true;
    }
    return false;
}

function invalidPassword($password) {
    $regex = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$";
    if (!preg_match($regex, $password)) {
        return true;
    }
    return false;
}

function displayLoginError($loginResponse) {
    if ($loginResponse == "emptyinput") {
        echo "<div id='login-error'><p class='error-message'>Input is empty!</p></div>";
    }

    if ($loginResponse == "stmtfail") {
        echo "<div id='login-error'><p class='error-message'>Something went wrong, try again!</p></div>";
    }

    if ($loginResponse == "fail") {
        echo "<div id='login-error'><p class='error-message'>Login failed, Please try again.</p></div>";
    }
}

function displaySignupError($signupResponse) {
    if ($signupResponse == "idtaken") {
        echo "<div class='error-bg'><p class='error'>ID already taken.</p></div>";
    }

    if ($signupResponse == "stmtfail") {
        echo "<div class='error-bg'><p class='error'>Something went wrong, try again!.</p></div>";
    }

    if ($signupResponse == "emptyinput") {
        echo "<div class='error-bg'><p class='error'>Form is empty, please fill-up the form.</p></div>";
    }

    if ($signupResponse == "invalidinput") {
        echo "<div class='error-bg'><p class='error'>You used invalid characters!.</p></div>";
    }

    if ($signupResponse == "invalidemail") {
        echo "<div class='error-bg'><p class='error'>You used invalid email!.</p></div>";
    }

    if ($signupResponse == "success") {
        echo "<div class='success-bg'><p class='success'>You have signed up!.</p></div>";
    }
}

// DASHBOARD QUERY RESPONSE
function displayDeleteResponse($delete) {
    if ($delete == "success") {
        echo "<div id='dashboard-success'><p class='query-success'>Row deleted successfully!</p></div>";
    }

    if ($delete == "fail") {
        echo "<div id='login-error'><p class='query-fail'>Deletion failed.</p></div>";
    }

    if ($delete == "stmtfail") {
        echo "<div id='login-error'><p class='query-error'>Something went wrong, try again!</p></div>";
    }
}

function displayEditResponse($update) {
    if ($update == "success") {
        echo "<div id='dashboard-success'><p class='query-success'>Row Edited successfully!</p></div>";
    }

    if ($update == "fail") {
        echo "<div id='login-error'><p class='query-fail'>Fail to edit profile.</p></div>";
    }

    if ($update == "stmtfail") {
        echo "<div id='login-error'><p class='query-error'>Something went wrong, try again!</p></div>";
    }
}

function displayAddResponse($add) {
    if ($add == "success") {
        echo "<div id='dashboard-success'><p class='query-success'>User added successfully!</p></div>";
    }

    if ($add == "fail") {
        echo "<div id='login-error'><p class='query-fail'>User add failed.</p></div>";
    }

    if ($add == "stmtfail") {
        echo "<div id='login-error'><p class='query-error'>Something went wrong, try again!</p></div>";
    }
}
