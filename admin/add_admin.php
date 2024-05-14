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

    <!-- Theme style -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="add_admin.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<?php
            session_start();
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                
            }else{
                header("Location:../login.php");
            }
            ?>
<?php 
        require ("../connection.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
$admin_name = $_POST['name'];
$admin_email = $_POST['email'];
$admin_password = $_POST['password'];
$confirm_pass = $_POST["confirm_pass"];
if ($admin_password == $confirm_pass) {
    $hash = password_hash($admin_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `admin` (`admin_name`,  `admin_email`, `admin_password`) VALUES ('$admin_name', '$admin_email', '$hash')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // User successfully registered, show toaster message and redirect
        echo '<script>
                alert("Registration successful.");
                window.location.href = "manage_admins";
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
        ?>

<body class="hold-transition sidebar-mini">
    <?php include("navbar.php"); ?>
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
                                    <form method="POST" class="form">
                                        <div class="input-box">
                                            <label><i class="fa fa-user" aria-hidden="true"></i> Full Name</label>
                                            <input type="text" name="name" placeholder="Enter full name" required />
                                        </div>

                                        <div class="input-box">
                                            <label><i class="fa fa-envelope" aria-hidden="true"></i> Email
                                                Address</label>
                                            <input type="text" name="email" ID="email" placeholder="Enter email address"
                                                required />
                                        </div>

                                        <div class="column">
                                            <div class="input-box">
                                                <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                                                <input type="Password" name="password" placeholder="Enter Password"
                                                    required />
                                            </div>
                                            <div class="input-box">
                                                <label><i class="fa fa-lock" aria-hidden="true"></i> Confirm
                                                    Password</label>
                                                <input type="password" name="confirm_pass"
                                                    placeholder="Confirm Password" required />
                                            </div>
                                        </div>

                                        <!-- Center the button -->
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