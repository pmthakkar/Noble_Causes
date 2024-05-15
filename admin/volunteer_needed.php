<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Required Area</title>

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
    if (isset ($_GET['delete'])) {
        $req_v_id = $_GET['delete'];
        $sql = "DELETE FROM `volunteer_req_area` WHERE `req_v_id` = $req_v_id";
        $result = mysqli_query($conn, $sql);
        $delete = true;


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
                            <h1>Volunteer Require Area</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Volunteer Require Area</li>
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
                                                <th>Street</th>
                                                <th>City</th>
                                                <th>Zip Cpde</th>
                                                <th>Donations</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $v_req_id = 0;
                                            $sql = "SELECT * FROM `volunteer_req_area`";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $v_req_id = $v_req_id + 1;
                                                echo "<tr>
                                            <td>" . $v_req_id . "</td>
                                            <td>" . ucfirst($row['v_street']) . "</td>
                                            <td>" . $row['v_city'] . "</td>
                                            <td>" . $row['v_zip'] . "</td>
                                            <td>" . $row['v_req_donations'] . "</td>
                                            <td>
                                            <button class='add btn btn-sm btn-success'>Add Volunteer</button>
                                                <button class='delete center btn btn-sm btn-danger' id='d" . $row['req_v_id'] . "'>Delete</button>
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
                    req_v_id = e.target.id.substr(1);

                    if (confirm("Are you sure you want to delete this Area?")) {
                        console.log("yes");
                        window.location = `volunteer_needed?delete=${req_v_id}`;

                    } else {
                        console.log("no");
                    }
                })
            })
        </script>
        <script>
            adds = document.getElementsByClassName('add');
            Array.from(adds).forEach((element) => {
                element.addEventListener("click", (e) => {
                    v_req_id = e.target.id.substr(1);

                    window.location = `add_volunteer`;

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
        <?php include "footer.php"; ?>

</body>

</html>