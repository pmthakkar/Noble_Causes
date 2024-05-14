<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- FontAwosome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v5-font-face.min.css"
        integrity="sha512-gb3xyfj/FrHtphPVLYaKBZ8WyMYEXD1+Cgt3FiKhFmbN2UuOpite2w1Lgmw6NzfsNmMGX+BbVra4ceV95z9Vaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="food.css">

    <title>education</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="navb">
        <?php include ("navbar2.php"); ?>
    </div>
    <?php
    if (isset ($_SESSION['fd_message'])) {
        echo '<a href="food">
        <div id="foodDonationToast" class="toast align-items-center justify-content-center text-light border-0 position-fixed top-30 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; z-index: 1; border-radius: 10px; background: linear-gradient(135deg, #4CAF50, #FFC107);">
                <div class="toast-body" style="padding: 15px;">
                    ' . $_SESSION['fd_message'] . '
                </div>
            </div></a>';

        // Unset the session variable after displaying the toast
        unset($_SESSION['fd_message']);
    }

    ?>
    <!-- New IMAGE -->
    <div class="container-fluid millionClass">
        <div class="content">
            <p class="mainImageText">Food Donation</p>
            <p class="mainImageText2">Take a bite out of hunger</p>
        </div>
    </div>

    <!-- button -->

    <div class="container-fluid bookdonate m-0 px-5">
        <div class="button-container col-12">

            <!-- Donate Button -->
            <div class="container d-flex justify-content-around knowMoreBottomSpace">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="card-body">
                        <a href="foodDonateform" id="blueLink">
                            <button class="donateNowBtn mx-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#AAAAAA" width="22" height="22"
                                    class="bi bi-bag-heart-fill sparkle" viewBox="0 0 16 16">
                                    <path
                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                </svg>
                                <path
                                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>

                                <span class="text" style="text-decoration: none; !important">Donate Now</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Div -->

        <div class="row featurette">
            <div class="col-md-8 order-md-1 order-sm-2 mt-4" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 bookh2 mt-3">Importance of Food Donation</h2>
                <p class="part1p mt-4">Food donation plays a pivotal role in addressing hunger and food insecurity,
                    serving as a vital lifeline for individuals and communities facing nutritional challenges. The act
                    of donating food not only provides immediate relief to those in need but also contributes to broader
                    social and economic benefits.
                <p class="part1p">Firstly, food donation helps alleviate hunger, a pressing issue affecting millions
                    worldwide. By distributing surplus food to food banks, shelters, and charitable organizations,
                    donors ensure that vulnerable populations, including low-income families, children, and the
                    homeless, have access to nutritious meals. This sustenance is essential for their physical health
                    and well-being.</p>
                <p class="part1p">
                    In essence, food donation is not just about providing meals; it's about nourishing bodies, uplifting
                    spirits, and building stronger, more inclusive communities. By recognizing the importance of food
                    donation and supporting initiatives that facilitate it, we can work towards a world where no one
                    goes to
                    bed hungry.</p>
            </div>
            <div class="col-md-4 order-md-2 order-sm-1 part1img">
                <img src="images/food3.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>

        <div class="row featurette">
            <div class="col-md-8 order-md-2 order-sm-2 mt-4" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 bookh2 mt-5">Why Noble Causes?</h2>
                <p class="part1p mt-4">Donating food to Noble Causes is a powerful act of compassion and solidarity that
                    addresses hunger and supports their mission of making a positive impact in communities.

                <p class="part1p"> Your donation not only supports Noble
                    Causes efforts but also fosters a sense of unity and compassion within the community. It's a
                    tangible way to make a difference, ensuring that surplus food doesn't go to waste but instead
                    reaches those who need it most. Additionally, by donating food, you empower recipients to redirect
                    their resources towards other essential needs, promoting sustainability and resilience.
                </p>
                <p class="part1p">
                    Donating food to Noble Causes is not
                    just about providing meals; it's about extending a lifeline to individuals and families struggling
                    with food insecurity.
                    Through our collective efforts, we can ensure that no one in our community
                    goes hungry.</p>

            </div>
            <div class="col-md-4 order-md-1 order-sm-1 part1img">
                <img src="images/food4.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>

        <div class="row featurette">
            <div class="col-md-8 order-md-1 order-sm-2 mt-4" style="text-align: justify !important;">
                <h2 class="featurette-heading fw-normal lh-1 bookh2 mt-3">Let's Make It Possible Together!</h2>
                <p class="part1p mt-4">"Let's make it possible" for food donations is a rallying call to action,
                    inviting individuals and communities to join hands in the fight against hunger. By coming together
                    and contributing to Noble Causes, we can make a tangible difference in the lives of those facing
                    food insecurity.
                <p class="part1p">
                    Whether it's donating non-perishable food
                    items, organizing food drives, or volunteering time and resources, every contribution counts towards
                    building a brighter future for our community.

                    Together, let's harness the power of unity and compassion to address the root causes of hunger and
                    promote food security for all. By spreading awareness, mobilizing resources, and advocating for
                    sustainable solutions, we can create a world where no one goes to bed hungry.
                </p>
                <p class="part1p">
                    Let's make it possible
                    for every individual to access the nourishment they need to thrive and succeed. Join us in this
                    noble cause and let's make a positive impact together, one meal at a time. Together, we can turn the
                    tide against hunger and build a more resilient and compassionate society for generations to come.
                </p>
            </div>
            <div class="col-md-4 order-md-2 order-sm-1 part1img">
                <img src="images/food5.png" class="img-fluid rounded volimg mb-5" alt="Centered Image">
            </div>
        </div>
    </div>

    <!-- old -->
    <!-- <div class="box-container">
        <img class="box-image" src="image/book10.png" alt="image is not set">
        <div class="box-description">
            <h2>Book Donation</h2>
            <p>Book donation is a noble act that serves to bridge the gap between knowledge and those in need. When
                individuals or organizations contribute books, they not only share the joy of reading but also empower
                communities with the tools for education and personal growth. Donating books is a powerful way to foster
                literacy, especially in underserved areas where access to educational resources may be limited. By
                providing books, donors play a crucial role in promoting a culture of learning and intellectual
                curiosity. Furthermore, book donations contribute to the recycling and repurposing of literature,
                promoting sustainability and minimizing waste. Ultimately, the act of donating books embodies the belief
                that knowledge is a valuable resource that should be accessible to all, irrespective of socio-economic
                backgrounds, and can have a lasting impact on the lives of those who receive these literary treasures.
            </p>
        </div>

    </div> -->

    <script type="text/javascript">
    document.getElementById("myButton").onclick = function() {
        location.href = "bookDonateform";
    };
    </script>
    <script type="text/javascript">
    document.getElementById("myButton2").onclick = function() {
        location.href = "availableBooks";
    };
    </script>

    <footer>
        <?php include ("footer.php") ?>
    </footer>
</body>

</html>