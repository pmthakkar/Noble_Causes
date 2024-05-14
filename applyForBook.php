<?php
session_start();
if (isset ($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
    header("Location:login");
}
require_once ("connection.php");

// Check if the request is a POST request and if the book ID is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicant_id = $_SESSION['user_id'];

    // Check if the applicant has already applied for three books
    $sql_count = "SELECT COUNT(*) as count FROM applied_book WHERE applicant_id = '$applicant_id' and a_status='delivered'";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $applied_books_count = $row_count['count'];

    // Limiting the number of books an applicant can apply for to three
    if ($applied_books_count >= 3) {

        echo "<script>
        alert('You have already applied for three books. You cannot apply for more.');
    </script>";

    } else {
        $book_id = $_POST['book_id'];

        $sql_insert = "INSERT INTO `applied_book` (`applicant_id`, `book_id`, `a_status`, `applied_date`) VALUES ('$applicant_id', '$book_id', 'applied', current_timestamp());";
        $result_insert = $conn->query($sql_insert);

        $sql_update = "UPDATE donate_book SET quantity = quantity - 1 WHERE book_id = $book_id;";
        $result_update = $conn->query($sql_update);

        header("Location:availableBooks");
    }
} else {
    echo "You cannot apply for this book.";
}
?>