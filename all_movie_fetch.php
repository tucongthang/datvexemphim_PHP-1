<?php

//fetch_data.php

require_once('config/db_connect.php');

if (isset($_POST["action"])) {
    $query = "
		SELECT * FROM movies WHERE status = '1'
	";

    if (isset($_POST['search'])) {
        $search_filter = $_POST["search"];
        $query .= "
            AND (title LIKE '%$search_filter%')
        ";
    }

    if (isset($_POST["genre_id"])) {
        $category_filter = implode("','", $_POST["genre_id"]);
        $query .= "
		 AND genre_id IN('" . $category_filter . "')
		";
    }
    if (isset($_POST["language"])) {
        $language_filter = implode("','", $_POST["language"]);
        $query .= "
		 AND language IN('" . $language_filter . "')
		";
    }

    $statement = $conn->query($query);
    $result = $statement->fetch_all(MYSQLI_ASSOC);
    $total_row = $statement->num_rows;
    $output = '';
    if ($total_row > 0) {
        foreach ($result as $row) {
            if ($row['running'] == 1) {
                $output .= '
			<div class="col-lg-4 col-md-5 col-sm-6">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:1px; height:450px;">
					<img src="admin/image/' . $row['image'] . '" alt="" class="resize" style="height:200px;" >
					<p align="center"><strong><h4>' . $row['title'] . '</h4></strong></p>
					
					director : ' . $row['director'] . ' <br />
					category : ' . $row['genre_id'] . '<br />
					Language : ' . $row['language'] . '</p>
					
				</div>
					<a href="movie_details.php?pass=' . $row['id'] . '" class="btn btn-primary" style="margin-left: 40px;margin-top: -80px;">Book Now</a>
			</div>
			';

            }

            if ($row['running'] == 0) {
                $output .= '
			<div class="col-lg-4 col-md-5 col-sm-6">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:1px; height:450px;">
					<img src="admin/image/' . $row['image'] . '" alt="" class="resize" style="height:200px;" >
					<p align="center"><strong><h4>' . $row['title'] . '</h4></strong></p>
					
					director : ' . $row['director'] . ' <br />
					category : ' . $row['genre_id'] . '<br />
					Language : ' . $row['language'] . '</p>
					
				</div>
					<a href="movie_details.php?pass=' . $row['id'] . '" class="btn btn-primary" style="margin-left: 40px;margin-top: -80px;">Upcoming</a>
			</div>
			';
            }
        }
    } else {
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}

?>