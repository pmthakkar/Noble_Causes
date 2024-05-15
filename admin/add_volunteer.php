<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <!-- Theme style -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="add_admin.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<?php
session_start();
if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
    header("Location:../login.php");
}
?>
<?php
require ("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $v_name = mysqli_real_escape_string($conn, $_POST["name"]);
    $v_phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $v_email = mysqli_real_escape_string($conn, $_POST["email"]);
    $v_password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST["confirm_pass"]);
    $v_gender = $_POST['gender'];
    $v_street = mysqli_real_escape_string($conn, $_POST['street']);
    $v_city = mysqli_real_escape_string($conn, $_POST['city']);
    $v_zip = mysqli_real_escape_string($conn, $_POST['zip_code']);

    // Check if the email already exists in the database
    $check_query = "SELECT * FROM `volunteers` WHERE `v_email` = '$v_email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Email already exists, show error message
        echo '<script>
                alert("This email address is already registered. Please use a different email address.");
              </script>';
    } else {
        // Email is unique, proceed with insertion
        if ($v_password == $confirm_pass) {
            $hash = password_hash($v_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `volunteers` (`v_name`, `v_phone`, `v_email`, `v_password`, `v_gender`, `v_street`, `v_city`, `v_zip`, `status`, `v_time`) VALUES ('$v_name', '$v_phone', '$v_email', '$hash', '$v_gender', '$v_street', '$v_city', '$v_zip', 'approved', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // User successfully registered, show toaster message and redirect
                echo '<script>
                            alert("Registration successful. Redirecting to login page...");
                            window.location.href = "volunteer_needed";
                          </script>';
                exit(); // Make sure to exit to prevent further execution of the PHP code
            } else {
                // Registration failed, you can handle this case accordingly
                echo '<script>
                            alert("Registration failed. Please try again.");
                          </script>';
            }
        }
    }



}
?>

<body class="hold-transition sidebar-mini">
    <?php include ("navbar.php"); ?>
    <div class="wrapper">
        <!-- Navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Admins</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manage Admins</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Enter your Name" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your Email" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone:</label>
                                            <input type="phone" id="phone" name="phone" class="form-control"
                                                placeholder="Enter your Phone number" required />
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                Password</label>
                                                <input type="Password" name="password" class="form-control"
                                                    placeholder="Enter Password" required />
                                            </div>
                                            <div class="form-group col-6">
                                                Confirm
                                                Password</label>
                                                <input type="password" name="confirm_pass" class="form-control"
                                                    placeholder="Confirm Password" required />
                                            </div>
                                        </div>


                                        <div class="gender-box">
                                            <h6><i class="fa fa-mars" aria-hidden="true"></i> Gender:</h6>
                                            <div class="gender-option" style="display: flex; gap: 20px">
                                                <div class="gender">
                                                    <input type="radio" id="check-male" name="gender" value="male" />
                                                    <label for="check-male">Male</label>
                                                </div>
                                                <div class="gender">
                                                    <input type="radio" id="check-female" name="gender"
                                                        value="female" />
                                                    <label for="check-female">Female</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" id="street" name="street" class="form-control"
                                                placeholder="Enter your Street" required />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="city" class="form-control"
                                                    placeholder="Enter your city" required />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="zip_code" class="form-control"
                                                    placeholder="Enter your Zip code" required />
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="add" name="submit"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->



        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- Page specific script -->
        <?php include "footer.php"; ?>


</body>

</html>