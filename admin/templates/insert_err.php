<?php
    if ($insert_record) {
        $msg = "Insert successful";
        $error = 0;
    } else {
        throw new Exception("Insert unsuccessful");
    }
} catch (Exception $e) {
    $msg = "An error occurred: " . $e->getMessage();
    $error = 1;
}