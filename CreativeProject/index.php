<?php
session_start();
include 'includes/conn.php';

//connect to database and query results depending on if admin or student
$username  = $_POST['username'];
$password = $_POST['password'];
$admin_query = "SELECT *FROM admins WHERE username='$username' AND password='$password'";
$student_query = "SELECT *FROM students WHERE username='$username' AND password='$password'";

//set row for admin
$admin_result = mysqli_query($conn, $admin_query);
$admin_row = mysqli_fetch_array($admin_result, MYSQLI_NUM);

//set row for student
$student_result = mysqli_query($conn, $student_query);
$student_row = mysqli_fetch_array($student_result, MYSQLI_NUM);

//sessions vars
$_SESSION['isAdminLoggedIn'] = false;
$_SESSION['isStudentLoggedIn'] = false;
$_SESSION['has_init'] = false;

//error list
$errs = array('username' => '', 'password' => '');

//check if admin or student logged in - set sessoion vars accordingly and redirect
if ($admin_row > 1) {
    $_SESSION['id'] = $admin_row[0];
    $_SESSION['user'] = $admin_row[2];
    $_SESSION['img'] = $admin_row[4];

    $_SESSION['isAdminLoggedIn'] = true;
    header('location: admin.php');
}
if ($student_row > 1) {
    $_SESSION['id'] = $student_row[0];
    $_SESSION['user'] = $student_row[2];
    $_SESSION['img'] = $student_row[7];

    $_SESSION['isStudentLoggedIn'] = true;
    header('location: gallery.php');
} else {
    //check errs and redirect user
    if (array_filter($errs)) {
        echo 'err';
    } else {
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
    <!-- LOGIN FORM -->
    <div class="container">
        <!-- FORM -->
        <form class="form" action="index.php" method="POST">

            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Name" required>

            <input type="password" name="password" value="" required>

            <input type="submit" name="submit" value="LOGIN" class="btn">
            <p class="nav_options">Don't have an account? <a href="signup.php" class="signup-btn">Signup</a></p>
        </form><!-- END OF FORM -->
    </div><!-- END OF CONTAINER -->

</body>

</html>