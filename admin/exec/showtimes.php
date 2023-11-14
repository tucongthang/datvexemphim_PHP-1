<?php

session_start();

require_once('../../config/db_connect.php');

if (isset($_POST['add-showtime-btn'])) {
    $movie_id = mysqli_real_escape_string($conn, $_POST['showtime-movie-id']);
    $theater_id = mysqli_real_escape_string($conn, $_POST['showtime-theater-id']);
    $screen_id = mysqli_real_escape_string($conn, $_POST['showtime-screen-id']);
    $showtime = mysqli_real_escape_string($conn, $_POST['showtime-showtime']);
    $price = mysqli_real_escape_string($conn, $_POST['showtime-price']);

    $insert_record = mysqli_query($conn, "INSERT INTO `moviebooking`.`showtimes` 
        (`movie_id`, `theater_id`, `screen_id`, `showtime`, `price`) 
        VALUES ('$movie_id', '$theater_id', '$screen_id', '$showtime', '$price')");

    if (!$insert_record) {
        $_SESSION['msg'] = "Insert unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Insert successful";
        $_SESSION['error'] = 0;
        header("Location: ../showtimes.php");
        exit();
    }
}

if (isset($_POST['edit-showtime-btn'])) {
    $e_id = mysqli_real_escape_string($conn, $_POST['e-id']);
    $edit_movie_id = mysqli_real_escape_string($conn, $_POST['edit-movie-id']);
    $edit_theater_id = mysqli_real_escape_string($conn, $_POST['edit-theater-id']);
    $edit_screen_id = mysqli_real_escape_string($conn, $_POST['edit-screen-id']);
    $edit_showtime = mysqli_real_escape_string($conn, $_POST['edit-showtime']);
    $edit_price = mysqli_real_escape_string($conn, $_POST['edit-showtime-price']);

    $query = "UPDATE `moviebooking`.`showtimes` 
        SET `movie_id` = '$edit_movie_id', 
            `theater_id` = '$edit_theater_id', 
            `screen_id` = '$edit_screen_id', 
            `showtime` = '$edit_showtime', 
            `price` = '$edit_price' 
        WHERE `id` = '$e_id'";

    echo $query;
    $update_record = mysqli_query($conn, $query);

    if (!$update_record) {
        $_SESSION['msg'] = "Update unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Update successful";
        $_SESSION['error'] = 0;
    }

    header("Location: ../showtimes.php");
    exit();
}

if (isset($_POST['delete-showtime-btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete-showtime-id']);

    $delete_record = mysqli_query($conn, "DELETE FROM `moviebooking`.`showtimes` WHERE `id` = $id");

    if (!$delete_record) {
        $_SESSION['msg'] = "Delete unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Delete successful";
        $_SESSION['error'] = 0;
        header("Location: ../showtimes.php");
        exit();
    }
}


