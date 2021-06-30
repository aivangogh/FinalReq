<?php
session_start();

if (isset($_SESSION["id"])) {
    if ($_SESSION['role'] === 'student') {
        header('location: home.php');
    } else {
        header('location: admin/dashboard.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/images/Logo_of_Bukidnon_State_University.png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/util.css">
    <title>Login | BUKSU E-learn</title>
</head>

<body>
    <div class="container">
        <div class="left-column">
            <div class="header">
                <span>Bukidnon State University</span>
                <span class="elearn-header">E-learn</span>
            </div>
            <div class="side-image">
                <img src="assets/images/side-image.PNG" alt="side-image">
            </div>
        </div>
        <div class="right-column">
            <div class="logo">
                <img class="buksu-logo" src="assets/images/Logo_of_Bukidnon_State_University.png" alt="buksu-logo">
            </div>
            <form id="login-form" method="POST" action="includes/login.php" novalidate>
                <div class="error-container">
                    <?php
                    require "includes/error-handling.php";
                    if (isset($_GET["login"])) displayLoginError($_GET["login"]);
                    ?>
                </div>
                <div class="input-container email-id-container">
                    <img class="icon" src="./assets/images/login.png" alt="login-icon">
                    <input class="input-field" id="username" type="text" name="username" placeholder="University email/ID" pattern="(^[A-Za-z0-9]+@student.buksu.edu.ph)|([0-9]){0,}" required>
                </div>
                <div class="input-container password-container">
                    <img class="icon" src="./assets/images/Password.png" alt="login-icon">
                    <input class="input-field" id="password" type="password" name="password" placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Password must have atleast 1 number and letters" required>
                </div>
                <button id="login-button" type="submit" name="login">Login</button>
                <a href="#" class="forgot-password">Forgot password?</a>
            </form>

            <div class="sign-up">
                <span>Don't have an account? <a href="registration.php">Sign up Here!</a></span>
            </div>
        </div>

    </div>
    <script type="module" src="js/login.js"></script>
</body>

</html>