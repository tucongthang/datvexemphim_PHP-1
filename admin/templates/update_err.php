<?php
    if ($update_record) {
        $msg = "Update successful";
        $error = 0;
    } else {
        throw new Exception("Update unsuccessful");
    }
} catch (Exception $e) {
    $msg = "An error occurred: " . $e->getMessage();
    $error = 1;
}