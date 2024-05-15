<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AvailableBooks</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="availableBooks.css?v=1">
</head>

<body>
    <?php
    session_start();
    if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    } else {
        header("Location:login");
    } ?>


    <div class="container d-flex flex-wrap justify-content-center  uper">
        <div class="col-12 col-lg-8 mb-2 mb-lg-0 me-lg-auto" role="search">
            <input type="text" id="search" class="form-control" placeholder="Search..." aria-label="Search">
        </div>

        <div class="text-end">
            <button type="button" id="top" class="btn btn-primary">Request Book</button>
        </div>
    </div>
    <div id="searchr"></div>

    <div class="container">
        <div class="row">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $("#search").keyup(function () {
                        var input = $(this).val();
                        if (input != "") {
                            $.ajax({
                                url: "bookSearch.php",
                                method: "POST",
                                data: {
                                    input: input
                                },

                                success: function (data) {
                                    $("#searchr").html(data);
                                }
                            });
                        } else {
                            $("searchr").css("display", "none");
                        }

                    });
                });
            </script>
            <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const search = document.getElementById('search');
                const bookCards = document.querySelectorAll('.book-card');

                search.addEventListener('input', function() {
                    const searchTerm = search.value.toLowerCase().trim();

                    bookCards.forEach(function(card) {
                        const title = card.querySelector('.card-title').textContent
                        .toLowerCase();
                        const author = card.querySelector('.card-text').textContent
                        .toLowerCase();
                        const course = card.querySelector('.card-text').textContent
                        .toLowerCase();

                        if (title.includes(searchTerm) || author.includes(searchTerm) || course
                            .includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            </script> -->

            <?php
            require 'connection.php';
            include "navbar2.php";
            // Define the number of items per page
            $itemsPerPage = 3;

            // Get the current page number from the URL, default to page 1
            $currentPage = isset ($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset based on the current page
            $offset = ($currentPage - 1) * $itemsPerPage;

            $sql = "SELECT * FROM donate_book where `status`='collected' and quantity > 0 LIMIT $offset, $itemsPerPage";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '    <div class="card book-card">';
                    echo '        <img class="card-img-top img-fluid"  src="BookImage/' . $row['image'] . '" alt="${title}">';
                    echo '        <div class="card-body">';
                    echo '            <h4 class="card-title text-center">' . $row['title'] . '</h4>';
                    echo '            <h5 class="card-text text-center">By ' . $row['author'] . '</h5>';
                    echo '            <h6 class="card-text text-center">Course: <b>' . $row['course'] . '</b></h6>';
                    echo '            <p class="card-text text-center" style="display: none;">' . $row['description'] . '</p>';
                    echo '            <p class="card-text text-center" style="display: none;">' . $row['book_id'] . '</p>';
                    echo '           <button type="button" id="card-button"  data-bs-target="#bookModal" data-bs-toggle="modal">Book Detail</button>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';

                }

            } else {
                echo "0 results";
            }

            // Calculate the total number of pages outside the loop
            $sqlCount = "SELECT COUNT(*) AS count FROM donate_book";
            $resultCount = $conn->query($sqlCount);
            $rowCount = $resultCount->fetch_assoc()['count'];
            $totalPages = ceil($rowCount / $itemsPerPage);

            // Set the maximum number of visible pages
            $maxVisiblePages = 1;

            ?>
        </div>


        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookModalLabel">Book Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <!-- Added text-center class for centering -->
                        <!-- Centered image with responsive classes -->
                        <img src="" class="img-fluid mx-auto" alt="" style="height: 400px; width: 350px;">
                        <h5 class="mt-3"></h5>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <form id="applyForm" action="applyForBook.php" method="POST">
                            <input type="hidden" name="book_id" value="" id="bookIdInput" />
                            <button type="submit" id="applyBtn" class="btn btn-primary" data-bs-dismiss="modal">Apply
                                For this Book</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <script>
            $('#bookModal').on('show.bs.modal', function (event) {

            });
        </script>
        <script>
            $('#bookModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var bookImage = button.closest('.card').find('.card-img-top').attr('src');
                var bookTitle = button.closest('.card').find('.card-title').text();
                var bookAuthor = button.closest('.card').find('.card-text').eq(0).text();
                var bookCourse = button.closest('.card').find('.card-text').eq(1).text();
                var bookDesc = button.closest('.card').find('.card-text').eq(2).text();

                var button = $(event.relatedTarget); // Button that triggered the modal
                var bookId = button.closest('.card').find('.card-text').eq(3)
                    .text(); // Get the book ID from the card

                // Set the value of the hidden input field
                $('#bookIdInput').val(bookId);
                var modal = $(this);
                modal.find('.modal-body img').attr('src', bookImage);
                modal.find('.modal-body h5').text(bookTitle);
                modal.find('.modal-body p').eq(0).text(bookAuthor);
                modal.find('.modal-body p').eq(1).text(bookCourse);
                modal.find('.modal-body p').eq(2).text(bookDesc);
                modal.find('.modal-body input').eq(3).text(bookId);
            });
        </script>
        <!-- Custom Pagination -->
        <ul class="pagination">
            <?php
            // Output "Previous" button
            echo '<li class="page-item ' . ($currentPage == 1 ? 'disabled' : '') . '">';
            echo '<a class="page-link" href="?page=' . ($currentPage - 1) . '" tabindex="-1" aria-disabled="true">Previous</a>';
            echo '</li>';

            // Output page links with ellipsis
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage || $i <= $maxVisiblePages || $i > $totalPages - $maxVisiblePages || ($i >= $currentPage - floor($maxVisiblePages / 2) && $i <= $currentPage + floor($maxVisiblePages / 2))) {
                    echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                    echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                    echo '</li>';
                } elseif (($i == $maxVisiblePages + 1 || $i == $totalPages - $maxVisiblePages) && $maxVisiblePages < $totalPages) {
                    echo '<li class="ellipsis">...</li>';
                }
            }

            // Output "Next" button
            echo '<li class="page-item ' . ($currentPage == $totalPages ? 'disabled' : '') . '">';
            echo '<a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a>';
            echo '</li>';
            ?>
        </ul>
    </div>
    <!-- <script>
        $(document).ready(function () {
            $('#applyBtn').click(function () {
                var bookId = $(this).data('bookid');

                $.ajax({
                    url: 'applyForBook.php',
                    method: 'POST',
                    data: {
                        bookId: bookId
                    },
                    success: function (response) {
                        // Handle success response if needed
                        console.log('Application successful');
                    },
                    error: function (xhr, status, error) {
                        // Handle error response if needed
                        console.error('Error applying for book:', error);
                    }
                });
            });
        });
    </script> -->

    <script type="text/javascript">
        document.getElementById("top").onclick = function () {
            location.href = "requestBook";
        };
    </script>
    <?php include "footer.php"; ?>
</body>

</html>