<?php

function idExists($conn, $id) {
    $sql = "SELECT * FROM users WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../registration.php?signup=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $studentId, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role) {
    $sql = "INSERT INTO users (id, email, password, first_name, middle_name, last_name, phone, gender, course_id, year_level, role) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../registration.php?signup=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssss", $studentId, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $course, $yearLevel, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../registration.php?signup=success");
    exit();
}

function getCourse($conn, $courseId, $id) {
    $sql = "SELECT colleges.college_id, colleges.college_name, users.course_id, courses.course_name
            FROM users, colleges JOIN courses ON colleges.college_id = courses.college_id
            WHERE courses.course_id = ? AND users.id = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../home.php?home=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $courseId, $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function loginUser($conn, $username, $password) {
    $idExists = idExists($conn, $username);

    if ($idExists === false) {
        header("location: ../index.php?login=doesntexists");
        exit();
    }

    if ($password === $idExists["password"]) {
        if ($idExists["role"] === "student") {
            session_start();
            $_SESSION['id'] = $idExists["id"];
            $_SESSION['role'] = $idExists["role"];
            header("location: ../home.php");
            exit();
        } else {
            session_start();
            $_SESSION['id'] = $idExists["id"];
            $_SESSION['role'] = $idExists["role"];
            header("location: ../admin/dashboard.php");
            exit();
        }
    } else {
        header("location: ../index.php?login=fail");
        exit();
    }
}

function userData($conn, $sessionId) {
    return idExists($conn, $sessionId);
}
