<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback Page</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>

<?php
include("templates/header.php");

require_once("config/db_connect.php");


if (isset($_POST['username'], $_POST['email'], $_POST['message'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($username != '' && $email != '' && $message != '') {

        $feedback_name = mysqli_real_escape_string($conn, $username);
        $feedback_email = mysqli_real_escape_string($conn, $email);
        $feedback_message = mysqli_real_escape_string($conn, $message);

        $query = "INSERT INTO feedback (`name`,`email`,`message`)VALUES('" . $feedback_name . "','" . $feedback_email . "','" . $feedback_message . "')";

        $insert_record = mysqli_query($conn, $query);

        if (!$insert_record) {
            $rs = 0;
            $msg = "Failed to send feedback.";
        } else {
            $rs = 1;
            $msg = "Feedback sent successfully.";
        }
    } else {
        $rs = 0;
        $msg = "Please fill in all fields.";
    }
}
?>
<div class="content">
    <div class="fluid-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-5 mb-lg-0">
                        <h2 class="mb-5">Fill the form. <br> It's easy.</h2>
                        <form action="" method="post">
                            <?php
                            if (isset($msg)) {
                                echo '<div class="row">';
                                echo '<div class="col-md-12">';
                                echo '<p class="alert ' . ($rs == 0 ? 'alert-danger' : 'alert-success') . '">' . $msg . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="username" id="feedbackname"
                                           placeholder="First name" required pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="email" class="form-control" name="email" id="feedbackemail"
                                           placeholder="Email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="message" id="feedbackmessage" cols="30"
                                              rows="7" placeholder="Write your message" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="submit" data-toggle="modal"
                                            class="btn btn-dark" value="Send Massage">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 ml-auto">
                        <h3 class="mb-4">Let's talk about everything.</h3>
                        <p>Do Let Us Carnow Your Thoughts and Suggestions on How We Can Survey You Better. Give us
                            feedback on how you feel about our service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script type="text/javascript">
    // JavaScript code (feedbackvalidate) can be placed here if needed
</script>
</body>

</html>
