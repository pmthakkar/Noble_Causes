<?php
require "connection.php";
    $input = $_POST['input'];
$sql = "SELECT title, author, course, image FROM donate_book WHERE title LIKE '%$input%' OR author LIKE '%$input%' OR course LIKE '%$input%'";
$result = mysqli_query($conn,$sql);

if(isset($_POST['input'])){
    echo '<div class="container">';
    echo '    <div class="row">';
    while($row = mysqli_fetch_assoc($result)){
       
        echo '        <div class="col-md-4">';
        echo '            <div class="card book-card">';
        echo '                <img class="card-img-top img-fluid" style="width: 100%; height: 300px; object-fit: fill;"  src="BookImage/' . $row['image'] . '" alt="' . $row['title'] . '">';
        echo '                <div class="card-body">';
        echo '                    <h4 class="card-title text-center">' . $row['title'] . '</h5>';
        echo '                    <h6 class="card-text text-center">By ' . $row['author'] . '</h6>';
        echo '                    <h6 class="card-text text-center">Course: <b>' . $row['course'] . '</b></h6>';
        echo '                    <button style=" height: 55px; width: 100%; color: #fff; font-size: 1rem;font-weight: 400;margin-top: 20px;border: none; cursor: pointer;transition: all 0.2s ease;background: #3E8DA8;" type="submit" name="submit">Apply for this Book</button>';
        echo '                </div>';
        echo '            </div>';
        echo '        </div>';
        
        
    }
    echo '    </div>';
        echo '</div>';
} else {
    echo "0 results";
}
?>