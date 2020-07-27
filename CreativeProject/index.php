<?php

include 'conn.php';
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT *FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$isLoggedIn = false;

//error list
$errs = array('username' => '', 'password' => '');

if ($row > 1) {
    if ($row[3] == 0) {
        header('location: admin.php');
    } else {
        header('location: gallery.php?isLoggedIn=true;');
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

//validation
if (isset($_POST['submit'])) {
    //validate username
    if (empty($_POST['username'])) {
        $errs['username'] = 'req username';
    } else {
        $username = $_POST['username'];
        if (!preg_match('/^[a-zA-Z\s]+$/', trim($username))) {
            $errs['username'] = 'must use letters and spaces only';
        }
    }
} // end of validation
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Arts Gallery</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <section class="container grey-text" style="margin-top: 120px">
        <h4 class="center">LOGIN</h4>
        <form class="white" action="index.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            <div class=" red-text"><?php echo $errs['username']; ?></div>
            <label>Password:</label>
            <input type="password" name="password" value="">
            <div class="red-text"><?php echo $errs['password']; ?></div>
            <div class="center" style="margin-top: 20px">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
</body>

</html>