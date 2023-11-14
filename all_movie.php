<?php
session_start();

require_once('config/db_connect.php');

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All movie page</title>

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
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="  text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <style>

        .part-line {
            margin: 10px 0;
        }

    </style>

</head>

<body>

<?php
include("templates/header.php");
?>
<!-- Page Content -->
<div class="container">
    <div class="row">

        <div class="col-md-3">

            <div class="list-group">
                <h3 class="part-line">Tìm kiếm</h3>
                <input type="text" name="search" id="search" class="form-control search" placeholder="Nhập từ khóa">
            </div>

            <div class="list-group">
                <h3 class="part-line">Thể loại</h3>
                <?php

                $query = "
                    SELECT DISTINCT g.genre_name, genre_id
                    FROM movies m
                    JOIN genre g ON m.genre_id = g.id
                    WHERE m.status = '1'
                    ORDER BY g.genre_name DESC;
                ";
                $statement = $conn->query($query);
                $result = $statement->fetch_all(MYSQLI_ASSOC);
                foreach ($result as $row) {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector genre"
                                      value="<?php echo $row['genre_id']; ?>"> <?php echo $row['genre_name']; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="list-group">
                <h3 class="part-line">Ngôn ngữ</h3>
                <?php
                $query = "
                    SELECT DISTINCT(language) FROM movies WHERE status = '1' ORDER BY language DESC
                    ";
                $statement = $conn->query($query);
                $result = $statement->fetch_all(MYSQLI_ASSOC);
                foreach ($result as $row) {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector language"
                                      value="<?php echo $row['language']; ?>"> <?php echo $row['language']; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-9">
            <br/>
            <div class="row filter_data">

            </div>
        </div>
    </div>

</div>
<?php

include("templates/footer.php");
?>
<style>

</style>

<!-- Js Plugins -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/jquery.slicknav.js"></script>
<script src="assets/js/mixitup.min.js"></script>

<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>

<script>
    $(document).ready(function () {

        filter_data();

        function filter_data() {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var search = $('#search').val();
            var director = get_filter('director');
            var genre_id = get_filter('genre');
            var language = get_filter('language');
            $.ajax({
                url: "all_movie_fetch.php",
                method: "POST",
                data: {action: action, search: search, director: director, genre_id: genre_id, language: language},
                success: function (data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }

        var delayTimer;

        $('#search').keyup(function () {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function () {
                filter_data();
            }, 500);
        });

        $('.common_selector').click(function () {
            filter_data();
        });

        $('#show_range').slider({
            range: true,
            min: 1000,
            max: 65000,
            values: [1000, 65000],
            step: 500,
            stop: function (event, ui) {
                $('#show_show').html(ui.values[0] + ' - ' + ui.values[1]);
                filter_data();
            }
        });

    });
</script>

</body>

</html>
