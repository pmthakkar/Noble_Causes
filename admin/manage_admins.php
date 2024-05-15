<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Admins</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
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
    require ("../encrypt_decrypt.php");

    if (isset ($_GET['delete'])) {
        $delete = $_GET['delete'];
        $d_admin_id = decrypt_number(32, $delete);
        $sql = "DELETE FROM `admin` WHERE `admin_id` = $d_admin_id";
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



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $admin_id = $_POST['idedit'];
        $admin_name = $_POST['admin_name_edit'];
        $admin_email = $_POST['admin_email_edit'];

        $sql = "UPDATE `admin` SET `admin_name` = '$admin_name', `admin_email` = '$admin_email' where admin_id=$admin_id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $update = true;
        } else {
            echo "We are not able to update your profile";
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
                            <button id="myButton" style="font-size:20px;
                        text-decoration: none;
                        margin-bottom: 6px;
                        background-color: #3E8DA8;
                        color:#fff;
                        border: 1px solid grey;
                        border-radius: 5px;">Add New Admin</button>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active">Manage Admins</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- /.content -->
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
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $sql = "SELECT * FROM `admin`";
                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $count = $count + 1;
                                                echo "<tr class='details'>
                                                <td>" . $count . "</td>
                                                <td class='name'>" . ucfirst($row['admin_name']) . "</td>
                                                <td class='email'>" . $row['admin_email'] . "</td>
                                                <td><button id=" . $row['admin_id'] . " data-id='" . $row['admin_id'] . "' data-name='" . $row['admin_name'] . "' data-email='" . $row['admin_email'] . "'  class='edit btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button> 
                                                <button class='delete btn btn-sm btn-danger' data-id=" . encrypt_number(32, $row['admin_id']) . ">Delete</button>
 
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



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="editModal1"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Edit Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST">
                            <input type="hidden" value="" name="idedit" id="idedit">
                            <div class="form-group">
                                <label for="editAdminName">Name:</label>
                                <input type="text" id="mname" class="form-control" name="admin_name_edit" value="">
                            </div>
                            <div class="form-group">
                                <label for="editAdminEmail">Email:</label>
                                <input type="email" id="memail" class="form-control" name="admin_email_edit" value="">
                            </div>
                            <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <?php include "footer.php"; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        e.preventDefault(); // Prevents the default action of the anchor tag
                        const admin_id = e.target.dataset.id;
                        if (confirm("Are you sure you want to delete this admin?")) {
                            window.location.href =
                                `manage_admins.php?delete=${admin_id}`;
                        }
                    });
                });
            });
        </script>

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
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        $('.edit').click(function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            // var date = $(this).data('date');     
            console.log("bhghj", name);

            $('#idedit').val(id);
            $('#mname').val(name);
            $('#memail').val(email);

        });
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
    <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
            location.href = "add_admin";
        };
    </script>

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