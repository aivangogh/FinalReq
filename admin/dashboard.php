<?php
session_start();

if (isset($_SESSION["id"])) {
    if ($_SESSION["role"] === "admin") {
        require_once "includes/connect-db.php";
        require_once "includes/functions.php";

        $sql = "SELECT * FROM users WHERE role = 'student'";
        $result = mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="css/admin-dashboard.css">
    <link rel="stylesheet" href="../css/util.css">
    <title>Admin | BUKSU E-learn</title>
</head>

<body>
    <div class="container">
        <?php include('layouts/sidebar.php'); ?>

        <div class="right-column">
            <div class="query-container">
                <div class="query-response-container">
                    <?php
                    require "includes/error-handling.php";
                    if (isset($_GET["delete"])) {
                        displayDeleteResponse($_GET["delete"]);
                    } else if (isset($_GET["add"])) {
                        displayAddResponse($_GET["add"]);
                    } else if (isset($_GET["update"])) {
                        displayEditResponse($_GET["update"]);
                    }
                    ?>
                </div>

            </div>
            <div class="table-container card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <tr class='table-rows'>
                                <td data-id><?php echo $row['id']; ?></td>
                                <td data-email><?php echo $row['email']; ?></td>
                                <td data-password><?php echo $row['password']; ?></td>
                                <td data-first-name><?php echo $row['first_name']; ?></td>
                                <td data-middle-name><?php echo $row['middle_name']; ?></td>
                                <td data-last-name><?php echo $row['last_name']; ?></td>
                                <td data-phone><?php echo $row['phone']; ?></td>
                                <td data-gender><?php echo $row['gender']; ?></td>
                                <td data-course-id><?php echo $row['course_id']; ?></td>
                                <td data-year-level><?php echo $row['year_level']; ?></td>
                                <td data-role><?php echo $row['role']; ?></td>
                                <td class="action-container">
                                    <div class='actions'>
                                        <form action="signup-edit.php" method="POST">
                                            <input type="hidden" name="edit-id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit-btn" class="edit-btn action-btn">Edit</button>
                                        </form>
                                        <button class="delete-btn action-btn">Delete</button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </table>
                <div class="add-action-container">
                    <button onclick="location.href='signup-add.php';" class="add-btn action-btn">Add</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal">
        <div class="delete-modal-container card" style="display: none;">
            <p class="prompt-msg">Do you really want to delete this row?</p>
            <div class="log-info">
                <p>ID: <span class="prompt-id">xxx</span></p>
                <p>Email: <span class="prompt-email">xxx</span></p>
                <p>Password: <span class="prompt-password">xxx</span></p>
                <p>First Name: <span class="prompt-first-name">xxx</span></p>
                <p>Middle Name: <span class="prompt-middle-name">xxx</span></p>
                <p>Last Name: <span class="prompt-last-name">xxx</span></p>
                <p>Phone: <span class="prompt-phone">xxx</span></p>
                <p>Gender: <span class="prompt-gender">xxx</span></p>
                <p>Course: <span class="prompt-course">xxx</span></p>
                <p>Year: <span class="prompt-year-level">xxx</span></p>
                <p>Role: <span class="prompt-role">xxx</span></p>
            </div>
            <div class="delete-actions action-btn">
                <form action="includes/admin.php" method="POST">
                    <input type="hidden" id="delete-id" name="delete-id">
                    <button type="submit" class="action-delete-btn" name="delete-data" title="Delete">Delete</button>
                </form>
                <button class="action-cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
    <div id="overlay"></div>
    <script type="module" src="js/dashboard.js"></script>

</body>

</html>