<?php
session_start();
//connect to db
include 'includes/conn.php';
//query users
$query = 'SELECT id, email, username, major, artistic_influence, bio, img, p5_url, semester, course_id, section, isActive FROM students ORDER BY created_at';

//get result
$result = mysqli_query($conn, $query);
//fetch results
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);


$init = $_SESSION['has_init'];


foreach ($students as $key => $stud) {
    if ($init != 'init') {
        $opacityActiveStatus[$key] = 'opaque';
        $cardColorActiveStatus[$key] = 'card-active';
        $btnDeactivateStatus[$key] = 'show';
        $btnReactivateStatus[$key] = 'hidden';
        $tester = $_SESSION['has_init'];
        $_SESSION['has_init'] = 'init';
    }

    if (isset($_POST['deactivate-' . $key])) {
        $tester = 'innactive key ' . $key;
        $opacityActiveStatus[$key] = 'no-opaque';
        $cardColorActiveStatus[$key] = 'card-inactive';
        $btnDeactivateStatus[$key] = 'hidden';
        $btnReactivateStatus[$key] = 'show';
        $sql = "UPDATE students 
    SET isActive='0'
     WHERE id='$key'";
        //save to db
        if (mysqli_query($conn, $sql)) {
        } else {
            echo 'query err: ' . mysqli_error($conn);
        }
    } else if (isset($_POST['reactivate-' . $key])) {
        $tester = 'active key ' . $key;
        $opacityActiveStatus[$key] = 'opaque';
        $cardColorActiveStatus[$key] = 'card-active';
        $btnDeactivateStatus[$key] = 'show';
        $btnReactivateStatus[$key] = 'hidden';
        $sql = "UPDATE students 
    SET isActive='1'
     WHERE id='$key'";
        //save to db
        if (mysqli_query($conn, $sql)) {
        } else {
            echo 'query err: ' . mysqli_error($conn);
        }
    }

    if (isset($_POST['remove-' . $key])) {
        $sql = "DELETE FROM students WHERE id='$key'";
        mysqli_query($conn, $sql);
        header('location: admin.php');
    }

    if (isset($_POST['reset-' . $key])) {
        $sql = "UPDATE students 
    SET password='newPW290'
     WHERE id='$key'";
        //save to db
        if (mysqli_query($conn, $sql)) {
        } else {
            echo 'query err: ' . mysqli_error($conn);
        }
    }
}

//free mem / close conn
mysqli_free_result($result);
mysqli_close($conn);

// echo $reactivate;

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
        <div style="font-size: 2rem"><?php echo $tester ?></div>
        <div class="admin-panel-container">
            <div class="panel-card-info">
                <div class="panel-title student-info">Student Info</div>
                <div class="panel-title student-name">Student Name</div>
                <div class="panel-title student-code">Code Info</div>
                <div class="panel-title student-password">Reset Password</div>
            </div>
            <!-- $array as $key =>> $element -->
            <?php foreach ($students as $key => $student) : ?>
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

                <div class="card <?php echo $cardColorActiveStatus[$key] ?> ">
                    <div class="card-student-info-wrapper student-info-opaque <?php echo $opacityActiveStatus[$key] ?>">
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

                    <div class="card-student-name-container student-name-opaque <?php echo $opacityActiveStatus[$key] ?>">
                        <p class="card-student-name"><?php echo $user_name ?></p>
                        <p class="card-major"><?php echo $major ?></p>
                    </div>

                    <div class="card-code-info-container student-code-opaque <?php echo $opacityActiveStatus[$key] ?>">
                        <p class="card-code-info-link"><a href="<?php echo $url ?>"><?php echo $user_name ?>'s Sketches</a> </p>
                        <p class="card-code-info-fav-artist">Favorite Artist: <?php echo $artistic_influence ?></p>
                    </div>

                    <div class="card-options-container">
                        <form action="admin.php" method="post">
                            <button class="card-btn btn-opaque <?php echo $opacityActiveStatus[$key] ?>" name="<?php echo 'reset-' . $key ?>" type="submit">Reset</button>
                            </form>
                            <div class=" admin-dropdown" id="admin-dropdown">
                                <button class="card-more">
                                    <span class="card-more-circ"></span>
                                    <span class="card-more-circ"></span>
                                    <span class="card-more-circ"></span>
                                </button>
                                <div class="admin-dropdown-content">
                                    <form action="admin.php" method="post">
                                        <button class="user-active-status user-active <?php echo $btnDeactivateStatus[$key] ?>" name="<?php echo 'deactivate-' . $key ?>" type="submit">Deactivate</button>
                                    </form>
                                    <form action="admin.php" method="post">
                                        <button class="user-active-status user-inactive <?php echo $btnReactivateStatus[$key] ?>" name="<?php echo 'reactivate-' . $key ?>" type="submit">Reactivate</button>
                                    </form>
                                    <form action="admin.php" method="post">
                                        <button class="user-active-status user-remove" name="<?php echo 'remove-' . $key ?>" type="submit">Remove User</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="js/helpers.js"></script>
</body>

</html>