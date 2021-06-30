<?php

function idExists($conn, $id) {
    $sql = "SELECT * FROM users WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?signup=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function getUserData($conn, $id) {
    if (isset($_POST['edit-btn'])) {
        // require_once "includes/functions.php";;
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?sign=stmtfail");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

        mysqli_stmt_close($stmt);
    }
}

function createUser($conn, $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $courseId, $yearLevel, $role) {
    $sql = "INSERT INTO users (id, email, password, first_name, middle_name, last_name, phone, gender, course_id, year_level, role) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../dashboard.php?add=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssss", $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $courseId, $yearLevel, $role);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_get_result($stmt)) {
        header("location: ../dashboard.php?add=success");
    } else {
        header("location: ../dashboard.php?add=fail");
    }

    mysqli_stmt_close($stmt);
}

function updateUser($conn, $id, $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $courseId, $yearLevel, $role) {
    $sql = "UPDATE users SET email = ?, password = ?, first_name = ?, middle_name = ?, last_name = ?, phone = ?, gender = ?, course_id = ?, year_level = ?, role = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../dashboard.php?edit=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssss", $email, $password, $firstName, $middleName, $lastName, $phone, $gender, $courseId, $yearLevel, $role, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_get_result($stmt)) {
        header("location: ../dashboard.php?edit=success");
    } else {
        header("location: ../dashboard.php?edit=fail");
    }

    mysqli_stmt_close($stmt);
}

function deleteUser($conn, $id) {
    $sql = "DELETE FROM users WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../dashboard.php?add=stmtfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_get_result($stmt)) {
        header("location: ../dashboard.php?delete=fail");
    } else {
        header("location: ../dashboard.php?delete=success");
    }

    mysqli_stmt_close($stmt);
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
