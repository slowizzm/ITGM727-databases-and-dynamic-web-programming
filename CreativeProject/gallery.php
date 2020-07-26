<?php
$server = 'localhost';
$user = 'slow_izzm';
$password = 'd33';
$db = 'student_gallery';
//connect to database
$conn = mysqli_connect($server, $user, $password, $db);

//check connection
if (!$conn) {
    echo 'connection err: ' . mysqli_connect_error();
}

//query users
$query = 'SELECT id, email, username, semester, course_id, section, img, p5_url FROM student_info ORDER BY created_at';

//get result
$result = mysqli_query($conn, $query);

//fetch results
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free mem / close conn
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'temp/header.php'; ?>

<div class="container">
    <div class="row">
        <?php foreach ($students as $student) : ?>
            <?php
            $username = htmlspecialchars($student['username']);
            $email = htmlspecialchars($student['email']);
            $semester = htmlspecialchars($student['semester']);
            $course = htmlspecialchars($student['course_id']);
            $section = htmlspecialchars($student['section']);
            $img = 'images/' . $student['img'];
            $url = htmlspecialchars($student['p5_url']);
            ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <img src="<?php echo $img ?>" alt="<?php echo htmlspecialchars($student['username']) ?>" style="width:100%">
                        <h1 class="username"><?php echo $username ?></h1>
                        <ul class="info">
                            <li><?php echo 'email: ' . $email ?></li>
                            <li><?php echo 'semester: ' .  $semester ?></li>
                            <li><?php echo 'course: ' .  $course ?></li>
                            <li><?php echo 'section: ' .  $section ?></li>

                        </ul>
                        <!-- <p class="course_id"><?php echo htmlspecialchars($student['course_id']) ?></p> -->
                    </div>
                    <p><button onclick="window.open('<?php echo $url ?>', '_blank')">P5.js Sketches</button></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

</body>

</html>