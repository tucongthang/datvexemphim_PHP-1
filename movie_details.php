<?php
session_start();

require_once("config/db_connect.php");
$id = $_GET['pass'];
$result = mysqli_query($conn, "SELECT * FROM movies WHERE id = '" . $id . "'");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Css Styles -->
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $row['title']; ?> Movie Details</title>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
    <!--    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">-->
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="  text/css">
    <!--    <link rel="stylesheet" href="assets/css/fonts-googleapis.css" type="  text/css">-->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <style>

        .modal-dialog {
            max-width: 1500px;
            margin-top: -1rem;
        }

    </style>

</head>
<body>
<?php
include("templates/header.php");
require_once("config/db_connect.php");
$movieId = $_GET['pass'];

$query = "SELECT * FROM movies m JOIN genre g ON m.genre_id = g.id WHERE m.id = '" . $id . "'";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_array($result)) {
$id = $row['id'];
?>

<section id="aboutUs">
    <div class="fluid-container">
        <!-- Trailer Embed -->
        <div class="row mt-4" style="background-color: black;">
            <div class="d-flex justify-content-center w-100">
                <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid position-relative"
                     style="height: 500px; width: 600px;" alt="Movie Image">
                <button type="button"
                        class="btn bg-white btn-play position-absolute rounded-circle d-flex align-items-center justify-content-center"
                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; width: 64px; height: 64px;"
                        data-toggle="modal" data-target="#trailer_modal<?php echo $row['id']; ?>">
                    <i class="fa fa-play"></i>
                </button>
            </div>
        </div>

        <div class="modal fade" id="trailer_modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog vh-100 vw-100 d-flex align-items-center justify-content-center" role="document">
                <div class="modal-content mx-auto" style="height: 80%; width: 100%;">
                    <iframe src="<?php echo $row['trailer_link']; ?>" frameborder="0" class="modal-iframe w-100 h-100"
                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"></iframe>
                </div>
            </div>
        </div>

    </div>
    <div class="container">


        <div class="row feature design">

            <div class="col-lg-5"><img src="admin/image/<?php echo $row['image']; ?>" class="resize-detail"
                                       alt="" width="100%"></div>
            <div class="col-lg-7">

                <table class="content-table">
                    <thead>
                    <tr>
                        <th colspan="2">Movie Details</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Movie Name</td>
                        <td><?php echo $row['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Release Date</td>
                        <td><?php echo $row['release_date']; ?></td>
                    </tr>
                    <tr>
                        <td>Director Name</td>
                        <td><?php echo $row['director']; ?></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td><?php echo $row['genre_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td><?php echo $row['language']; ?></td>
                    </tr>

                    <tr>
                        <td>Tailer</td>
                        <td><a data-toggle="modal" data-target="#tailer_modal<?php echo $row['id']; ?>">Veiw
                                Tailer</a></td>
                        <div class="modal fade" id="tailer_modal<?php echo $row['id']; ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <embed style="width: 820px; height: 450px;"
                                           src="<?php echo $row['you_tube_link']; ?>"></embed>
                                </div>
                            </div>
                        </div>
                    </tr>

                    </tbody>


                </table>

            </div>

        </div>

        <div class="row">
            <?php if ($row['running'] == 1) { ?>
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Show Book Ticket:</h4><br>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $query = "SELECT st.id as showtime_id, s.screen_number, t.theater_name, st.showtime 
                                              FROM showtimes st 
                                              INNER JOIN theaters t ON st.theater_id = t.id
                                              INNER JOIN screens s ON st.screen_id = s.id
                                              WHERE st.movie_id = '$movieId'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($showtime = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $showtime['theater_name']; ?>
                                            (<?php echo date('F j, Y', strtotime($showtime['showtime'])); ?>)</h5>
                                        <p class="card-text">Screen
                                            Number: <?php echo $showtime['screen_number']; ?></p>
                                        <a class="btn btn-primary"
                                           href="seatbooking.php?movieId=<?php echo $movieId; ?>&showtimeId=<?php echo $showtime['showtime_id']; ?>">
                                            <p class="card-text text-white d-flex align-items-center"><?php echo date('H:i A', strtotime($showtime['showtime'])); ?></p>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No showtimes available.";
                        } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="description">
                <h4>Description</h4>
                <p>
                    <!--                                            Jeff Lang (Tobey Maguire), an OBGYN, and his wife Nealy (Elizabeth Banks), who owns a small-->
                    <!--                                            shop, live in Seattle with their two-year-old son named Miles. Considering a second child, they-->
                    <!--                                            decide to enlarge their small home and lay expensive new grass in their backyard. Worms in the-->
                    <!--                                            grass attract raccoons, who destroy the grass, and Jeff goes to great lengths to get rid of the-->
                    <!--                                            raccoons, mixing poison with a can of tuna. Their neighbor Lila (Laura Linney) tells Jeff that-->
                    <!--                                            her cat Matthew is missing, and Jeff does not yet realize he may be responsible.-->
                    <?php echo $row['description']; ?>
                </p>
            </div>
        </div>
        <?php
        }
        }
        ?>
    </div>

</section>

<?php
include("templates/footer.php");
?>


<!-- Js Plugins -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/mixitup.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>     