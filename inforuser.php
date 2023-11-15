<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Information user</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Recursive&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/seatbooking.css" type="text/css">
</head>
<body>
    <h2>INFORMATION USER</h2>

    <!-- lấy thông tin từ bảng booking -->
    <?php
        require_once("config/db_connect.php");
        if (isset($_GET['showtimeId']) && isset($_GET['movieId'])) {
            $showtimeId = $_GET['showtimeId'];
            
            $date = date("Y-m-d");

            $result = mysqli_query($conn, "SELECT * FROM booking WHERE book_id = '" . $id . "' showtime_id = '" . $showtimeId . "' && booking_date = '" . $date . "' && movieSeat = '" . $seats. "'");

            $queryMovie = "SELECT movies.title, movies.image, DATE_FORMAT(showtimes.showtime, '%Y-%m-%d') AS show_date, DATE_FORMAT(showtimes.showtime, '%H:%i') AS show_time
                    FROM showtimes
                    INNER JOIN movies ON showtimes.movie_id = movies.id
                    WHERE showtimes.id = $showtimeId";

            $resultMovie = mysqli_query($conn, $queryMovie);

            if ($row = mysqli_fetch_assoc($resultMovie)) {
                $bookid = $_GET['id'];
                $movieTitle = $row['title'];
                $movieImage = $row['image'];
                $showDate = $row['show_date'];
                $showTime = $row['show_time'];
                $movieSeats = $row['seats'];
            }
        } else {
            header("Location: index.php");
            exit();
        }
    ?>

    <div class="container">
        <form action="" method ="POST">
            <div class ="row">
                <!-- trái -->
                <div class="col-lg-5">

                </div>
                <!-- phải thông tin user -->
                <div class="col-lg-7">
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Seats</th>
                            <th>Show time</th>
                            <th>Date</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <th><?php echo $bookid ?></th>
                            <th><?php echo $movieTitle ?></th>
                            <th><img src="..\image/<?php echo $movieImage; ?>" width="50" height="100"></th>
                            <th><?php echo $movieSeats?></th>
                            <th><?php echo $showTime?></th>
                            <th><?php echo $showDate?></th>
                        </tr>
                    </table>

                <!-- check login -->
                <?php
                if(!isset($_SESSION['username'])){
                    ?>
                    <div class="modal fade" id="tailer_modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <h3>You need to login</h3>
                                <a class="btn btn-primary btn-sm" href="login.php">Login</a>
                            </div>
                        </div>
                    </div>
                <?php    
                }
                ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>