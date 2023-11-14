<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seat Booking</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Recursive&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/seatbooking.css" type="text/css">

</head>

<body>



<h2>BOOK YOUR SEAT NOW</h2>

<?php
require_once("config/db_connect.php");
if (isset($_GET['showtimeId']) && isset($_GET['movieId'])) {
    $showtimeId = $_GET['showtimeId'];
    $date = date("Y-m-d");

    $result = mysqli_query($conn, "SELECT * FROM booking WHERE showtime_id = '" . $showtimeId . "' && booking_date = '" . $date . "'");

    $queryMovie = "SELECT movies.title, DATE_FORMAT(showtimes.showtime, '%Y-%m-%d') AS show_date, DATE_FORMAT(showtimes.showtime, '%H:%i') AS show_time
              FROM showtimes
              INNER JOIN movies ON showtimes.movie_id = movies.id
              WHERE showtimes.id = $showtimeId";

    $resultMovie = mysqli_query($conn, $queryMovie);

    if ($row = mysqli_fetch_assoc($resultMovie)) {
        $movieTitle = $row['title'];
        $showDate = $row['show_date'];
        $showTime = $row['show_time'];
    }

    $occupiedSeats = array();

    while ($row = mysqli_fetch_array($result)) {
        $seats = explode(",", $row['seats']);
        $occupiedSeats = array_merge($occupiedSeats, $seats);
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <form action="payment.php" method="POST">

        <div class="row">
            <div class="col-lg-6">
                <div class="screen"></div>

                <div class="seats-container mx-auto">
                    <div class="row d-flex justify-content-center align-items-center">
                        <?php
                        $seats = array("A1", "A2", "A3", "A4", "B1", "B2", "B3", "B4");
                        foreach ($seats as $seat) {
                            $seatClass = in_array($seat, $occupiedSeats) ? 'occupied' : '';
                            echo '<div class="seat ' . $seatClass . '" data-seat="' . $seat . '"></div>';
                        }
                        ?>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center">
                        <?php
                        $seats = array("C1", "C2", "C3", "C4", "D1", "D2", "D3", "D4");

                        foreach ($seats as $seat) {
                            $seatClass = in_array($seat, $occupiedSeats) ? 'occupied' : '';
                            echo '<div class="seat ' . $seatClass . '" data-seat="' . $seat . '"></div>';
                        }
                        ?>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center">
                        <?php
                        $seats = array("E1", "E2", "E3", "E4", "F1", "F2", "F3", "F4");
                        foreach ($seats as $seat) {
                            $seatClass = in_array($seat, $occupiedSeats) ? 'occupied' : '';
                            echo '<div class="seat ' . $seatClass . '" data-seat="' . $seat . '"></div>';
                        }
                        ?>
                    </div>
                </div>

                <ul class="showcase">
                    <li>
                        <div class="seat"></div>
                        <small>Available</small>
                    </li>
                    <li>
                        <div class="seat-sample selected"></div>
                        <small>Selected</small>
                    </li>
                    <li>
                        <div class="seat-sample occupied"></div>
                        <small>Occupied</small>
                    </li>
                </ul>
                <p class="text">You have selected <span id="selected-count">0</span> seats for the price of $<span
                            id="selected-price">0</span></p>


                <input type="hidden" name="showtimeId" value="<?php echo $showtimeId; ?>">

            </div>
            <div class="col-lg-6">
                <table>
                    <tr>
                        <td width="50%"><font size="5px" style="font-weight: bold">Movie:</font></td>
                        <td bgcolor="79F9E2">
                            <center><font size=5 style="font-family: Shruti; "><?php echo $movieTitle ?></font>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%"><font size="5px" style="font-weight: bold;">Date:</font></td>
                        <td bgcolor="ECF68C">
                            <center><font size=5 style=""><?php echo $showDate ?></font>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%"><font size="5px" style="font-weight: bold;">Time:</font></td>
                        <td bgcolor="ECF68C">
                            <center><font size=5 style=""><?php echo $showTime ?></font>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%"><font size="5px" style="font-weight: bold;">Seat:</font></td>
                        <td><input type="text" id="selected-seats" name="selected-seats" placeholder="selected checkboxs"></td>
                    </tr>
                    <tr>
                        <td width="50%"><font size="5px" style="font-weight: bold;">Total Seat:</font>
                        </td>
                        <td><input type="text" id="count" name="total-seats" placeholder="Total Seats"></td>
                    </tr>
<!--                    <input type="hidden" name="movie" value="--><?php //echo $movieTitle ?><!--">-->
<!--                    <input type="hidden" name="show" value="--><?php //echo $showtime ?><!--">-->
                </table>

            <?php
            if (!isset($_SESSION['username'])) {
                ?>
                <div class="col-lg-12">
                    <div class="form-group">
                        <a data-toggle="modal" data-target="#tailer_modal"
                           class="form-control btn btn-primary py-2"><font style="color:white;">Payment Now</a>
                    </div>
                </div>
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
            } else {
                ?>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="submit" value="Payment Now" name="submit" class="form-control btn btn-primary py-2">
                    </div>
                </div>


                <?php
            }
            ?>
            </div>
        </div>
    </form>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--<script src="index.js"></script>-->
<script>
    $(document).ready(function() {
        var selectedSeats = [];
        var maxSeats = 8;

        $('.seat').click(function() {
            var seat = $(this).data('seat');

            if ($(this).hasClass('occupied')) {
                return;
            }

            if (selectedSeats.length >= maxSeats) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    selectedSeats = selectedSeats.filter(function(value) {
                        return value !== seat;
                    });
                } else {
                    document.getElementById('notvalid').innerHTML = "Maximum seat select 8";
                    return;
                }
            } else {
                $(this).toggleClass('selected');

                if (selectedSeats.includes(seat)) {
                    selectedSeats = selectedSeats.filter(function(value) {
                        return value !== seat;
                    });
                } else {
                    selectedSeats.push(seat);
                }

                let $sLength = selectedSeats.length;

                $('#selected-count').text($sLength);
                $('#count').val($sLength);
                $('#selected-seats').val(selectedSeats.join(","));
            }
        });
    });


</script>

</body>
</html>