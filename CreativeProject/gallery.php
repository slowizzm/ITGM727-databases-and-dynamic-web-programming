<?php
$log = $_GET['isLoggedIn'];
if ($log == true) {
    $GLOBALS['nav_value'] = 'profile';
} else {
    $GLOBALS['nav_value'] = 'login';
}
//connect to db
include 'includes/conn.php';
//query users
$query = 'SELECT id, email, username, semester, major, course_id, section, img, p5_url FROM student_info ORDER BY created_at';

//get result
$result = mysqli_query($conn, $query);

//fetch results
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free mem / close conn
mysqli_free_result($result);
mysqli_close($conn);

$i = 1;
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Design Arts</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/g.css">



</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- CONTAINER -->
    <div class="container">
        <h1 class="label"> Students </h1>
        <div class="cards-container">

            <?php foreach ($students as $student) : ?>
                <?php
                $user_name = htmlspecialchars($student['username']);
                $user_email = htmlspecialchars($student['email']);
                $major = htmlspecialchars($student['major']);
                $semester = htmlspecialchars($student['semester']);
                $course = htmlspecialchars($student['course_id']);
                $section = htmlspecialchars($student['section']);
                $img = $student['img'];
                $url = htmlspecialchars($student['p5_url']);
                ?>



                <div class="card">
                    <div class="card-header">
                        <div class="card-cover"></div>
                        <img class="card-avatar" src="<?php echo $img ?>" alt="<?php echo htmlspecialchars($student['username']) ?>" />
                        <h1 class="card-fullname"><?php echo $user_name ?></h1>
                        <h2 class="card-jobtitle"><?php echo $major ?></h2>
                    </div>
                    <div class="card-main">
                        <div class="card-section">
                            <div class="card-content">
                                <div class="card-subtitle">ABOUT</div>
                                <ul class="card-info">
                                    <li><?php echo $user_email ?></li>
                                    <li><?php echo $semester ?></li>
                                    <li><?php echo $course ?></li>
                                    <li><?php echo 'section ' .  $section ?></li>
                                </ul>
                            </div>
                        </div>
                        <button class="card-action" onclick="window.open('<?php echo $url ?>', '_blank')">
                            <span class="card-url"> P5.js Sketches </span>
                            <i class="card-url fa fa-angle-right"> </i>
                        </button>
                    </div>
                </div>

            <?php endforeach ?>
        </div>
    </div>

</body>

</html>