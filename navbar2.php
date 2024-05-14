<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- all links here -->
    <link rel="stylesheet" href="nav.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap css -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>

    <nav>
        <div class="navbar">
            <i class='bx bx-menu three cursor-pointer'></i>
            <div class="logo"><a href="index"><img src="images/logo2.png" alt="Noble Causes"></img></a></div>
            <div class="nav-links">
                <div class="sidebar-logo">
                    <i class='bx bx-x three'></i>
                </div>
                <ul class="links">
                    <li><a href="index">Home</a></li>
                    <li><a href="aboutUs">About Us</a></li>
                    <li>
                        <a id="servicesClick">Our Services</a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow' id="servicesArrow"></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            <li><a href="food">Food Donation</a></li>
                            <li><a href="education">Book Donation</a></li>
                        </ul>
                    </li>


                    <li><a href="contactUs">Contact Us</a></li>
                    <?php if (isset ($_SESSION['email'])) { ?>
                    <li>
                        <a href="logout">
                            <button id="login" class="text-center mt-3">
                                Logout
                            </button>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li><a href="volunteeruser">Be A Volunteer</a></li>
                    <li class="">
                        <a href="login">
                            <button id="login" class="text-center mt-3">
                                Login
                            </button>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php if (isset ($_SESSION['email'])) { ?>
            <div class="search-box">
                <a href="profile"><i class='bx bx-user'></i></a>
            </div>
            <?php } ?>

        </div>
    </nav>
    <script src="navbar.js"></script>

</body>

</html>