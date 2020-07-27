<?php
$log = $GLOBALS['nav_value'];
$showSignUp = false;
if ($log === 'LOGIN') {
    $showSignUp = true;
    $goto = 'login.php';
} else {
    //go
}
?>

<head>
    <title>Interactive Media Arts Gallery</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="#" class="brand-logo brand-text">Student Gallery</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <?php if ($showSignUp == true) : ?>
                    echo '<li><a href="signup.php" class="btn brand z-depth-0">SIGN UP</a></li>';
                <?php endif ?>
                <li><a href="<?php echo $goto ?>" class="btn brand z-depth-0"><?php echo $log ?></a></li>
            </ul>
        </div>
    </nav>