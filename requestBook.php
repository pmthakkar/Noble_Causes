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
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <title>Request Book</title>
    <link rel="stylesheet" href="donateform.css?v=2" />

</head>

<body>
    <?php
    session_start();
    if (isset ($_SESSION['email']) && $_SESSION['loggedin'] == true) {

    } else {
        header("Location:login");
    } ?>
    <div>
        <?php include ("navbar2.php") ?>
    </div>
    <section class="container">
        <header>Request Book</header>
        <form action="#" class="form">

            <div class="input-box">
                <label><i class="fa fa-book" aria-hidden="true"></i> Book Title</label>
                <input type="text" placeholder="Enter Book Title" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-user" aria-hidden="true"></i> Author Name</label>
                    <input type="text" placeholder="Enter Author Name" required />
                </div>
                <div class="select-box">
                    <label><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> Courses</label>
                    <select>
                        <option>JEE</option>
                        <option>NEET</option>
                        <option>UPSC</option>
                        <option>GPSC</option>
                    </select>

                </div>
            </div>
            <div class="column">
                <div class="input-box">
                    <label><i class="fa fa-calendar" aria-hidden="true"></i> Required Till</label>
                    <input type="date" placeholder="Required till" required />
                </div>
                <div class="image-box">
                    <label><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Book Image</label>
                    <input type="file" required />
                </div>
            </div>
            <div class="input-box">
                <label> <i class="fa fa-edit"></i> Book Description</label>
                <input type="textarea" placeholder="Enter Description" required />
            </div>


            <button>Request</button>
        </form>
    </section>

    <div class="sfooter">
        <?php include ("footer.php") ?>
    </div>
</body>

</html>