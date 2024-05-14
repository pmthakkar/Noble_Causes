<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- CSS Link -->
    <link rel="stylesheet" href="profile.css?v=4">

    <title>EditProfile</title>
    <style>
    /*  CSS for Button (Save changes)  */

    .editbtn {
        justify-items: center;
        text-align: center;
    }

    .editbtn {
        background-color: #3e8da8;
        color: aliceblue;
        border: none;
        border-radius: 3px;
        padding: 2px;
        /* height: 35px; */
    }

    .editbtn:hover {
        background-color: #55abc8;
        color: aliceblue;
    }
    </style>

</head>

<body>


    <!-- back to home button -->
    <div class="backtohome mt-4 ml-5">
        <li class="col-md-12"><a href="index"> <i class='fas fa-angle-left' style='font-size:15px'></i>
                <b> Back To Home </b>
            </a></li>
    </div>

    <?php
    session_start();

    require 'connection.php'; // Make sure connection.php exists and contains database connection code.
    
    // Redirect if user is not logged in
    if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("Location: login");
        exit; // Stop further execution
    }

    // Handle password update
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['user_id'];
        $current_password = mysqli_real_escape_string($conn, $_POST['currentpassword']);
        $password = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

        // Fetch current password from the database
        $sql = "SELECT password FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            // Verify current password
            if (password_verify($current_password, $stored_password)) {
                // Check if new password and confirm password match
                if ($password == $confirm_password) {
                    // Hash the new password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Update password in the database
                    $update_sql = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
                    $update_result = mysqli_query($conn, $update_sql);

                    if ($update_result) {
                        // Password updated successfully
                        // Redirect or display success message
                        header("Location: logout");
                        echo "Password updated successfully!";
                    } else {
                        echo "Failed to update password.";
                    }
                }
            }
        }
    }
    ?>
    <?php
    include "profile_navbar.php";

    $sql = "SELECT * FROM `users` WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="profile-info col-md-9">
        <div class="panel">
            <!-- <div class="bio-graph-heading">
                        <h5>“Help others without any reason and give without the expectation of receiving anything in
                            return.”</h5>
                    </div> -->
            <div class="card col-md-12 my-4">
                <h3 class="mt-3 ml-3">Change Password</h3>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <h6>Current Password:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary"> <input type="password" class="form-control"
                                    name="currentpassword" placeholder="Enter Your Cureent Password"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <h6>New Password:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary"> <input type="password" class="form-control"
                                    name="newpassword" placeholder="Enter New Password"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <h6>Confirm Password:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary"> <input type="password" class="form-control"
                                    name="confirmpassword" placeholder="Enter Confirm Password"></div>
                        </div>

                        <div class="d-grid gap-2 col-sm-3 mx-auto">
                            <button class="editbtn " type="submit">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php } ?>
    <?php
    include ("footer.php");
    ?>

</body>

</html>