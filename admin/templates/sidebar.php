<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="mt-5 sidebar-sticky">
        <ul class="nav flex-column">

          <?php 


            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>


          <li class="nav-item">
            <a class="nav-link" href="Index.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="Theaters.php">
                    <span data-feather="users"></span>
                    Theaters
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Screens.php">
                    <span data-feather="users"></span>
                    Screens
                </a>
            </li>
         <li class="nav-item">
            <a class="nav-link" href="Movies.php">
              <span data-feather="users"></span>
              Movies
            </a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="Showtimes.php">
              <span data-feather="users"></span>
              Showtimes
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="Bookings.php">
              <span data-feather="users"></span>
              Bookings
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="Feedback.php">
              <span data-feather="users"></span>
              Feedback
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="Users.php">
              <span data-feather="users"></span>
              Users
            </a>
          </li>
           
        </ul>


       
      </div>
    </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="mt-5 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Hello <?php echo $_SESSION["admin"]; ?></h1>
        
      </div>