<?php
session_start();

if (isset($_SESSION["id"])) {
    if ($_SESSION['role'] === 'student') {
        require "includes/connect-db.php";
        require "includes/functions.php";
        $currentSessionId = $_SESSION["id"];
        $user = userData($conn, $currentSessionId);
        $userCourse = getCourse($conn, $user["course_id"], $currentSessionId);
    } else {
        header("location: admin/dashboard.php");
    }
} else {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/images/Logo_of_Bukidnon_State_University.png">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/util.css">
    <title>Home | BUKSU E-learn</title>
</head>

<body>
    <div class="container">
        <div class="left-column">
            <div class="user-card-profile card">
                <div class="bg-image"></div>
                <div class="profile-picture">
                    <img id="avatar" src="./assets/images/male.png" alt="male">
                </div>
                <div class="user-info">
                    <span id="user-name"><?php echo $user["first_name"] . " " . $user["last_name"]; ?></span>
                    <div class="course">
                        <div>
                            <span id="user-course"><?php echo $userCourse["course_id"]; ?></span>-<span id="user-year"><?php echo $user["year_level"]; ?></span>
                        </div>
                        <span id="user-college"><?php echo $userCourse["course_name"]; ?></span>
                    </div>
                    <span id="user-email"><?php echo  $user['email']; ?></span>
                </div>
            </div>
            <div class="calendar-widget card">
                <div class="calendar">
                    <div class="month">
                        <span>May</span>
                        <span class="year">2021</span>
                    </div>
                    <div class="weekdays">
                        <div>Su</div>
                        <div>Mo</div>
                        <div>Tu</div>
                        <div>We</div>
                        <div>Th</div>
                        <div>Fr</div>
                        <div>Sa</div>
                    </div>
                    <div class="days">
                        <div class="prev-days">25</div>
                        <div class="prev-days">26</div>
                        <div class="prev-days">27</div>
                        <div class="prev-days">28</div>
                        <div class="prev-days">29</div>
                        <div class="prev-days">30</div>
                        <div>1</div>
                        <div>2</div>
                        <div>3</div>
                        <div>4</div>
                        <div>5</div>
                        <div>6</div>
                        <div>7</div>
                        <div>8</div>
                        <div>9</div>
                        <div>10</div>
                        <div>11</div>
                        <div>12</div>
                        <div>13</div>
                        <div>14</div>
                        <div>15</div>
                        <div>16</div>
                        <div>17</div>
                        <div>18</div>
                        <div>19</div>
                        <div>20</div>
                        <div>21</div>
                        <div>22</div>
                        <div>23</div>
                        <div>24</div>
                        <div>25</div>
                        <div>26</div>
                        <div>27</div>
                        <div>28</div>
                        <div>29</div>
                        <div>30</div>
                        <div>31</div>
                        <div class="next-days">1</div>
                        <div class="next-days">2</div>
                        <div class="next-days">3</div>
                        <div class="next-days">4</div>
                        <div class="next-days">5</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-column">
            <form class="user-profile card" method="POST" action="includes/home.php">
                <div class="profile-header">
                    <span>Profile</span>
                    <button onclick="location.href='includes/logout.php';" class=" logout-btn" type="button">Logout</button>
                </div>
                <div class="id-and-email-container">
                    <div class="id input-container">
                        <label class="input-header" for="id">Student ID</label>
                        <input class="input disabled" id="id" type="text" name="id" value="<?php echo $user["id"]; ?>" placeholder="Student ID *" required>
                    </div>

                    <div class="email input-container">
                        <label class="input-header email-label" for="university-email">Email Address</label>
                        <input class="input disabled" id="university-email" type="email" name="university-email" value="<?php echo $user["email"]; ?>" placeholder="University Email *">
                    </div>
                </div>

                <div class="full-name-container">
                    <div class="first-name input-container">
                        <label class="input-header" for="first-name">First Name</label>
                        <input class="input" id="first-name" type="text" name="first-name" value="<?php echo $user["first_name"]; ?>" placeholder="FIRST NAME *">
                    </div>

                    <div class="middle-name input-container">
                        <label class="input-header" for="middle-name">Middle Name</label>
                        <input class="input" id="middle-name" type="text" name="middle-name" value="<?php echo $user["middle_name"]; ?>" placeholder="MIDDLE NAME *">
                    </div>

                    <div class="last-name input-container">
                        <label class="input-header" for="last-name">Last Name</label>
                        <input class="input" id="last-name" type="text" name="last-name" value="<?php echo $user["last_name"]; ?>" placeholder="LAST NAME *">
                    </div>

                </div>

                <div class="phone-and-gender-container">
                    <div class="phone input-container">
                        <label class="input-header" for="phone">Phone</label>
                        <input class="input" id="phone" type="text" name="phone" value="<?php echo $user["phone"]; ?>" placeholder="Phone">
                    </div>

                    <div class="radio-container">
                        <label class="input-header" for="gender">Gender</label>
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

                <div class="college-container">
                    <div class="college input-container">
                        <label class="input-header" for="college">College</label>
                        <select id="college" class="disabled" name="college">
                            <option value="<?php echo $userCourse["college_id"]; ?>"><?php echo $userCourse["college_name"]; ?></option>
                        </select>
                    </div>

                    <div class="course input-container">
                        <label class="input-header" for="course">Course</label>
                        <select id="course" class="disabled" name="course">
                            <option value="<?php echo $userCourse["course_id"]; ?>"><?php echo $userCourse["course_name"]; ?></option>
                        </select>
                    </div>

                    <div class="year input-container">
                        <label class="input-header" for="year-level">Year</label>
                        <select id="year-level" class="disabled" name="year-level">
                            <option value="<?php echo $user["year_level"]; ?>"><?php echo $user["year_level"]; ?></option>
                        </select>
                    </div>
                </div>

                <div class="password-container">
                    <div class="input-container">
                        <label class="input-header" for="password">Change Password</label>
                        <div class="password-field">
                            <input class="password" type="password" name="change-password" placeholder="Change Password" required>
                            <button class="password-button">
                                <img class="password-icon" src="./assets/images/eye-slash-regular.svg" alt="hide-password">
                            </button>
                        </div>
                    </div>
                    <div class="input-container">
                        <label class="input-header" for="password">Retype Password</label>
                        <div class="password-field">
                            <input class="password" type="password" name="retype-password" placeholder="Retype Password" required>
                            <button class="password-button">
                                <img class="password-icon" src="./assets/images/eye-slash-regular.svg" alt="hide-password">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="update-profile-container">
                    <button id="update-profile-button" type="submit" name="update">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="js/home.js"></script>
</body>

</html>