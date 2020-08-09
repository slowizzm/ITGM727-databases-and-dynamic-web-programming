<?php

//connect to db
include 'includes/conn.php';
//init empty variables
$email = $username = $password = '';
//error list
$errs = array('email' => '', 'username' => '', 'password' => '');

//validation
if (isset($_POST['submit'])) {


    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //create sql
    $sql = "INSERT INTO student_info(email,username,password) VALUES('$email', '$username', '$password')";

    //save to db
    if (mysqli_query($conn, $sql)) {
        echo $email;
        // header('location: user.php');

    } else {
        echo 'query err: ' . mysqli_error($conn);
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
        <form class="form signup" action="signup.php" method="POST">

            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" placeholder="Email" required>

            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Name" required>

            <input type="password" name="password" value="" placeholder="Password" required>

            <input type="submit" name="submit" value="SIGN UP" class="btn">
            <p class="nav_options">Already have an account? <a href="index.php" class="signup-btn">Login</a></p>
        </form> <!-- END OF FORM -->
    </div>
</body>

</html>