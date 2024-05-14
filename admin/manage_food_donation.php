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
    $approve = false;
    if (isset ($_GET['delete'])) {
        $food_id = $_GET['delete'];
        $sql = "DELETE FROM `donate_food` WHERE `food_id` = $food_id";
        $result = mysqli_query($conn, $sql);
        $delete = true;

    }
    if (isset ($_GET["approve"])) {
        $food_id = $_GET["approve"];
        $sql = "UPDATE `donate_food` SET `status` = 'approved' WHERE `donate_food`.`food_id` = $food_id;";
        $result = mysqli_query($conn, $sql);
        $approve = true;
    }

    if ($delete) {
        echo '<div id="deleteToast" class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true" style="margin-top: 15px; z-index: 1000000;">
        <div class="toast-body">
            Record deleted successfully!
        </div>
        </div>';
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
                                            $sql = "SELECT donate_food.user_id,users.name,users.phone,users.email,users.gender,users.street,users.city,users.zip_code,donate_food.food_id,donate_food.food_type,donate_food.freq_of_donation,donate_food.specifications,donate_food.foodname,donate_food.validity From donate_food inner join users on donate_food.user_id=users.user_id where `status`='pending'";
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
                                            <button class='approve center btn btn-sm btn-success' id='a" . $row['food_id'] . "'>Approve</button>
                                            <button class='delete center btn btn-sm btn-danger' id='d" . $row['food_id'] . "'>Delete</button>
                                            <button class='view btn btn-sm btn-info' onclick='showFoodDetails(\"" . $food_id . "\", \"" . ucfirst($row['name']) . "\",\"" . ($row['phone']) . "\",\"" . ($row['email']) . "\", \"" . $row['gender'] . "\",\"" . ($row['foodname']) . "\",\"" . ($row['validity']) . "\", \"" . $row['freq_of_donation'] . "\",\"" . $row['food_type'] . "\",\"" . $row['specifications'] . "\",\"" . $row['street'] . "\",\"" . $row['city'] . "\", \"" . $row['zip_code'] . "\")'>View</button> 
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
            document.addEventListener('DOMContentLoaded', function() {
                var deleteToast = new bootstrap.Toast(document.getElementById('deleteToast'));
                deleteToast.show();

                // Close the toast after 3 seconds
                setTimeout(function() {
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
        approves = document.getElementsByClassName('approve');
        Array.from(approves).forEach((element) => {
            element.addEventListener("click", (e) => {
                food_id = e.target.id.substr(1);

                if (confirm("Are you sure you want to approve this donation?")) {
                    console.log("yes");
                    window.location = `manage_food_donation?approve=${food_id}`;

                } else {
                    console.log("no");
                }
            })
        })
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
        document.getElementsByClassName("close")[0].onclick = function() {
            document.getElementById("foodModal").style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById("foodModal")) {
                document.getElementById("foodModal").style.display = "none";
            }
        }
        </script>
        <script>
        $(function() {
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
        <?php include "footer.php"; ?>

</body>

</html>