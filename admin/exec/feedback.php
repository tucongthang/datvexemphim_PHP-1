<?php

session_start();

require_once('../../config/db_connect.php');

if (isset($_POST['delete-feedback'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $delete_record = mysqli_query($conn, "DELETE FROM feedback WHERE id=$id");

    if (!$delete_record) {
        $msg = "Delete unsuccessful";
        $error = 1;
    } else {
        $msg = "Delete successful";
        $error = 0;
    }

    header("Location: ../feedback.php");
    exit();
}