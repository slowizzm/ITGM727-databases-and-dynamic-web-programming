<?php
session_start();

//connect to db
include 'includes/conn.php';
//init empty variables

//error list
$errs = array('email' => '', 'username' => '', 'password' => '', 'semester' => '', 'course_id' => '', 'section' => '');

//validation
if (isset($_POST['submit'])) {

    //set vars from post submit
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $semester = 'FA20';
    $course_id = 'MED290';
    $section = '001';

    //create sql
    $sql = "INSERT INTO students(email,username,password,semester,course_id,section) VALUES('$email', '$username', '$password', '$semester', '$course_id', '$section')";

    //save to db
    if (mysqli_query($conn, $sql)) {

        //connect to database and query results depending on if admin or student
        $username  = $_POST['username'];
        $password = $_POST['password'];
        $student_query = "SELECT *FROM students WHERE username='$username' AND password='$password'";

        //set row for student
        $student_result = mysqli_query($conn, $student_query);
        $student_row = mysqli_fetch_array($student_result, MYSQLI_NUM);

        if ($student_row > 1) {
            $_SESSION['id'] = $student_row[0];
            $_SESSION['user'] = $student_row[2];

            $_SESSION['isStudentLoggedIn'] = true;
            header('location: profile.php');
        }
    } else {
        echo 'query err: ' . mysqli_error($conn);
    }
}
//free mem / close conn
mysqli_free_result($result);
mysqli_close($conn);
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
    </div><!-- END OF CONTAINER -->
</body>

</html>