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
    <link rel="stylesheet" href="foodDonate.css?v=1" />

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $foodname = mysqli_real_escape_string($conn, $_POST['foodname']);
        $freq_of_donation = $_POST['frequency'];
        $food_type = $_POST['type'];
        $validity = $_POST['validity'];
        $specifications = mysqli_real_escape_string($conn, $_POST['specification']);
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO `donate_food` (`user_id`,`foodname`, `freq_of_donation`, `food_type`, `validity`, `specifications`) VALUES ('$user_id','$foodname', '$freq_of_donation', '$food_type', '$validity', '$specifications')";
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
            $_SESSION['fd_message'] = "Thank You for donating food to needy person!!";
        } else {
            $sql5 = "SELECT * FROM volunteer_req_area where `v_street` = '$street' and `v_city` = '$city' and `v_zip` = '$zip_code'";
            $result5 = mysqli_query($conn, $sql5);
            if ($result5->num_rows > 0) {
                $row5 = mysqli_fetch_assoc($result5);
                $req_v_id = $row5['req_v_id'];
                $sql6 = "UPDATE volunteer_req_area SET v_req_donations = v_req_donations + 1 WHERE req_v_id = $req_v_id";
                $result6 = mysqli_query($conn, $sql6);
                $_SESSION['fd_message'] = "Thank You for donating food to needy person!!There is no volunteer in this area we will assign soon!";
            } else {

                $sql4 = "INSERT INTO `volunteer_req_area`( `v_street`, `v_city`, `v_zip`, `v_req_donations`) VALUES ('$street','$city','$zip_code',1)";
                $result4 = mysqli_query($conn, $sql4);
                $_SESSION['fd_message'] = "Thank You for donating food to needy person!!There is no volunteer in this area we will assign soon!";
            }
        }
        header("Location:food");
    }
    ?>
    <div>
        <?php include ("navbar2.php") ?>
    </div>

    <section class="container">
        <header>Donate Food</header>
        <form action="#" class="form" method="POST">
            <div class="input-box">
                <label> <i class="fa-solid fa-bowl-food"></i> Food Name</label>
                <input type="text" name="foodname" placeholder="Enter Food Name" />
            </div>
            <div class="column">
                <div class="food-box">
                    <h3><i class="fa fa-clock-o" aria-hidden="true"></i> Frequency of Donation</h3>
                    <div class="frequency-option">
                        <div class="frequency">
                            <input type="radio" id="check-one" name="frequency" value="Onetime" />
                            <label for="check-one">One time</label>
                        </div>
                        <div class="frequency">
                            <input type="radio" id="check-daily" name="frequency" value="Daily" />
                            <label for="check-daily">Daily</label>
                        </div>

                    </div>
                </div>

                <div class="food-box">
                    <h3><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Food Type</h3>
                    <div class="type-option">
                        <div class="type">
                            <input type="radio" id="check-cook" name="type" value="Cooked" />
                            <label for="check-cook">Cooked</label>
                        </div>
                        <div class="type">
                            <input type="radio" id="check-raw" name="type" value="Raw" />
                            <label for="check-raw">Raw</label>
                        </div>
                        <div class="type">
                            <input type="radio" id="check-packed" name="type" value="Packed" />
                            <label for="check-packed">Packed</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="select-box">
                <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Food Validity</label>
                <select name="validity">
                    <option value="one day">One Day</option>
                    <option value="two-three days">Two-Three Days</option>
                    <option value="week">One Week</option>
                    <option value="more than week">More than Week</option>
                </select>
            </div>


            <div class="input-box">
                <label> <i class="fa fa-edit"></i> Specifications</label>
                <input type="textarea" name="specification"
                    placeholder="Enter Specifications if any like this food serve to cows or dogs etc.." />
            </div>


            <button type="submit">Donate</button>
        </form>
    </section>

    <div class="sfooter">
        <?php include ("footer.php") ?>
    </div>
</body>

</html>