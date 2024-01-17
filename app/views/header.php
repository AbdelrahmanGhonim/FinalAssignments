<?php
include 'head.php';
?>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="progresstracker">Progress Tracker</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog">Blog</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              if (isset($_SESSION["user_name"])) {
                  // User is logged in
                  $userName = $_SESSION["user_name"];

              } else {
                $userName="Guest";
              }
              echo "$userName";

            ?>
          </a>
          <ul class="dropdown-menu">
          <?php
          if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "Guest") {
                // User is logged in, show Logout link
                echo '<li><a class="dropdown-item" href="/signup">Edit</a></li>';
                echo '<li><a class="dropdown-item" href="/login/logout">Logout</a></li>';
            } else {
                // User is not logged in, show Login and Signup links
                echo '<li><a class="dropdown-item" href="/signup">Signup</a></li>';
                echo '<li><a class="dropdown-item" href="/login">Login</a></li>';
            }
          ?>
          </ul>
      </ul>
    </div>
  </div>
</nav>    
</header>
