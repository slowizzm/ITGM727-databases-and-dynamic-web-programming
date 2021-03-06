<?php

//set vars from session
$isAdminLoggedIn = $_SESSION['isAdminLoggedIn'];
$isStudentLoggedIn = $_SESSION['isStudentLoggedIn'];
$nav_img = $_SESSION['img'];
$user_name = $_SESSION['user'];
?>

<!-- NAV - checks is admin or user is logged in and display info accordingly -->
<nav class="nav-wrapper">
  <div class="nav-container">
    <a href="gallery.php" class="btn brand" style="text-transform: uppercase">Interactive Media Design Arts</a>
    <div class="user-nav">
      <div class="btn-wrapper">
        <?php
        // if admin
        if ($isAdminLoggedIn == true) {
          echo  '<img src="' . $nav_img . '" class="usrimg">';
          echo '<div class="dropdown">
    <button class="dropbtn">' . $user_name . ' 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="admin-profile.php">Edit Profile</a>
      <a href="login.php">Log Out</a>
    </div>
  </div> ';
          //  if student
        } else if ($isStudentLoggedIn == true) {
          echo  '<img src="' . $nav_img . '" class="usrimg">';
          echo '<div class="dropdown">
    <button class="dropbtn">' . $user_name . ' 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="profile.php">Edit Profile</a>
      <a href="login.php">Log Out</a>
    </div>
  </div> ';
        } else {
          echo '<a href="login.php" class="btn" style="text-transform: uppercase">Login</a>';
          echo '<a href="signup.php" class="btn">SIGN UP</a>';
        }
        ?>
      </div><!-- END OF BSTN-WRAPPER -->
    </div><!-- END OF USER-NAV -->
  </div><!-- END OF NAV-CONTAINER -->
</nav>