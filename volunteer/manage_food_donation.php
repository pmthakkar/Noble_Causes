<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage FoodDonation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="modal.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php
    session_start();
    if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    } else {
        header("Location:../login.php");
    }
    include "../connection.php";
    $update = false;
    $delete = false;
    $confirm_pickup = false;
    $collect = false;
    if (isset ($_GET['delete'])) {
        $food_id = $_GET['delete'];
        $sql = "DELETE FROM `donate_food` WHERE `food_id` = $food_id";
        $result = mysqli_query($conn, $sql);
        $delete = true;

    }
    if (isset ($_GET["collect"])) {
        $food_id = $_GET["collect"];
        $sql = "UPDATE `donate_food` SET `status` = 'collected' WHERE `donate_food`.`food_id` = $food_id;";
        $result = mysqli_query($conn, $sql);
        $collect = true;
    }
    if (isset ($_GET["confirm_pickup"])) {
        $food_id = $_GET["confirm_pickup"];
        $v_id = $_SESSION['v_id'];
        $sql = "UPDATE `donate_food` SET `status` = 'confirm_pickup',`v_id`='$v_id' WHERE `donate_food`.`food_id` = $food_id;";
        $result = mysqli_query($conn, $sql);
        $confirm_pickup = true;
    }

    if ($delete) {
        echo '<div id="deleteToast" class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true" style="margin-top: 15px; z-index: 1000000;">
        <div class="toast-body">
            Record deleted successfully!
        </div>
        </div>';
    }

    ?>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';


    if (isset ($_GET["confirm_pickup"])) {
        $food_id = $_GET["confirm_pickup"];
        $u_email = $_GET["email"];

        try {


            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thakkarpm00@gmail.com';
            $mail->Password = 'mcicgcqfelwcqebf';
            $mail->SMTPSecure = 'tsl';
            $mail->Port = 587;
            $mail->setFrom('thakkarpm00@gmail.com');
            $mail->addAddress($u_email);

            $mail->isHTML(true);
            $mail->Subject = 'Your Donation Pickup is Confirmed';
            $mail->Body = 'Your Donation will be collected by our volunteer so be ready with your donation.Volunteer will come within thirty minutes. If kind of query you can contact with our volunteer using Contact no: 9825213051';
            $mail->send();

        } catch (Exception $e) {
            echo 'Email sending failed. Error: ', $mail->ErrorInfo;
        }
    }

    ?>


    <div class="wrapper">
        <!-- Navbar -->
        <?php include ("navbar.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Food Donations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage FoodDonation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Donor Phone</th>
                                                <th>Food Name</th>
                                                <th>Food Validity</th>
                                                <!-- <th>Status</th> -->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $food_id = 0;
                                            $v_id = $_SESSION['v_id'];
                                            $sql = "SELECT donate_food.user_id,users.name,users.phone,users.email,users.gender,users.street,users.city,users.zip_code,donate_food.food_id,donate_food.food_type,donate_food.freq_of_donation,donate_food.specifications,donate_food.foodname,donate_food.validity From donate_food inner join users on donate_food.user_id=users.user_id where `status`='confirm_pickup' AND donate_food.v_id=$v_id";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $food_id = $food_id + 1;
                                                echo "<tr>
                                            <td>" . $food_id . "</td>
                                            <td>" . ucfirst($row['name']) . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            <td>" . $row['foodname'] . "</td>
                                            <td>" . $row['validity'] . "</td>
                                            <td>
                                            <button class='collect center btn btn-sm btn-success' id='c" . $row['food_id'] . "'>Collect</button>
                                        
                                            </td>
                                          </tr>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Donor Name</th>
                                                <th>Donor Phone</th>
                                                <th>Food Name</th>
                                                <th>Food Validity</th>
                                                <!-- <th>Status</th> -->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $food_id = 0;
                                            $v_zip = $_SESSION['v_zip'];
                                            $sql = "SELECT
                                            donate_food.user_id,
                                            users.name,
                                            users.phone,
                                            users.email,
                                            users.gender,
                                            users.street,
                                            users.city,
                                            users.zip_code,
                                            donate_food.food_id,
                                            donate_food.food_type,
                                            donate_food.freq_of_donation,
                                            donate_food.specifications,
                                            donate_food.foodname,
                                            donate_food.validity,
                                            donate_food.status
                                            
                                            From donate_food 
                                            INNER JOIN users on donate_food.user_id=users.user_id
                                        
                                            
                                            where donate_food.status='approved'
                                            AND 
                                            users.zip_code = $v_zip";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $food_id = $food_id + 1;
                                                echo "<tr>
                                            <td>" . $food_id . "</td>
                                            <td>" . ucfirst($row['name']) . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            <td>" . $row['foodname'] . "</td>
                                            <td>" . $row['validity'] . "</td>
                                            <td>
                                            <button class='view btn btn-sm btn-info' onclick='showFoodDetails(\"" . $food_id . "\", \"" . ucfirst($row['name']) . "\",\"" . ($row['phone']) . "\",\"" . ($row['email']) . "\", \"" . $row['gender'] . "\",\"" . ($row['foodname']) . "\",\"" . ($row['validity']) . "\", \"" . $row['freq_of_donation'] . "\",\"" . $row['food_type'] . "\",\"" . $row['specifications'] . "\",\"" . $row['street'] . "\",\"" . $row['city'] . "\", \"" . $row['zip_code'] . "\")'>View</button> 
                                            <button class='confirm_pickup center btn btn-sm btn-success' id='c" . $row['food_id'] . "'  data-email='" . $row['email'] . "'>Confirm Pickup</button>
                                            <button class='delete center btn btn-sm btn-danger' id='d" . $row['food_id'] . "'>Delete</button>
                                            </td>
                                          </tr>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>
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
            <div id="foodModal" class="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div id="foodDetails"></div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var deleteToast = new bootstrap.Toast(document.getElementById('deleteToast'));
                    deleteToast.show();

                    // Close the toast after 3 seconds
                    setTimeout(function () {
                        deleteToast.hide();
                    }, 30000);
                });
            </script>

            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script>
            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    food_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this user?")) {
                        console.log("yes");
                        window.location = `manage_food_donation?delete=${food_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>
        <script>
            collects = document.getElementsByClassName('collect');
            Array.from(collects).forEach((element) => {
                element.addEventListener("click", (e) => {
                    food_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to collect this donation?")) {
                        console.log("yes");
                        window.location = `manage_food_donation?collect=${food_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>
        <script>
            confirm_pickups = document.getElementsByClassName('confirm_pickup');
            Array.from(confirm_pickups).forEach((element) => {
                element.addEventListener("click", (e) => {
                    food_id = e.target.id.substr(1);
                    email = e.target.getAttribute('data-email');


                    if (confirm("Are you sure you want to confirm_pickup this donation?")) {
                        console.log("yes");
                        confirmPickup(food_id, email);

                    } else {
                        console.log("no");
                    }
                })
            })

            function confirmPickup(food_id, email) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "manage_food_donation?confirm_pickup=" + food_id + "&email=" + email, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                    }
                };
                xhr.send();
            }
        </script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script>
            // Function to show user details in modal
            function showFoodDetails(food_id, name, phone, email, gender, foodname, validity, freq_of_donation, food_type,
                specifications, street, city,
                zip_code) {
                // Prepare the user details HTML
                var foodDetailsHtml = "<h2>Donation Details</h2>" +
                    "<table class='table'>" +
                    "<tr><td><strong>No:</strong> </td><td>" + food_id + "</td></tr>" +
                    "<tr><td><strong>Donor Name:</strong> </td><td>" + name + "</td></tr>" +
                    "<tr><td><strong>Donor Phone:</strong> </td><td>" + phone + "</td></tr>" +
                    "<tr><td><strong>Donor Email:</strong> </td><td>" + email + "</td></tr>" +
                    "<tr><td><strong>Donor Gender:</strong> </td><td>" + gender + "</td></tr>" +
                    "<tr><td><strong>Food Name:</strong> </td><td>" + foodname + "</td></tr>" +
                    "<tr><td><strong>Food Validity:</strong> </td><td>" + validity + "</td></tr>" +
                    "<tr><td><strong>Frequency Donation:</strong> </td><td>" + freq_of_donation + "</td></tr>" +
                    "<tr><td><strong>Food Type:</strong> </td><td>" + food_type + "</td></tr>" +
                    "<tr><td><strong>Specifications:</strong> </td><td>" + specifications + "</td></tr>" +
                    "<tr><td><strong>Address:</strong> </td><td>" + street + "," + city + "," + zip_code + "</td></tr>"
                "</table>";

                // Display the user details in the modal
                document.getElementById("foodDetails").innerHTML = foodDetailsHtml;

                // Show the modal
                document.getElementById("foodModal").style.display = "block";
            }

            // Close the modal when the close button is clicked
            document.getElementsByClassName("close")[0].onclick = function () {
                document.getElementById("foodModal").style.display = "none";
            }

            // Close the modal when the user clicks outside of it
            window.onclick = function (event) {
                if (event.target == document.getElementById("foodModal")) {
                    document.getElementById("foodModal").style.display = "none";
                }
            }
        </script>
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://adminlte.io">P_M_THAKKAR</a>.</strong> All rights
            reserved.
        </footer>

</body>

</html>