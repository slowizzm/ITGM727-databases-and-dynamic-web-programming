<?php
session_start();
include 'includes/conn.php';
$username  = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT *FROM student_info WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);
$isLoggedIn = false;
$_SESSION['id'] = $row[0];

//error list
$errs = array('username' => '', 'password' => '');

if ($row > 1) {
    if ($row[4] == 0) {
        header('location: admin.php');
    } else if ($row[4] == 1) {
        header('location: gallery.php?isLoggedIn=true;');
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

            <input type="submit" name="submit" value="submit" class="btn">
            <a href="">Lost your password?</a>
        </form> <!-- END OF FORM -->
    </div>

    

</body>

</html>