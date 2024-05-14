<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!---Custom CSS File--->
    <link rel="stylesheet" href="login.css" />

</head>

<body>
    <?php
    require "connection.php";
    $login = false;
    $showError = false;
    $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = $_POST['role'];

        if ($role == "user") {
            $sql = "SELECT * FROM `users` WHERE email ='$email';";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['user_id'] = $row['user_id'];
                        header("Location:index?source=loginpage");

                        exit();
                    } else {
                        echo '<script>
                alert("Login failed. Please enter valid details.");
                </script>';
                    }

                }
            }

        } elseif ($role == "admin") {
            $admin_sql = "SELECT * FROM `admin` WHERE admin_email ='$email';";
            $admin_result = mysqli_query($conn, $admin_sql);
            $admin_num = mysqli_num_rows($admin_result);

            if ($admin_num == 1) {
                while ($row = mysqli_fetch_assoc($admin_result)) {
                    if (password_verify($password, $row['admin_password'])) {
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['admin_id'] = $row['admin_id'];
                        header("Location:admin/index?source=loginpage");
                        exit();
                    } else {
                        echo '<script>
                    alert("Login failed. Please enter valid details.");
                    </script>';
                    }
                }
            }
        } elseif ($role == "volunteer") {
            $v_sql = "SELECT * FROM `volunteers` WHERE v_email ='$email';";
            $v_result = mysqli_query($conn, $v_sql);
            $v_num = mysqli_num_rows($v_result);

            if ($v_num == 1) {
                while ($row = mysqli_fetch_assoc($v_result)) {
                    if (password_verify($password, $row['v_password'])) {
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['v_id'] = $row['v_id'];
                        $_SESSION['v_zip'] = $row['v_zip'];
                        header("Location:volunteer/index?source=loginpage");
                        exit();
                    } else {
                        echo '<script>
                    alert("Login failed. Please enter valid details.");
                    </script>';
                    }
                }
            }
        }
    }
    ?>
    <div>
        <?php include ("navbar2.php") ?>
    </div>

    <section class="container">
        <header>Login</header>
        <form action="#" method="POST" class="form">
            <div class="select-box">
                <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Login As</label>
                <select name="role">
                    <option value="user">User</option>
                    <option value="volunteer">Volunteer</option>
                    <option value="admin">Admin</option>

                </select>
            </div>
            <div class="input-box">
                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</label>
                <input type="text" placeholder="Enter email address" name="email" value="<?= $email ?>" />
            </div>
            <div class="input-box">
                <label><i class="fa fa-lock" aria-hidden="true"></i> Password</label>
                <input type="Password" placeholder="Enter Password" name="password" required />
            </div>

            <button type="submit">Submit</button>
            <div class="login-link">
                Don't have an account ? <a href="signUp?source=loginpage">Sign Up</a>
            </div>
        </form>
    </section>
    <div>
        <?php include ("footer.php") ?>
    </div>
</body>

</html>