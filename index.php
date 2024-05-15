<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newhome</title>

    <!-- Bootstrap CSS & Js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- CSS Link -->
    <link rel="stylesheet" href="index.css?v=3">
    <link rel="stylesheet" href="nav.css?v=2">

</head>

<body>

    <?php
    error_reporting(0);
    session_start();
    if (isset ($_GET['source'])) {
        $source = $_GET['source'];
        if ($source == 'loginpage') {
            echo '<div id="loginSuccessToast" class="toast align-items-center text-bg-success border-0 position-fixed end-0 my-2 p-0" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 101">
            <div class="toast-body">
                ' . $_SESSION['email'] . '! <br>You have successfully logged in.
            </div>
        </div>';

        }
        if ($source == 'logout') {
            echo '<div id="loginSuccessToast" class="toast align-items-center text-bg-danger border-0 position-fixed  end-0 my-2 py-1" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 101">
            <div class="toast-body">
               You have successfully logged out.
            </div>
        </div>';

        }
    }
    ?>

    <!-- link for PHP file -->
    <div>
        <?php include ("navbar2.php"); ?>
    </div>


    <!-- FOOD SECTION -->
    <div class="container-fluid millionClass">
        <div class="content">
            <div class="counter">
                <span id="count-food">0</span>
            </div>
            <p class="hungry">PEOPLE SLEEPS <br><mark data-text="HUNGRY">HUNGRY</mark> IN INDIA</p>
        </div>
    </div>


    <!-- WHAT WE DO? -->
    <div class="container-fluid whatWeDo">
        <div class="container pt-5 pb-3 text-center">
            <span class="h1 highlight">What We Do?</span>
        </div>

        <div class="container d-flex col-9 lh-base text-center pt-3 justify-content-center"
            style="text-align: justify !important;">
            <span>Food can promote good health and
                incite
                feelings of joy and
                satisfaction. Even if a human being does not have shelter over their head or clothes over their
                body,
                they would still survive if they get wholesome nutrition. That's the reason we bring smiles by
                donating food.</span>
        </div>

        <div class="album pt-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col">
                        <div class="card-body whatWeDoImg mx-auto">
                            <img class="bd-img card-img-top rounded" src="images/home3.jpg" role="img"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                        </div>
                        <p class="pt-3 text-center"> We collect food and do quality checks</p>
                    </div>

                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top rounded" src="images/home4.jpeg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                            </div>
                        </div>
                        <p class="pt-3 text-center">After that food is packed</p>
                    </div>
                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top rounded" src="images/home5.jpg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">

                            </div>
                        </div>
                        <p class="pt-3 text-center">It is donated to the needy ones</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HOW YOU CAN HELP? -->
    <div class="container-fluid whatWeDo">

        <div class="container pt-5 pb-3 text-center">
            <span class="h1 highlight2">How You Can Help?</span>
        </div>

        <div class="container col-9 lh-base text-center pt-3" style="text-align: justify !important;">
            <span>
                Wasting food is a misuse of valuable human and natural resources.
                It also means throwing away money. Grocery stores and restaurants lose money each time when their
                food
                stock go unsold. So, here is a simple three step process whenever you want to donate food.</span>
        </div>

        <div class="album pt-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col">
                        <div class="card-body whatWeDoImg mx-auto">
                            <img class="bd-img card-img-top rounded" src="images/home6.jpg" role="img"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                        </div>
                        <p class="pt-3 text-center">Sign up & fill the donation form </p>
                    </div>

                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top rounded" src="images/home7.jpg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                            </div>
                        </div>
                        <p class="pt-3 text-center">Get ready with the donation food</p>
                    </div>
                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top rounded" src="images/home8.jpg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">

                            </div>
                        </div>
                        <p class="pt-3 text-center">Our volunteer will collect from your doorstep</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-10 rounded mx-auto">
            <p class="text-center fs-2 b pt-3 showSupport">Yes, I Want to Donate Food!</p>

            <!-- Donate Button -->
            <div class="container d-flex justify-content-around knowMoreBottomSpace">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="card-body">
                        <a href="foodDonateform">
                            <button class="donateNowBtn mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22"
                                    class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>

                                <span class="text">Donate Now</span>
                            </button>
                        </a>
                    </div>
                    <!-- KNOW MORE Button -->
                    <div class="card-body">
                        <a href="food">
                            <button class="knowMoreBtn mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                                    class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>
                                <span class="text2">Know More</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BOOK SECTION -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left div with image -->
            <div class="col-md-6 p-0">
                <img src="images/home11.jpg" class="img-fluid" alt="Book Donation">
            </div>
            <!-- Right div with text -->
            <div class="col-md-6 bookDonationText">
                <div class="container p-5 bookDonation2">
                    <div class="container-fluid">
                        <p class="fs-1 bookDonation3">Book Donation</p>
                    </div>
                    <div class="container bookDonation4 mt-4" style="text-align: justify !important;">
                        <p>Noble Causes is a non-profit organisation that publishes high quality, non-affordable books
                            for Youth.
                            You may donate a book to someone known to you in the neighbourhood and if possible, to an
                            underprivileged person or a youngster.
                            You can participate in book donation drives and programs which seek to help book clubs.</p>
                    </div>
                    <div class="container bookDonation4" style="text-align: justify !important;">
                        <p>Books are uniquely portable magic that carries your attached feelings forward.
                            Your books can help someone in the same way they did for you
                            We are committed to carrying your emotions with your books and making them grow older!
                            Let's become a cause for change & make a difference.</p>
                    </div>
                    <div class="container bookDonation4" style="text-align: justify !important;">Books are our best
                        friends, they help us increase our knowledge
                        and make us more creative. They are the best solutions to every problem that comes our way.
                        Reading various books helps change the way we look at the world and develop a positive attitude
                        towards life.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WHAT WE DO? -->
    <div class="container-fluid whatWeDo2">
        <div class="container pt-5 pb-3 text-center">
            <span class="h1 highlight3">Importance of Book Donation</span>
        </div>

        <div class="album pt-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col">
                        <div class="card-body whatWeDoImg mx-auto">
                            <img class="bd-img card-img-top" src="images/home12.jpg" role="img"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                        </div>
                        <div class="container">
                            <p class="pt-3 fw-bold text-center my-1"> Blessings to Needy People</p>
                            <p class="text-center">People in need can obtain books completely free of charge,
                                without
                                any cost or financial burden</p>
                        </div>
                    </div>

                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top" src="images/home13.jpg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                            </div>

                            <div class="container">
                                <p class="pt-3 fw-bold text-center my-1">Positive Environmental Impact</p>
                                <p class="text-center">Book donations reduce waste by repurposing books and extending
                                    their
                                    lifespan</p>
                            </div>

                        </div>
                    </div>

                    <div class="col">
                        <div>
                            <div class="card-body whatWeDoImg mx-auto">
                                <img class="bd-img card-img-top" src="images/home14.jpg" role="img"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                            </div>
                            <div class="container">
                                <p class="pt-3 fw-bold text-center my-1">Education Empowerment</p>
                                <p class="text-center">Book access empowers learning, curiosity, and self-confidence,
                                    fostering personal growth</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container col-10 rounded donateContainer mx-auto">
            <p class="text-center fs-2 pt-3 showSupport">Want To Donate Book?</p>

            <!-- Donate Button -->
            <div class="container pb-3 d-flex justify-content-around">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="card-body">
                        <a href="bookDonateform">
                            <button class="donateNowBtn2 mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22"
                                    class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>

                                <span class="text">Donate Now</span>
                            </button>
                        </a>
                    </div>
                    <!-- KNOW MORE Button -->
                    <div class="card-body">
                        <a href="education">
                            <button class="knowMoreBtn mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                                    class="bi bi-info-circle-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>
                                <span class="text2">Know More</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    <script src="navbar.js"></script>
    <script src="index.js"></script>
    <?php include "footer.php" ?>
</body>

</html>