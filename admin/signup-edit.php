<?php
session_start();

if (isset($_SESSION["id"])) {
    if ($_SESSION["role"] === "admin") {
        require_once "includes/connect-db.php";
        require_once "includes/functions.php";
        if (isset($_POST["edit-id"])) {
            $editId = $_POST["edit-id"];
            $user = getUserData($conn, $editId);
            $userCourse = getCourse($conn, $user["course_id"], $editId);
            $_SESSION['mode'] = 'edit';
        } else {
            $_SESSION['mode'] = 'add';
        }
    } else {
        header("location: ../home.php");
    }
} else {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/Logo_of_Bukidnon_State_University.png">
    <link rel="stylesheet" href="css/admin-signup.css">
    <link rel="stylesheet" href="../css/util.css">
    <title>Edit | BUKSU E-learn</title>
</head>

<body>
    <div class="container">
        <?php include('layouts/sidebar.php'); ?>

        <div class="right-column">
            <div class="error-container">
                <?php
                    require "includes/error-handling.php";
                    if (isset($_GET["signup"])) displaySignupError($_GET["signup"]);
                ?>
            </div>

            <form id="registration-form" method="POST" action="includes/signup.php" novalidate>
                <div class="form">
                    <div class="form-left-column">

                        <div class="input-container">
                            <label class="input-header" for="first-name">First Name</label>
                            <input class="input" id="first-name" type="text" name="first-name" value="<?php echo $user["first_name"]; ?>" placeholder="FIRST NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g John" required>
                        </div>

                        <div class="input-container">
                            <label class="input-header" for="middle-name">Middle Name</label>
                            <input class="input" id="middle-name" type="text" name="middle-name" value="<?php echo $user["middle_name"]; ?>" placeholder="MIDDLE NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g Forest" required>
                        </div>

                        <div class="input-container">
                            <label class="input-header" for="last-name">Last Name</label>
                            <input class="input" id="last-name" type="text" name="last-name" value="<?php echo $user["last_name"]; ?>" placeholder="LAST NAME *" pattern="[A-Za-z]{1,15}" title="Name should only contain letters. e.g Doe" required>
                        </div>
                        <div class="input-container">
                            <label class="input-header" for="phone">Phone</label>
                            <input class="input" id="phone" type="text" name="phone" value="<?php echo $user["phone"]; ?>" placeholder="Phone" pattern="^(09|\+639)\d{9}$" title="Format must be like this. 09xxxxxxxxx">
                        </div>
                        <div class="password-container">
                            <label class="input-header" for="password">Password</label>
                            <div class="password-field">
                                <input id="password" type="password" name="password" value="<?php echo $user["password"]; ?>" placeholder="Password *" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                                <button class="password-button">
                                    <img class="password-icon" src="../assets/images/eye-slash-regular.svg" alt="hide-password">
                                </button>
                            </div>
                        </div>

                        <div class="radio-container">
                            <label class="input-header">Gender</label>
                            <div class="radio-gender">
                                <label for="gender">
                                    <input id="male" type="radio" name="gender" value="male" <?php echo ($user["gender"] === 'male') ? 'checked' : ''; ?>>
                                    Male
                                </label>
                                <label for="gender">
                                    <input id="female" type="radio" name="gender" value="female" <?php echo ($user["gender"] === 'female') ? 'checked' : ''; ?>>
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-right-column">
                        <div class="input-container">
                            <label class="input-header" for="student-id"><span class="role-id">Student</span> ID</label>
                            <input class="input" id="id" type="text" name="id" value="<?php echo $user["id"]; ?>" placeholder="Student ID *" pattern="[0-9]{10}" title="ID should only contain numbers and length of 10" required>
                        </div>

                        <div class="input-container">
                            <label class="input-header" for="email">University Email
                                (@<span class="role-email">student</span>.buksu.edu.ph)</label>
                            <input class="input" id="email" type="email" name="email" value="<?php echo $user["email"]; ?>" placeholder="University Email" readonly="readonly" pattern="^[A-Za-z0-9]+@student.buksu.edu.ph{0,}" required>
                        </div>


                        <div class="input-container">
                            <label class="input-header" for="college">College</label>
                            <input type="hidden" class="edit-college" value="<?php echo $userCourse['college_id']; ?>">
                            <select id="college" name="college" required>
                                <option value="" disabled selected hidden>SELECT COLLEGE *</option>
                                <option value="COA">College of Administration</option>
                                <option value="CAS">College of Arts and Sciences</option>
                                <option value="COB">College of Business</option>
                                <option value="COE">College of Education</option>
                                <option value="COL">College of Law</option>
                                <option value="CON">College of Nursing</option>
                                <option value="COT">College of Technologies</option>
                            </select>
                        </div>

                        <div class="input-container">
                            <label class="input-header" for="course">Course</label>
                            <input type="hidden" class="edit-course" value="<?php echo $userCourse['course_id']; ?>">
                            <select id="course" name="course" required>
                                <option value="" disabled selected hidden>COURSE *</option>
                                <option value="" disabled>Select college first</option>
                            </select>
                        </div>

                        <div class="input-container">
                            <label class="input-header" for="year">Year</label>
                            <input type="hidden" class="edit-yearLevel" value="<?php echo $usere['year_level']; ?>">
                            <select id="year-level" name="year-level" required>
                                <option value="" disabled selected hidden>YEAR LEVEL *</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="5">5th Year</option>
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
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <button name="save-btn">Save</button>
                    <button name="cancel-btn">Cancel</button>
                </div>
            </form>

        </div>
    </div>
    <script type="module" src="js/signup-edit.js"></script>
    <script type="text/javascript">

        const collegeList = document.getElementById('college');
        const courseList = document.getElementById('course');
        const yearLevel = document.getElementById('year-level');
        
        let userCollege = <?php echo json_encode($userCourse['college_id']) ?>;

        window.onload = () => {
         loadJSON();
        };

        function loadJSON() {
            const request = new XMLHttpRequest();
            request.overrideMimeType('application/json');
            request.open('GET', '../json/colleges-courses.json', true);
            request.onreadystatechange = () => {
                if (request.readyState == 4 && request.status == '200') {
                    parseJSON(request.responseText);
                }
            };
            request.send(null);
        }

        function parseJSON(response) {
            const parsedData = JSON.parse(response);
            const collegeArray = [...parsedData.College];
   
            changeCourses(collegeArray, userCollege);
            college.addEventListener('change', () => {
                userCollege = collegeList.value;
                changeCourses(collegeArray, userCollege);
            });
        }

        getCollegeList();
        setYearLevel();

        function getCollegeList() {
            const courseList = document.getElementById('course');

            let userCollege = <?php echo json_encode($userCourse['college_id']) ?>;
            let userCourse = <?php echo json_encode($userCourse['course_id']) ?>;

            for (let i = 1; i < collegeList.length; i++) {
                if (collegeList[i].value == userCollege) collegeList[i].setAttribute('selected', '');
            }
        }

        function setYearLevel() {
            let userYearLevel = <?php echo json_encode($user['year_level']) ?>;

            for (let i = 1; i < yearLevel.length; i++) {
                if(yearLevel[i].value == userYearLevel) yearLevel[i].setAttribute('selected', '');
            }
        }

        // This will populate the selection base on college selection
        // It has the same functionality of functions in login.js
        function changeCourses(collegeArray, value) {
            let userCourse = <?php echo json_encode($userCourse['course_id']) ?>;

            let courseOptions = '';
            collegeArray.forEach((college) => {
                college.courses.filter((courses) => {
                    if (college.id == value) {
                        courseOptions += `<option value="${courses.id}">${courses.course}</option>`;
                    }
                });
            });
            course.innerHTML = courseOptions;

            for (let i = 0; i < courseList.length; i++) {
                console.log(courseList[i].value);
                if(courseList[i].value == userCourse) courseList[i].setAttribute('selected', '');
            }
        }

    </script>

</body>

</html>