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
    <link rel="stylesheet" type="text/css" href="css/signup.css">
</head>

<body>
    <div class="container">
        <!-- FORM -->
        <form class="form" action="signup.php" method="POST">

            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" placeholder="Email" required>

            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Name" required>

            <input type="password" name="password" value="" required>

            <input type="submit" name="submit" value="Sign Up" class="btn">
            <div class="login">
                <p>Already have an account?</p> <a href="index.php">Login</a>
            </div>
        </form> <!-- END OF FORM -->
    </div>
</body>

</html>