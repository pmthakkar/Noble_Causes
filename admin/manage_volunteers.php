<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Volunteers</title>

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

    $reject = false;
    if (isset ($_GET['reject'])) {
        $v_id = $_GET['reject'];
        $sql = "UPDATE `volunteers` SET  `status`='rejected' WHERE `volunteers`.`v_id` = $v_id;";
        $result = mysqli_query($conn, $sql);
        $reject = true;


    }

    if ($reject) {
        echo '<div id="rejectToast" class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-4" role="alert" aria-live="assertive" aria-atomic="true" style="margin-top: 15px; z-index: 1000000;">
        <div class="toast-body">
            Record rejectd successfully!
        </div>
        </div>';


    }

    ?>
    <?php
    function generateRandomString($length = 6)
    {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $randomString = substr(str_shuffle($characters), 0, $length);

        return $randomString;
    }

    $randomString = generateRandomString();

    $hash = password_hash($randomString, PASSWORD_DEFAULT);
    if (isset ($_GET["approve"])) {
        $v_id = $_GET["approve"];
        $sql = "UPDATE `volunteers` SET `v_password` = '$hash' , `status`='approved' WHERE `volunteers`.`v_id` = $v_id;";
        $result = mysqli_query($conn, $sql);
        $approve = true;
    }
    ?>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';


    if (isset ($_GET["approve"])) {
        $v_id = $_GET["approve"];
        $v_email = $_GET["email"];
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
            $mail->addAddress($v_email);

            $mail->isHTML(true);
            $mail->Subject = 'Password For Access The Volunteer role in Noble Causes';
            $mail->Body = 'Your Password is ' . $randomString . ' . Using this password you can login to noble causes';
            $mail->send();

        } catch (Exception $e) {
            echo 'Email sending failed. Error: ', $mail->ErrorInfo;
        }
    }

    ?>
    <?php




    if (isset ($_GET["reject"])) {
        $v_id = $_GET["reject"];
        $v_email = $_GET["email"];
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
            $mail->addAddress($v_email);

            $mail->isHTML(true);
            $mail->Subject = 'Rejected For Access The Volunteer role in Noble Causes';
            $mail->Body = 'Thank You For Connecting with Noble Causes. Sorry,you are rejected as volunteer role in noble causes.';
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
                            <h1>Volunteers</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Volunteers</li>
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
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Zip_code</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $v_id = 0;
                                            $sql = "SELECT * FROM `volunteers` where status='pending'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $v_id = $v_id + 1;
                                                echo "<tr>
                                                <td>" . $v_id . "</td>
                                                <td>" . ucfirst($row['v_name']) . "</td>
                                                <td>" . $row['v_phone'] . "</td>
                                                <td>" . $row['v_email'] . "</td>
                                                <td>" . $row['v_zip'] . "</td>
                                                <td> 
                                                <button class='view btn btn-sm btn-info' onclick='showVolunteerDetails(\"" . $v_id . "\", \"" . ucfirst($row['v_name']) . "\", \"" . $row['v_phone'] . "\", \"" . $row['v_email'] . "\",\"" . $row['v_gender'] . "\",\"" . $row['v_street'] . "\",\"" . $row['v_city'] . "\", \"" . $row['v_zip'] . "\")'>View</button> 
                                                <button class='approve btn btn-sm btn-success' id='a" . $row['v_id'] . "' data-email='" . $row['v_email'] . "'>Approve</button>

                                                <button class='reject btn btn-sm btn-danger' id=d" . $row['v_id'] . " data-email='" . $row['v_email'] . "'>Reject</button> 
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <div id="volunteerModal" class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="volunteerDetails"></div>
                </div>
            </div>
        </div>


        <?php include "footer.php"; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var rejectToast = new bootstrap.Toast(document.getElementById('rejectToast'));
            rejectToast.show();

            // Close the toast after 3 seconds
            setTimeout(function () {
                rejectToast.hide();
            }, 30000);
        });
    </script>
    <script>
        approves = document.getElementsByClassName('approve');
        Array.from(approves).forEach((element) => {
            element.addEventListener("click", (e) => {
                v_id = e.target.id.substr(1);
                v_email = e.target.getAttribute('data-email');

                if (confirm("Are you sure you want to approve this Volunteer?")) {
                    console.log("yes");
                    approveVolunteer(v_id, v_email);
                } else {
                    console.log("no");
                }
            })
        })

        function approveVolunteer(id, email) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "manage_volunteers?approve=" + id + "&email=" + email, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send();
        }
    </script>
    <script>
        rejects = document.getElementsByClassName('reject');
        Array.from(rejects).forEach((element) => {
            element.addEventListener("click", (e) => {
                v_id = e.target.id.substr(1);
                v_email = e.target.getAttribute('data-email');


                if (confirm("Are you sure you want to reject this Volunteer?")) {
                    console.log("yes");
                    rejectVolunteer(v_id, v_email);

                } else {
                    console.log("no");
                }
            })
        })

        function rejectVolunteer(id, email) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "manage_volunteers?reject=" + id + "&email=" + email, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send();
        }
    </script>
    <script>
        // Function to show user details in modal
        function showVolunteerDetails(v_id, v_name, v_phone, v_email, v_gender, v_street, v_city, v_zip) {
            // Prepare the user details HTML
            var volunteerDetailsHtml = "<h2>Volunteer Details</h2>" +
                "<table class='table'>" +
                "<tr><td><strong>Volunteer ID:</strong></td><td> " + v_id + "</td></tr>" +
                "<tr><td><strong>Name:</strong></td><td> " + v_name + "</td></tr>" +
                "<tr><td><strong>Phone:</strong></td><td> " + v_phone + "</td></tr>" +
                "<tr><td><strong>Email:</strong></td><td> " + v_email + "</td></tr>" +
                "<tr><td><strong>Gender:</strong></td><td>" + v_gender + "</td></tr>" +
                "<tr><td><strong>Address:</strong></td><td> " + v_street + "," + v_city + "," + v_zip + "</td></tr>";
            "</table>";
            // Display the user details in the modal
            document.getElementById("volunteerDetails").innerHTML = volunteerDetailsHtml;

            // Show the modal
            document.getElementById("volunteerModal").style.display = "block";
        }

        // Close the modal when the close button is clicked
        document.getElementsByClassName("close")[0].onclick = function () {
            document.getElementById("volunteerModal").style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function (event) {
            if (event.target == document.getElementById("volunteerModal")) {
                document.getElementById("volunteerModal").style.display = "none";
            }
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
    <!-- Page specific script -->
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
</body>

</html>