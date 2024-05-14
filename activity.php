<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CSS Link -->
    <link rel="stylesheet" href="profile.css">
    <style>
        .book-card img {
            width: 100%;
            height: 230px;
            object-fit: fill;
        }

        .card {
            margin-top: 20px;
        }

        @media screen and (max-width: 480px) {

            .table-author,
            .author {
                display: none;
            }

            .table-course,
            .course {
                display: none;
            }

            .type {
                display: none;
            }
        }
    </style>
    <title>User Activity</title>
</head>

<body>

    <!-- Bcak to home button -->
    <div class="backtohome mt-4 ml-5">
        <li class="col-md-12"><a href="index"> <i class='fas fa-angle-left' style='font-size:15px'></i>
                <b> Back To Home </b>
            </a></li>
    </div>

    <?php
    session_start();
    if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    } else {
        header("Location:login");
    }
    ?>
    <?php
    require 'connection.php';
    include "profile_navbar.php";
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `users` WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="profile-info col-md-9">
            <div class="panel">

                <h4 class="text-center mt-2">Book Donations</h4>
                <table class="table">

                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th class="author">Author</th>
                            <th class="course">Course</th>
                            <th class="description" style="display: none">desciption</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM donate_book WHERE user_id = $user_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr class="details">';
                                echo '    <td><img class="table-image" src="BookImage/' . $row['image'] . '" alt="' . $row['title'] . '" height="50" width="50"></td>';
                                echo '    <td class="table-title">' . $row['title'] . '</td>';
                                echo '    <td class="table-author">' . $row['author'] . '</td>';
                                echo '    <td class="table-course">' . $row['course'] . '</td>';
                                echo '    <td class="table-description" style="display: none">' . $row['description'] . '</td>';
                                echo '    <td class="table-status" style="display: none">' . $row['status'] . '</td>';
                                echo '    <td class="table-time" style="display: none">' . $row['time'] . '</td>';
                                echo '    <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bookModal"> View
                </button></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No books found</td></tr>';
                        }
    }
    ?>
                </tbody>
            </table>


            <!-- Modal -->
            <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookModalLabel">Book Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="" class="img-fluid mx-auto" alt="" style="height: 400px; width: 350px;">
                            <table class="table mt-3">
                                <tbody>
                                    <tr>
                                        <td>Title:</td>
                                        <td class="modal-title"></td>
                                    </tr>
                                    <tr>
                                        <td>Author:</td>
                                        <td class="modal-author"></td>
                                    </tr>
                                    <tr>
                                        <td>Course:</td>
                                        <td class="modal-course"></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td class="modal-desc"></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td class="modal-status"></td>
                                    </tr>
                                    <tr>
                                        <td>Donation Date:</td>
                                        <td class="modal-time"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#bookModal').on('show.bs.modal', function (event) {

                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var bookImage = button.closest('.details').find('.table-image').attr('src');
                    var bookTitle = button.closest('.details').find('.table-title').text();
                    var bookAuthor = button.closest('.details').find('.table-author').text();
                    var bookCourse = button.closest('.details').find('.table-course').text();
                    var bookDesc = button.closest('.details').find('.table-description').text();
                    var bookStatus = button.closest('.details').find('.table-status').text();
                    var bookDate = button.closest('.details').find('.table-time').text();

                    var modal = $(this);
                    modal.find('.modal-body img').attr('src', bookImage);
                    modal.find('.modal-body .modal-title').text(bookTitle);
                    modal.find('.modal-body .modal-author').text(bookAuthor);
                    modal.find('.modal-body .modal-course').text(bookCourse);
                    modal.find('.modal-body .modal-desc').text(bookDesc);
                    modal.find('.modal-body .modal-status').text(bookStatus);
                    modal.find('.modal-body .modal-time').text(bookDate);
                });
            </script>


            <h4 class="text-center mt-2">Food Donations</h4>
            <table class="table">

                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Frequency</th>
                        <th class="type">Type</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th style="display: none">Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM donate_food WHERE user_id = $user_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr class="fdetails">';

                            echo '    <td class="table-name">' . $row['foodname'] . '</td>';
                            echo '    <td class="table-frequency">' . $row['freq_of_donation'] . '</td>';
                            echo '    <td class="table-type">' . $row['food_type'] . '</td>';
                            echo '    <td class="table-validity">' . $row['validity'] . '</td>';
                            echo '    <td style="display: none" class="table-fstatus">' . $row['status'] . '</td>';
                            echo '    <td style="display: none" class="table-ftime">' . $row['time'] . '</td>';
                            echo '    <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#foodModal"> View
                </button></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No books found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <div class="modal fade" id="foodModal" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="foodModalLabel">Food Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">

                            <table class="table mt-3">
                                <tbody>
                                    <tr>
                                        <td>Food Name:</td>
                                        <td class="modal-name"></td>
                                    </tr>
                                    <tr>
                                        <td>Frequency of Donation:</td>
                                        <td class="modal-frequency"></td>
                                    </tr>
                                    <tr>
                                        <td>Food Type:</td>
                                        <td class="modal-type"></td>
                                    </tr>
                                    <tr>
                                        <td>Validity:</td>
                                        <td class="modal-validity"></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td class="modal-fstatus"></td>
                                    </tr>
                                    <tr>
                                        <td>Donation Date:</td>
                                        <td class="modal-ftime"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#foodModal').on('show.bs.modal', function (event) {

                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var foodName = button.closest('.fdetails').find('.table-name').text();
                    var foodFrequency = button.closest('.fdetails').find('.table-frequency').text();
                    var foodType = button.closest('.fdetails').find('.table-type').text();
                    var foodValidity = button.closest('.fdetails').find('.table-validity').text();

                    var foodStatus = button.closest('.fdetails').find('.table-fstatus').text();
                    var foodDate = button.closest('.fdetails').find('.table-ftime').text();

                    var modal = $(this);

                    modal.find('.modal-body .modal-name').text(foodName);
                    modal.find('.modal-body .modal-frequency').text(foodFrequency);
                    modal.find('.modal-body .modal-type').text(foodType);
                    modal.find('.modal-body .modal-validity').text(foodValidity);
                    modal.find('.modal-body .modal-fstatus').text(foodStatus);
                    modal.find('.modal-body .modal-ftime').text(foodDate);
                });
            </script>



        </div>
    </div>





    </div>
    </div>

    <!-- Profile div is finish -->

    <?php
    include ("footer.php");
    ?>


</body>

</html>