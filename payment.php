<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css"
          rel="stylesheet">
    <style>
        .front {
            margin: 5px 4px 45px 0;
            background-color: #EDF979;
            color: #000000;
            padding: 9px 0;
            border-radius: 3px;
        }
    </style>
</head>

<body>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">BOOKING SUMMARY</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="tab-content">
                        <div class="row">
                            <?php
                            require_once("config/db_connect.php");

                            $showTimeId = $_POST['showtimeId'];
                            $selected_seats = $_POST['selected-seats'];
                            $total_seats = $_POST['total-seats'];

                            $username = $_SESSION['username'];
                            if (isset($_POST['submit'])) {
//                                $queryUser = "SELECT u.username, u.email, u.mobile, u.city, t.theater FROM users u INNER JOIN theater_show t ON u.username = '" . $username . "' WHERE t.show = '" . $show . "'"
                                $queryUser = "SELECT * from users WHERE username = '" . $username . "'";
                                $resultUser = mysqli_query($conn, $queryUser);
                                $queryShowTimeInfo = "SELECT
                                        screens.screen_name,
                                        movies.title,
                                        theaters.theater_name,
                                        theaters.theater_address,
                                        DATE_FORMAT(st.showtime, '%Y-%m-%d') AS show_date, 
                                        DATE_FORMAT(st.showtime, '%H:%i') AS show_time
                                FROM showtimes st
                                INNER JOIN movies ON st.movie_id = movies.id
                                INNER JOIN theaters ON st.theater_id = theaters.id
                                INNER JOIN screens ON st.screen_id = screens.id
                                WHERE st.id='" . $showTimeId . "'";

                                $resultInfo = $conn->query($queryShowTimeInfo)->fetch_array();

                                $movieTitle = $resultInfo['title'];
                                $theater_name = $resultInfo['theater_name'];
                                $theater_address = $resultInfo['theater_address'];
                                $showDate = $resultInfo['show_date'];
                                $showTime = $resultInfo['show_time'];
                                $seats = explode(",", $selected_seats);
                                $price = 0;
                                if (mysqli_num_rows($resultUser) > 0) {
                                    while ($row = mysqli_fetch_array($resultUser)) {
                                        echo '<div class="col-lg-6">
                                                Your Name: ' . $row['name'] . '<br>
                                                Birthday: ' . $row['birthday'] . '<br>
                                                Phone no.: ' . $row['phone'] . '<br>
                                                Movie Name: ' . $movieTitle . '<br>
                                                Seats: ' . $selected_seats . ' <br>
                                                Show Date: ' . $showDate . '
                                          </div>
                                          <div class="col-lg-6">
                                                Email: ' . $row['email'] . '<br>
                                                Gender: ' . (($row['gender'] == 0) ? "Male" : "Female") . '<br>
                                                Theater: ' . $theater_name . '<br>  
                                                Total Seats: ' . $_POST['total-seats'] . ' <br>
                                                Time: ' . $showTime . '<br>
                                                Booking Date: ' . date("D-m-y", strtotime('today')) . '
                                          </div>';
                                    }
                                }
                            }
                            ?>
                            <input type="hidden" id="movie" value="<?php echo $movieTitle; ?>">
                            <input type="hidden" id="time" value="<?php echo $showDate; ?>">
                            <input type="hidden" id="time" value="<?php echo $showTime; ?>">
                            <input type="hidden" id="seats" value="<?php echo $selected_seats; ?>">
                            <input type="hidden" id="total-seats" value="<?php echo $total_seats ?>">
                            <input type="hidden" id="price" value="0">
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="payment"
                                    class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/mixitup.min.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#payment").click(function () {
            var movie = $("#movie").val().trim();
            var time = $("#time").val().trim();
            var seats = $("#seats").val().trim();
            var totalseats = $("#total-seats").val().trim();
            var price = $("#price").val().trim();

            $.ajax({
                url: 'payment_form.php',
                type: 'post',
                data: {
                    movie: movie,
                    time: time,
                    seat: seats,
                    totalseat: totalseats,
                    price: price,
                },
                success: function (response) {
                    if (response == 1) {
                        window.location = "tickes.php";
                    } else {
                        error = " <font color='red'>!Invalid UserId.</font> ";
                        document.getElementById("msg").innerHTML = error;
                        return false;
                    }
                    $("#message").html(response);
                }
            });
        });
    });
</script>
</body>

</html>
