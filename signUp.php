<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SignUp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="signUp.css?v=3" />
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.form');
            const phoneInput = document.getElementById('phone');
            const emailInput = document.getElementById('email');
            const genderInputs = document.querySelectorAll('input[name="gender"]');

            form.addEventListener('submit', function (event) {
                if (!isValidPhone(phoneInput.value)) {
                    alert('Please enter a valid phone number.');
                    event.preventDefault();
                }

                if (!isValidEmail(emailInput.value)) {
                    alert('Please enter a valid email address.');
                    event.preventDefault();
                }

                if (!isGenderSelected(genderInputs)) {
                    alert('Please select a gender.');
                    event.preventDefault();
                }
            });

            function isValidPhone(phone) {
                // Simple phone number validation, you can customize it based on your requirements
                const phoneRegex = /^\d{10}$/; // Assuming a 10-digit phone number
                return phoneRegex.test(phone);
            }

            function isValidEmail(email) {
                // Simple email validation, you can use a more robust regex for better validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isGenderSelected(genderInputs) {
                for (let i = 0; i < genderInputs.length; i++) {
                    if (genderInputs[i].checked) {
                        return true;
                    }
                }
                return false;
            }
        });
    </script>


</head>

<body>
    <?php
    require ("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $confirm_pass = mysqli_real_escape_string($conn, $_POST["confirm_pass"]);
        $gender = $_POST['gender'];
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $zip_code = mysqli_real_escape_string($conn, $_POST['zip_code']);
        if ($password == $confirm_pass) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `phone`, `email`, `password`, `gender`, `street`, `city`, `zip_code`, `time`) VALUES ('$name', '$phone', '$email', '$hash', '$gender', '$street', '$city', '$zip_code', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // User successfully registered, show toaster message and redirect
                echo '<script>
                        alert("Registration successful. Redirecting to login page...");
                        window.location.href = "login";
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
    <div>
        <?php include ("navbar2.php"); ?>
    </div>
    <section class="container">
        <header>Registration Form</header>
        <form action="#" method="POST" class="form">


            <div class="input-box">
                <label><i class="fa fa-user" aria-hidden="true"></i> Full Name</label>
                <input type="text" name="name" placeholder="Enter full name" required />
            </div>



            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-phone-square" aria-hidden="true"></i> Phone Number</label>
                    <input type="number" name="phone" id="phone" placeholder="Enter phone number" required />
                </div>


                <div class="input-box">
                    <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                    <input type="text" name="email" ID="email" placeholder="Enter email address" required />
                </div>
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                    <input type="Password" name="password" placeholder="Enter Password" required />
                </div>
                <div class="input-box">
                    <label><i class="fa fa-lock" aria-hidden="true"></i> Confirm Password</label>
                    <input type="password" name="confirm_pass" placeholder="Confirm Password" required />
                </div>
            </div>

            </div>
            <div class="gender-box">
                <h3><i class="fa fa-mars" aria-hidden="true"></i> Gender</h3>
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
            <div class="input-box address">
                <label><i class="fa fa-address-card" aria-hidden="true"></i> Address</label>
                <input type="text" name="street" placeholder="Enter street address" required />

                <div class="column">
                    <input type="text" name="city" placeholder="Enter your city" required />
                    <input type="text" name="zip_code" placeholder="Enter your Zip code" required />
                </div>

            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>


    <div class="sfooter">
        <?php include ("footer.php") ?>
    </div>
</body>

</html>