<?php
$showSignUp = false;
if ($nav_value === 'login') {
    $showSignUp = true;
}
$goto = $nav_value . '.php';
?>

<!-- TODO - Setup logout -->

<nav class="nav-wrapper">
    <div class="nav-container">
        <a href="#" class="brand-text">IMDA</a>
        <ul class="btn-wrapper">
            <?php if ($showSignUp == true) : ?>
                <?php echo '<li><a href="signup.php" class="btn brand">SIGN UP</a></li>'; ?>
            <?php endif ?>
            <li><a href="<?php echo $goto ?>" class="btn brand" style="text-transform: uppercase" ><?php echo $nav_value ?></a></li>
        </ul>
    </div>
</nav>