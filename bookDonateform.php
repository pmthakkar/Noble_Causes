<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>BookDonateForm</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="donateform.css?v=2" />

</head>

<body>
    <?php
    session_start();
    if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    } else {
        header("Location:login");
    } ?>
    <?php
    require ("connection.php");

    $insert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $author = mysqli_real_escape_string($conn, $_POST["author"]);
        $course = mysqli_real_escape_string($conn, $_POST["course"]);
        $user_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $date = $_POST["date"];
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        if (isset ($_POST['submit']) && isset ($_FILES['image'])) {

            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {
                if ($img_size > 5000000) {
                    $em = "Sorry, your file is too large.";
                    echo '<script>alert("' . $em . '")</script>';
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'BookImage/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);


                        $sql = "INSERT INTO `donate_book` (`user_id`, `title`, `author`, `course`, `pickup_date`, `image`, `description`) VALUES ('$user_id', '$title', '$author', '$course', '$date', '$new_img_name', '$description');";
                        $result = mysqli_query($conn, $sql);
                        $sql2 = "SELECT * from users where user_id=$user_id";
                        $result2 = mysqli_query($conn, $sql2);
                        $row = mysqli_fetch_array($result2);
                        $zip_code = $row['zip_code'];
                        $city = $row['city'];
                        $street = $row['street'];


                        $sql3 = "SELECT v_zip from volunteers where v_zip=$zip_code";
                        $result3 = mysqli_query($conn, $sql3);
                        if ($result3->num_rows > 0) {
                            $_SESSION['fd_message'] = "Thank You for donating Book to needy person!!";
                        } else {
                            $sql5 = "SELECT * FROM volunteer_req_area where `v_street` = '$street' and `v_city` = '$city' and `v_zip` = '$zip_code'";
                            $result5 = mysqli_query($conn, $sql5);
                            if ($result5->num_rows > 0) {
                                $row5 = mysqli_fetch_assoc($result5);
                                $req_v_id = $row5['req_v_id'];
                                $sql6 = "UPDATE volunteer_req_area SET v_req_donations = v_req_donations + 1 WHERE req_v_id = $req_v_id";
                                $result6 = mysqli_query($conn, $sql6);
                                $_SESSION['fd_message'] = "Thank You for donating book to needy person!!There is no volunteer in this area we will assign soon!";
                            } else {

                                $sql4 = "INSERT INTO `volunteer_req_area`( `v_street`, `v_city`, `v_zip`, `v_req_donations`) VALUES ('$street','$city','$zip_code',1)";
                                $result4 = mysqli_query($conn, $sql4);
                                $_SESSION['fd_message'] = "Thank You for donating book to needy person!!There is no volunteer in this area we will assign soon!";
                            }
                        }
                        header("Location:education");

                    } else {
                        $em = "You can't upload files of this type";
                        echo '<script>alert("' . $em . '")</script>';
                    }
                }
            } else {
                $em = "unknown error occurred in file upload!";
                echo '<script>alert("' . $em . '")</script>';
            }
        }
    }


    ?>
    <div>
        <?php include ("navbar2.php") ?>
    </div>
    <section class="container">
        <header>Donate Book</header>
        <form action="#" class="form" method="POST" id="prog" enctype="multipart/form-data">

            <div class="input-box">
                <label><i class="fa fa-book" aria-hidden="true"></i> Book Title</label>
                <input type="text" name="title" placeholder="Enter Book Title" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-user" aria-hidden="true"></i> Author Name</label>
                    <input type="text" name="author" placeholder="Enter Author Name" required />
                </div>
                <div class="select-box">
                    <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Courses</label>
                    <select name="course">
                        <option value="jee">JEE</option>
                        <option value="neet">NEET</option>
                        <option value="upsc">UPSC</option>
                        <option value="gpsc">GPSC</option>
                    </select>

                </div>
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> Pickup Date</label>
                    <input type="date" name="date" placeholder="Pickup Date" min="<?php echo date('Y-m-d'); ?>"
                        required />
                </div>
                <div class="image-box">
                    <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Book Image</label>
                    <input type="file" name="image" required />
                </div>
            </div>
            <div class="input-box">
                <label> <i class="fa fa-edit"></i> Book Description</label>
                <input type="textarea" name="description" placeholder="Enter Description" required />
            </div>


            <button type="submit" name="submit">Donate</button>
        </form>
    </section>

    <div class="sfooter">
        <?php include ("footer.php") ?>
    </div>
</body>

</html>