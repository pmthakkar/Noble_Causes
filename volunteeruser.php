<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="volunteer.css?v=2">
</head>

<body>
    <?php include ("navbar2.php"); ?>



    <?php
    require ("connection.php");


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $v_name = mysqli_real_escape_string($conn, $_POST["name"]);
        $v_phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $v_email = mysqli_real_escape_string($conn, $_POST["email"]);
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
            $sql = "INSERT INTO `volunteers` (`v_name`, `v_phone`, `v_email`, `v_gender`, `v_street`, `v_city`, `v_zip`, `v_time`) VALUES ('$v_name', '$v_phone', '$v_email', '$v_gender', '$v_street', '$v_city', '$v_zip', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // User successfully registered, show toaster message
                echo '<script>
                            alert("Registration successful. Password will be provided by Admin.");
                          </script>';
            } else {
                // Registration failed, show error message
                echo '<script>
                            alert("Registration failed. Please try again.");
                          </script>';
            }
        }
    }
    ?>

    <!-- ******
        HTML 
    *******  -->

    <div class="container-fluid p-0">
        <div class="volfirst col-12 mt-4">

        </div>
    </div>

    <div class="container">
        <div class="row featurette mt-5">
            <div class="col-md-7 order-md-1 order-sm-2 mt-4 part1" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 howhelp">How You Can Help? </h2>
                <p class="part1p">Become a vital part of our mission by volunteering your time and skills. Whether
                    you're passionate
                    about ensuring everyone has access to nutritious food or you believe in the power of literature to
                    transform lives, your contribution matters.</p>
                <h4 style="color: darkslateblue; font-weight: 470;">Volunteer Opportunities:</h4>

                <p class="part1p"><b>Food Distribution Team:</b> Assist in sorting, packing, and distributing food to
                    support individuals and families facing food insecurity in our community. Make a significant impact
                    on combating hunger.</p>

                <p class="part1p"><b>Book Drive Team:</b> Join efforts to collect, organize, and distribute books to
                    underserved communities, promoting literacy and a passion for learning.</p>
            </div>
            <div class="col-md-5 order-md-2 order-sm-1 mt-5 part1img">
                <img src="images/v1.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row form-container pb-4">
            <div class="col-md-6 image-container">
                <img src="images/vol1.jpg" alt="Image" class="img-fluid" />
            </div>
            <div class="col-md-6 form-content">
                <h3 class="text-center"><b>Join Our Team</b></h3>
                <form method="POST">
                    <div class="form-group m-0">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name"
                            required />
                    </div>

                    <div class="form-group m-0">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email"
                            required />
                    </div>
                    <div class="form-group m-0">
                        <label for="phone">Phone:</label>
                        <input type="phone" id="phone" name="phone" class="form-control"
                            placeholder="Enter your Phone number" required />
                    </div>
                    <div class="gender-box m-2">
                        <h6><i class="fa fa-mars" aria-hidden="true"></i> Gender:</h6>
                        <div class="gender-option" style="display: flex; gap: 20px">
                            <div class="gender">
                                <input type="radio" id="check-male" name="gender" value="male" />
                                <label for="check-male">Male</label>
                            </div>
                            <div class="gender">
                                <input type="radio" id="check-female" name="gender" value="female" />
                                <label for="check-female">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-0">
                        <label for="address">Address:</label>
                        <input type="text" id="street" name="street" class="form-control"
                            placeholder="Enter your Street" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="city" class="form-control" placeholder="Enter your city"
                                required />
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="zip_code" class="form-control" placeholder="Enter your Zip code"
                                required />
                        </div>
                    </div>

                    <button type="submit" class="m-0">Submit</button>
                </form>
            </div>
        </div>
    </div>



    <?php include ("footer.php"); ?>
    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>