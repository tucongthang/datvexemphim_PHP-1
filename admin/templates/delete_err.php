<?php
    if ($delete_record) {
        $msg = "Delete successful";
        $error = 0;
    } else {
        throw new Exception("Delete unsuccessful");
    }
} catch (Exception $e) {
    $msg = "An error occurred: " . $e->getMessage();
    $error = 1;
}