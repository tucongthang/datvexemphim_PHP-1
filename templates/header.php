<!-- Page Preloder -->
<!--<div id="preloder">-->
<!--    <div class="loader"></div>-->
<!--</div>-->
<!-- css option -->

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="login.html">Sign in</a>

        </div>

    </div>

    <div id="mobile-menu-wrap"></div>

</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 bg-dark">

                </div>
                <?php
                require_once("config/db_connect.php");
                if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $result = $conn->query("SELECT * FROM users WHERE username ='" . $username . "'");

                ?>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            if ($row['image'] == '') {
                                                echo '<img src="../assets/images/img_avatar.png" alt="Avatar" class="avatar">';
                                            } else {
                                                ?>  <img src="uploads/<?php echo $row["image"]; ?>" alt="Avatar"
                                                         class="avatar">
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                    <span>Hii <?php echo $_SESSION['username']; ?></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Option 1</a></li>
                                    <li><a class="dropdown-item" href="#">Option 2</a></li>
                                    <li><a class="dropdown-item" href="#">Option 3</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        } else {
                            ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="header__top__right">
                                    <div class="header__top__links">
                                        <a href="login.php">Sign in</a>
                                        <a href="register.php">Register</a>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="assets/images/logo.png" alt="" style="width: 150px;"></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="all_movie.php">All Movie</a></li>
                        <li><a href="about.php">About US</a></li>
                        <li><a href="feedback.php">Feedback</a></li>
                        <li><a href="contact.php">Contacts</a></li>
                    </ul>
                </nav>
            </div>

        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
