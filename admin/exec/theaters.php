<?php

session_start();

require_once ('../../config/db_connect.php');

if (isset($_POST['add-theater-btn'])) {
    $theater_name = mysqli_real_escape_string($conn, $_POST['theater-name']);
    $theater_address = mysqli_real_escape_string($conn, $_POST['theater-address']);
    $theater_phone = mysqli_real_escape_string($conn, $_POST['theater-phone']);

    $insert_record = mysqli_query($conn, "INSERT INTO theaters (`theater_name`, `theater_address`, `theater_phone`) VALUES ('" . $theater_name . "','" . $theater_address . "','" . $theater_phone . "')");

    if (!$insert_record) {
        $_SESSION['msg'] = "Insert unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Insert successful";
        $_SESSION['error'] = 0;
        header("Location: ../theaters.php");
        exit();
    }
}

if (isset($_POST['edit-theater-btn'])) {
    $e_id = mysqli_real_escape_string($conn, $_POST['e-id']);
    $edit_theater_name = mysqli_real_escape_string($conn, $_POST['edit-theater-name']);
    $edit_theater_address = mysqli_real_escape_string($conn, $_POST['edit-theater-address']);
    $edit_theater_phone = mysqli_real_escape_string($conn, $_POST['edit-theater-phone']);

    $update_record = mysqli_query($conn, "UPDATE `theaters` SET `theater_name` = '$edit_theater_name', `theater_address` = '$edit_theater_address', `theater_phone` = '$edit_theater_phone' WHERE `id` = '$e_id'");

    if (!$update_record) {
        $_SESSION['msg'] = "Update unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Update successful";
        $_SESSION['error'] = 0;
        header("Location: ../theaters.php");
        exit();
    }
}

if (isset($_POST['delete-theater-btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete-theater-id']);

    $delete_record = mysqli_query($conn, "DELETE FROM theaters WHERE id=$id");

    if (!$delete_record) {
        $_SESSION['msg'] = "Delete unsuccessful";
        $_SESSION['error'] = 1;
    } else {
        $_SESSION['msg'] = "Delete successful";
        $_SESSION['error'] = 0;
        header("Location: ../theaters.php");
        exit();
    }
}
