<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fa icon link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="about.css?v=2">

    <title>about us</title>
</head>

<body>
    <?php
    session_start();

    ?>
    <div class="navb">
        <?php include ("navbar2.php"); ?>
    </div>

    <div class="container">
        <!-- <div class="row"> -->
        <div class="firstdiv col-md-12">
            <p class="text-center aboutUS" style="margin-top:80px">About Us</p>
        </div>
    </div>
    </div>

    <!-- image -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="aboutUsImg">
                <img src="images/aboutUs2.png" class="img-fluid rounded" alt="About Us Image">
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <h2 class="mission mt-5">Our Mission</h2>
                <p class="mb-3 col-md-12 mx-auto mt-4" style="text-align: justify !important;">
                    At Noble Causes, we're dedicated to fostering positive change through book and food donation. By
                    providing educational resources and nutritious meals to underserved communities, we strive to combat
                    illiteracy and hunger. Join us in our mission to create a brighter future for all through compassion
                    and generosity.</p>

            </div>
        </div>
    </div>

    <!-- **** New added ******-->
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox text-center py-5">

                            <div class="icon-container roundbox my-5">
                                <i class="fa-solid fa-bowl-food iconHover mt-3"></i>
                            </div>

                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512" class="my-5" id="myBowl">
                                <path class="myicon" d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1 43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32H8.6C3.1 214.6 0 203.7 0 192zm0 91.4C0 268.3 12.3 256 27.4 256H484.6c15.1 0 27.4 12.3 27.4 27.4c0 70.5-44.4 130.7-106.7 154.1L403.5 452c-2 16-15.6 28-31.8 28H140.2c-16.1 0-29.8-12-31.8-28l-1.8-14.4C44.4 414.1 0 353.9 0 283.4z" />
                            </svg> -->
                            <h2>Food Donation</h2>
                            <p class="card-text mt-4 mb-5" style="text-align: justify !important;">Food donation
                                involves individuals or organizations contributing edible items to support those in
                                need, addressing issues of hunger and food insecurity.</p>
                            <div class="d-flex justify-content-center pb-2">
                                <button class="button btn btn-primary text-center" id="myButton">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox2 text-center py-5">

                            <div class="icon-container roundbox2 my-5">
                                <i class="fa-solid fa-ribbon iconHover-2 mt-3"></i>
                            </div>

                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 448 512" class="myicon my-5">!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.
                                <path d="M333.2 322.8l0 0-133.9-146 0 0L146 118.6c7.8-5.1 37-22.6 78-22.6s70.2 17.4 78 22.6L245.7 180l85.6 93.4 27.4-29.8c16.3-17.7 25.3-40.9 25.3-65V149.1c0-19-5.6-37.5-16.1-53.3L327.8 35.6C312.9 13.4 287.9 0 261.2 0h-76c-25.8 0-50.1 12.5-65.1 33.5L81.9 87C70.3 103.2 64 122.8 64 142.8V164c0 23.2 8.4 45.6 23.6 63.1l56 64.2 0 0 83.3 95.6 0 0 91.8 105.3c10 11.5 26.8 14.3 40 6.8l54.5-31.1c17.8-10.2 21.6-34.3 7.7-49.4l-87.7-95.7zM205.2 410.6l-83.3-95.6L27.1 418.5c-13.9 15.1-10.1 39.2 7.7 49.4l55.1 31.5c13 7.4 29.3 4.9 39.4-6.1l75.9-82.6z" />
                            </svg> -->
                            <h2>Volunteer</h2>
                            <p class="card-text mt-4 mb-5 " style="text-align: justify !important;">Become a vital part
                                of our mission by volunteering. Everyone has access to nutritious food or you believe in
                                the power of literature to
                                transform lives, your contribution matters.</p>
                            <div class="d-flex justify-content-center pb-2">
                                <button class="button btn btn-primary text-center" id="myButton3">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body threeBox text-center py-5">

                            <div class="icon-container roundbox my-5">
                                <i class="fa-solid fa-book-open iconHover  mt-3"></i>
                            </div>

                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 576 512" class="myicon my-5">!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.
                                <path d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5V78.6c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8V454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5V83.8c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11V456c0 11.4 11.7 19.3 22.4 15.5z" />
                            </svg> -->

                            <h2>Book Donation</h2>
                            <p class="card-text mt-4 mb-5" style="text-align: justify !important;">Book donation is a
                                philanthropic effort where individuals or groups contribute books to benefit education,
                                literacy, and community access to reading materials.</p>
                            <div class="d-flex justify-content-center pb-2">
                                <button class="button btn btn-primary text-center" id="myButton2">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- **** New finish ***** -->


    <script type="text/javascript">
    document.getElementById("myButton").onclick = function() {
        location.href = "food";
    };
    document.getElementById("myButton2").onclick = function() {
        location.href = "education";
    };
    document.getElementById("myButton3").onclick = function() {
        location.href = "volunteeruser";
    };
    </script>


    <footer>
        <?php include ("footer.php") ?>
    </footer>
</body>

</html>