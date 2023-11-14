<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Customer Page</title>


    <?php session_start();
    if (!isset($_SESSION['admin'])) {
        header("location:login.php");
    }
    ?>
    <?php include_once("./templates/top.php"); ?>
    <?php include_once("./templates/navbar.php"); ?>
    <div class="container-fluid">
        <div class="row">

            <?php include "./templates/sidebar.php"; ?>

            <div class="row">
                <div class="col-10">
                    <h2>Vé</h2>
                </div>
                <div class="col-2">
                    <button data-toggle="modal" data-target="#add_custemer_modal" class="btn btn-primary btn-sm">Thêm
                        vé
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên khách hàng</th>
                        <th>Tên phim</th>
                        <th>Theater</th>
                        <th>Screen</th>
                        <th>Giờ chiếu</th>
                        <th>Ghế</th>
                        <th>Tổng ghế</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody id="customer_list">
                    <?php
                    require_once("../config/db_connect.php");

                    $query = "SELECT
                        	showtimes.id,
                            showtimes.showtime,
                            booking.booking_date,
                            booking.seats,
                            booking.total_seats,
                            users.`name`,
                            booking.id,
                            showtimes.id AS showtime_id,
                            movies.title,
                            theaters.theater_name,
                            booking.total_price,
                            screens.screen_number 
                    FROM
                        booking
                        INNER JOIN users ON booking.user_id = users.id
                        INNER JOIN showtimes ON booking.showtime_id = showtimes.id
                        INNER JOIN movies ON showtimes.movie_id = movies.id
                        INNER JOIN theaters ON showtimes.theater_id = theaters.id
                        INNER JOIN screens ON showtimes.screen_id = screens.id";

                    $result = $conn->query($query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['theater_name']; ?></td>
                                <td><?php echo $row['screen_number']; ?></td>
                                <td><?php echo $row['showtime_id']; ?></td>
                                <td><?php echo $row['seats']; ?></td>
                                <td><?php echo $row['total_seats']; ?></td>
                                <td><?php echo $row['booking_date']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='12'>No records found</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            </main>
        </div>
    </div>


    <!-- Add custemers Modal start -->
    <div class="modal fade" id="add_custemer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="myform" id="insert_movie" action="insert_data.php" method="post"
                          enctype="multipart/form-data" onsubmit="return validateform()">
                        <div class="row">

                            <div class="col-12">
                                <label>Username Id</label>
                                <select class="form-control category_list" name="username_id">
                                    <option value="">Select Username</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM users");
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Movie</label>

                                    <select class="form-control category_list" name="movie">
                                        <option>Select Username</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM movies");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row['running'] == "1") {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Show Time</label>
                                    <input type="text" name="show_time" class="form-control" placeholder="Enter Show">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Seats</label>
                                    <input type="text" name="seat" class="form-control" placeholder="Enter Seats">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Total Seat</label>
                                    <input type="number" name="totalseat" class="form-control"
                                           placeholder="Enter Total Seat">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" placeholder="Enter Price">
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" name="customers" class="btn btn-primary add-product"
                                       value="Add Product">
                            </div>
                        </div>

                    </form>
                    <div id="preview"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add custemers- Modal end -->
    <?php include_once("./templates/footer.php"); ?>


    <script>

    </script>
