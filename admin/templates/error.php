<?php

if (isset($_SESSION['msg']) && isset($_SESSION['error'])) {
    $msg = $_SESSION['msg'];
    $error = $_SESSION['error'];

    ?>
    <div class="row">
        <div class="alert <?php echo ($error == 0) ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show mt-3"
             role="alert">
            <?php echo $msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="clearSession()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php
}

?>


