<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Contact Us </title>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="contactUs.css?v=3">
</head>

<body>

    <?php
    session_start();
    ?>

    <div>
        <?php include ("navbar2.php") ?>
    </div>
    <?php
    require ("connection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $u_name = $_POST['username'];
        $u_email = $_POST['email'];
        $u_message = $_POST['message'];
        $sql = "INSERT INTO `contact_us` (`u_name`, `u_email`, `u_message`) VALUES ('$u_name', '$u_email', '$u_message');";
        $result = mysqli_query($conn, $sql);
    }
    ?>


    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $mail->addAddress($_POST['email']);

            $mail->isHTML(true);
            $mail->Subject = 'Contact With Noble Causes';
            $mail->Body = 'Thank You For Connecting with Us! We will Contact you soon';
            $mail->send();

        } catch (Exception $e) {
            echo 'Email sending failed. Error: ', $mail->ErrorInfo;
        }
    }
    ?>
    <div class="container">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="topic">Address</div>
                    <div class="text-one"><iframe style="width: 200px; border: none;"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAfqJHFi3ghTFSuuW5pIudu9Fq2pvoJzwc&maptype=satellite&zoom=15&q='.strtolower(Shakti 404 Shakti Complex, Shakti 404, 2nd Floor, Shakti 404, Sarkhej - Gandhinagar Hwy, opp. New Gurudwara, Thaltej).','.Ahmedabad, Gujarat 380054.'"
                            class="map" allowfullscreen>
                        </iframe></div>

                </div>
                <div class="phone details">
                    <i class="fas fa-phone-alt"></i>
                    <div class="topic">Phone</div>
                    <div class="text-one">+91 9825213051</div>

                </div>
                <div class="email details">
                    <i class="fas fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">charity@gmail.com</div>

                </div>
            </div>
            <div class="right-side">
                <div class="topic-text">Send us a message</div>
                <form action="" method="POST">
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Enter your name">
                    </div>
                    <div class="input-box">
                        <input type="text" name="email" placeholder="Enter your email">
                    </div>
                    <div class="input-box message-box">
                        <input type="textarea" name="message" placeholder="Enter your message">
                    </div>
                    <div class="button">
                        <button type="submit">Send now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="sfooter">
        <?php include ("footer.php") ?>
    </div>
</body>

</html>