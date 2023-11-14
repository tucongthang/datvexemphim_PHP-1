<!DOCTYPE html>
<!-- Designed by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Responsive Registration Form | CodingLab</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="assets/js/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

    <?php
    session_start();
    require_once("config/db_connect.php");

    function uploadFile($file)
    {
        $filename = $file['name'];
        $location = 'uploads/' . $filename;

        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        $image_ext = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($file_extension, $image_ext)) {
            if (move_uploaded_file($file['tmp_name'], $location)) {
                return $location;
            }
        }

        return false;
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $uploadedLocation = uploadFile($_FILES['image']);

        if ($uploadedLocation) {
            $insert_record = mysqli_query($conn, "INSERT INTO users (`username`,`email`,`phone`,`city`,`password`,`image`)VALUES('" . $username . "','" . $email . "','" . $phone . "','" . $city . "','" . $password . "','" . $uploadedLocation . "')");

            if ($insert_record) {
                $_SESSION['msg'] = "Đăng ký thành công";
                header("Location: index.php");
                exit();
            } else {
                $msg = "Đăng ký không thành công";
            }
        } else {
            $msg = "Định dạng file không hợp lệ";
        }
    }
    ?>

    <center><a href="./index.html"><img src="assets/img/logo.png" alt="" style="margin: 30px 0; width: 35%;"></a></center>
    <div class="title">Registration</div>
    <div class="content">
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <div id="php-message"><?php echo isset($msg) ? $msg : ''; ?></div>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">UserName</span>
                    <input type="text" id="username" name="username" placeholder="Enter your name" required
                           pattern="[a-zA-Z]+">
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="tel" id="number" name="phone" placeholder="Enter your Phone Number" required
                           pattern="[0-9]{10}">
                </div>
                <div class="input-box">
                    <span class="details">City</span>
                    <input type="text" id="city" name="city" placeholder="Enter your City" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                           pattern=".{3,10}">
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required
                           pattern=".{3,10}">
                </div>
                <div class="input-box">
                    <span class="details">Image uploaded (Option)</span>
                    <input type="file" id="image" name="image">
                </div>
            </div>
            <p id="error_para"></p>
            <div id="err"></div>
            <div class="button">
                <input type="submit" value="Register" id="submit" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>
