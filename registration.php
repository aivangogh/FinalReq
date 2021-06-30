<?php
session_start();

if (isset($_SESSION["id"])) {
    if ($_SESSION["role"] === "student") {
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
    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/util.css">
    <title>Registration | BUKSU E-learn</title>
</head>

<body>
    <div class="container">
        <div class="left-column">
            <div>
                <div class="logo-wrapper">
                    <img src="assets/images/Logo_of_Bukidnon_State_University.png" alt="buksu-logo">
                </div>
                <span>Welcome!</span>
                <p>Your 30 seconds away in creating your BukSU <nobr>e-learn</nobr> account</p>
            </div>
        </div>

        <div class="right-column">
            <div class="error-container">
                <?php
                require "includes/error-handling.php";
                if (isset($_GET["signup"])) displaySignupError($_GET["signup"]);
                ?>
            </div>

            <form id="registration-form" method="POST" action="includes/registration.php" novalidate>
                <div class="form-left-column">

                    <div class="input-container">
                        <label class="input-header" for="first-name">First Name</label>
                        <input class="input" id="first-name" type="text" name="first-name" placeholder="FIRST NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g John" required>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="middle-name">Middle Name</label>
                        <input class="input" id="middle-name" type="text" name="middle-name" placeholder="MIDDLE NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g Forest" required>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="last-name">Last Name</label>
                        <input class="input" id="last-name" type="text" name="last-name" placeholder="LAST NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g Doe" required>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="phone">Phone</label>
                        <input class="input" id="phone" type="text" name="phone" placeholder="Phone" pattern="^(09|\+639)\d{9}$" title="Format must be like this. 09xxxxxxxxx">
                    </div>

                    <div class="password-container">
                        <label class="input-header" for="password">Password</label>
                        <div class="password-field">
                            <input id="password" type="password" name="password" placeholder="Password *" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                            <button class="password-button">
                                <img class="password-icon" src="assets/images/eye-slash-regular.svg" alt="hide-password">
                            </button>
                        </div>
                    </div>

                    <div class="radio-container">
                        <label class="input-header">Gender</label>
                        <div class="radio-gender">
                            <label>
                                <input id="male" type="radio" name="gender" value="male" required>
                                Male
                            </label>
                            <label>
                                <input id="female" type="radio" name="gender" value="female" required>
                                Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-right-column">
                    <div class="input-container">
                        <label class="input-header" for="student-id"><span class="role-id">Student</span> ID</label>
                        <input class="input" id="id" type="text" name="id" placeholder="Student ID *" pattern="[0-9]{10}" title="ID should only contain numbers and length of 10" required>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="email">University Email
                            (@<span class="role-email">student</span>.buksu.edu.ph)</label>
                        <input class="input" id="email" type="email" name="email" placeholder="University Email" readonly="readonly" pattern="^[A-Za-z0-9]+@student.buksu.edu.ph{0,}" required>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="college">College</label>
                        <select id="college" name="college" required>
                            <option value="" disabled selected hidden>SELECT COLLEGE *</option>
                        </select>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="course">Course</label>
                        <select id="course" name="course" required>
                            <option value="" disabled selected hidden>COURSE *</option>
                            <option value="" disabled>Select college first</option>
                        </select>
                    </div>

                    <div class="input-container">
                        <label class="input-header" for="year">Year</label>
                        <select id="year-level" name="year-level" required>
                            <option value="" disabled selected hidden>YEAR LEVEL *</option>
                        </select>
                    </div>


                    <div class="register-container">
                        <div class="register-as-container">
                            <label class="input-header" for="password">Register as</label>
                            <select id="role" name="role">
                                <option value="student" selected>Student</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="register-button-container">
                            <button id="register-button" name="register" type="submit">Register</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="sign-in">
                <span class="signin">Already signed up? <a href="index.php">Sign in Here!</a></span>
            </div>

        </div>
    </div>
    <script type="module" src="js/register.js"></script>

</body>

</html>