<?php

session_start();

require_once('../../config/db_connect.php');

if (isset($_POST['add-booking-btn'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user-id']);
    $seats = mysqli_real_escape_string($conn, $_POST['booking-seats']);
    $total_seats = mysqli_real_escape_string($conn, $_POST['booking-total-seats']);
    $booking_date = date("Y-m-d H:i:s");
    $showtime_id = mysqli_real_escape_string($conn, $_POST['showtime-id']);
    $total_price = mysqli_real_escape_string($conn, $_POST['booking-total-price']);
    try {
        $insert_record = mysqli_query($conn, "INSERT INTO `moviebooking`.`booking` 
        (`user_id`, `seats`, `total_seats`, `booking_date`, `showtime_id`, `total_price`) 
        VALUES ('$user_id', '$seats', '$total_seats', '$booking_date', '$showtime_id', '$total_price')");

        $_SESSION['msg'] = "Insert successful";
        $_SESSION['error'] = 0;

    } catch (Exception $e) {
        // Handle the exception, log the error, display an error message, etc.
        $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
        $_SESSION['error'] = 1;
    }

    header("Location: ../bookings.php");
    exit();
}

if (isset($_POST['delete-booking-btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $delete_record = mysqli_query($conn, "DELETE FROM booking WHERE id=$id");

    if (!$delete_record) {
        $msg = "Delete unsuccessful";
        $error = 1;
    } else {
        $msg = "Delete successful";
        $error = 0;
    }

    header("Location: ../bookings.php");
    exit();
}