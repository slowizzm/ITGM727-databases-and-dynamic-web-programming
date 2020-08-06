<?php

$isLoggedIn = $_SESSION['isLoggedIn'];
$nav_img = $_SESSION['img'];
$user_name = $_SESSION['user'];
$isLoggedIn = $_SESSION['isLoggedIn'];
?>

<!-- TODO - Setup logout -->

<nav class="nav-wrapper">
    <div class="nav-container">
        <a href="gallery.php" class="btn brand" style="text-transform: uppercase">Interactive Media Design Arts</a>
        <div class="user-nav">
            <div class="btn-wrapper">
                <?php if ($isLoggedIn == true) {
                    echo  '<img src="' . $nav_img . '" class="usrimg">';
                    echo '<a href="profile.php" class="btn" style="text-transform: uppercase">' . $user_name . '</a>';
                } else {
                    echo '<a href="login.php" class="btn" style="text-transform: uppercase">Login</a>';
                    echo '<a href="signup.php" class="btn">SIGN UP</a>';
                } ?>
            </div>
        </div>
    </div>
</nav>