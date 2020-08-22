<?php
session_start();
//connect to db
include 'includes/conn.php';
//query users
$query = 'SELECT id, email, username, major, artistic_influence, bio, img, p5_url, semester, course_id, section FROM student_info ORDER BY created_at';

//get result
$result = mysqli_query($conn, $query);

//fetch results
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free mem / close conn
mysqli_free_result($result);
mysqli_close($conn);
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Design Arts</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="admin-container">
        <div class="admin-panel-container">
            <div class="panel-card-info">
                <div class="panel-title student-info">Student Info</div>
                <div class="panel-title student-name">Student Name</div>
                <div class="panel-title student-code">Code Info</div>
                <div class="panel-title student-password">Reset Password</div>
            </div>

            <?php foreach ($students as $student) : ?>
                <?php
                $user_name = htmlspecialchars($student['username']);
                $user_email = htmlspecialchars($student['email']);
                $major = htmlspecialchars($student['major']);
                $artistic_influence = htmlspecialchars($student['artistic_influence']);
                $bio = htmlspecialchars($student['bio']);
                $img = $student['img'];
                $url = htmlspecialchars($student['p5_url']);
                $semester = htmlspecialchars($student['semester']);
                $course_id = htmlspecialchars($student['course_id']);
                $section = htmlspecialchars($student['section']);
                ?>

                <div class="card">
                    <div class="card-student-info-wrapper">
                        <img class="card-avatar" src="<?php echo $img ?>" alt="<?php echo htmlspecialchars($student['username']) ?>" />
                        <div class="card-student-info-container">
                            <p class="card-info-email"><?php echo $user_email ?></p>
                            <div class="card-course-info-container">
                                <p class="card-course-info"><?php echo $semester ?></p>
                                <p class="card-course-info"><?php echo $course_id ?></p>
                                <p class="card-course-info"><?php echo $section ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="card-student-name-container">
                        <p class="card-student-name"><?php echo $user_name ?></p>
                        <p class="card-major"><?php echo $major ?></p>
                    </div>

                    <div class="card-code-info-container">
                        <p class="card-code-info-link"><a href="<?php echo $url ?>"><?php echo $user_name ?>'s Sketches</a> </p> 
                        <p class="card-code-info-fav-artist">Favorite Artist: <?php echo $artistic_influence ?></p>
                    </div>

                    <div class="card-options-container">
                        <button class="card-btn">Reset</button>
                        <div class="card-more">
                            <span class="card-more-circ"></span>
                            <span class="card-more-circ"></span>
                            <span class="card-more-circ"></span>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>