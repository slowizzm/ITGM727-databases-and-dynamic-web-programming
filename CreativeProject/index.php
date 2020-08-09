<?php
session_start();
include 'includes/conn.php';
$username  = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT *FROM student_info WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);

//sessions vars
$_SESSION['id'] = $row[0];
$_SESSION['user'] = $row[3];
$_SESSION['img'] = $row[8];
$_SESSION['isLoggedIn'] = false;

//error list
$errs = array('username' => '', 'password' => '');

if ($row > 1) {
    if ($row[1] == 0) {
        header('location: admin.php');
    } else if ($row[1] == 1) {
        $_SESSION['isLoggedIn'] = true;
        header('location: gallery.php');
    } else {
        echo 'err: you are not an admin or user';
    }
} else {
    //check errs and redirect user
    if (array_filter($errs)) {
        echo 'err';
    } else {
        // header('Location: results.php');
        // echo "<script> alert('username and password do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Arts Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>

    <div class="container">
        <!-- FORM -->
        <form class="form" action="index.php" method="POST">

            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Name" required>

            <input type="password" name="password" value="" required>

            <input type="submit" name="submit" value="LOGIN" class="btn">
            <p class="nav_options">Don't have an account? <a href="signup.php" class="signup-btn">Signup</a></p>
        </form> <!-- END OF FORM -->
    </div>



</body>

</html>