<?php
session_start();
//connect to db
include 'includes/conn.php';
//query users
$query = 'SELECT id, email, username, major, artistic_influence, img, p5_url, semester, course_id, section, isActive FROM students ORDER BY id';

//get result
$result = mysqli_query($conn, $query);
//fetch results
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
$row = mysqli_fetch_array($result, MYSQLI_NUM);


//check if deactivate button clicked - update isActive for student
if (isset($_POST['deactivate'])) {
    $deactivate = $_POST['deactivate'];
    $sql = "UPDATE students 
    SET isActive='0'
     WHERE id='$deactivate'";
    //save to db
    mysqli_query($conn, $sql);

    header('location: admin.php');
}
//check if reactivate button clicked - update isActive for student
if (isset($_POST['reactivate'])) {
    $reactivate = $_POST['reactivate'];
    $sql = "UPDATE students 
    SET isActive='1'
     WHERE id='$reactivate'";
    //save to db
    mysqli_query($conn, $sql);

    header('location: admin.php');
}
//check if remove button clicked - remove student
if (isset($_POST['remove'])) {
    $remove = $_POST['remove'];

    $sql = "DELETE FROM students WHERE id='$remove'";
    mysqli_query($conn, $sql);


    header('location: admin.php');
}
//check if reset button clicked - reset pw
if (isset($_POST['reset'])) {
    $reset = $_POST['reset'];
    $sql = "UPDATE students 
    SET password='newPW290'
     WHERE id='$reset'";
    //save to db
    mysqli_query($conn, $sql);

    header('location: admin.php');
}

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

    <?php if ($_SESSION['isAdminLoggedIn'] == true) : ?>

        <div class="admin-container">
            <div class="admin-panel-container">
                <div class="panel-card-info">
                    <div class="panel-title student-info">Student Info</div>
                    <div class="panel-title student-name">Student Name</div>
                    <div class="panel-title student-code">Code Info</div>
                    <div class="panel-title student-password">Reset Password</div>
                </div><!-- END OF PANEL-CARD-INFO -->

                <!-- Create CARD for each registered student -->
                <?php foreach ($students as $key => $student) : ?>
                    <?php

                    //set students data
                    $user_id = $student['id'];
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
                    $isActive = $student['isActive'];

                    //check is student is active - set styles
                    if ($isActive == 0) {
                        $opacityActiveStatus = 'no-opaque';
                        $cardColorActiveStatus = 'card-inactive';
                        $btnDeactivateStatus = 'hidden';
                        $btnReactivateStatus = 'show';
                    } else {
                        $opacityActiveStatus = 'opaque';
                        $cardColorActiveStatus = 'card-active';
                        $btnReactivateStatus = 'hidden';
                        $btnDeactivateStatus = 'show';
                    }
                    ?>


                    <div class="card <?php echo $cardColorActiveStatus ?> ">
                        <div class="card-student-info-wrapper student-info-opaque <?php echo $opacityActiveStatus ?>">
                            <img class="card-avatar" src="<?php echo $img ?>" alt="<?php echo htmlspecialchars($student['username']) ?>" />
                            <div class="card-student-info-container">
                                <p class="card-info-email"><?php echo $user_email ?></p>
                                <div class="card-course-info-container">
                                    <p class="card-course-info"><?php echo $semester ?></p>
                                    <p class="card-course-info"><?php echo $course_id ?></p>
                                    <p class="card-course-info"><?php echo $section ?></p>
                                </div>
                            </div>
                        </div><!-- END OF STUDENT-INFO-WRAPPER -->

                        <div class="card-student-name-container student-name-opaque <?php echo $opacityActiveStatus ?>">
                            <p class="card-student-name"><?php echo $user_name ?></p>
                            <p class="card-major"><?php echo $major ?></p>
                        </div><!-- END OF STUDENT-NAME-CONTAINER -->

                        <div class="card-code-info-container student-code-opaque <?php echo $opacityActiveStatus ?>">
                            <p class="card-code-info-link"><a href="<?php echo $url ?>"><?php echo $user_name ?>'s Sketches</a> </p>
                            <p class="card-code-info-fav-artist">Favorite Artist: <?php echo $artistic_influence ?></p>
                        </div><!-- END OF STUDENT-CODE-CONTAINER -->

                        <div class="card-options-container">
                            <form action="admin.php" method="post">
                                <button class="card-btn btn-opaque <?php echo $opacityActiveStatus ?>" name="<?php echo 'reset-' . $user_id ?>" type="submit">Reset</button>
                            </form>
                            <div class=" admin-dropdown" id="admin-dropdown">
                                <button class="card-more">
                                    <span class="card-more-circ"></span>
                                    <span class="card-more-circ"></span>
                                    <span class="card-more-circ"></span>
                                </button>
                                <div class="admin-dropdown-content">
                                    <form action="admin.php" method="post">
                                        <input type="hidden" value="<?php echo $user_id; ?>" name="deactivate" id="deactivate">
                                        <button class="user-active-status user-active <?php echo $btnDeactivateStatus ?>" name="deactivate-user" type="submit">Deactivate</button>
                                    </form>
                                    <form action="admin.php" method="post">
                                        <input type="hidden" value="<?php echo $user_id; ?>" name="reactivate" id="reactivate">
                                        <button class="user-active-status user-inactive <?php echo $btnReactivateStatus ?>" name="reactivate-user" type="submit">Reactivate</button>
                                    </form>
                                    <form action="admin.php" method="post">
                                        <input type="hidden" value="<?php echo $user_id; ?>" name="remove" id="remove">
                                        <button class="user-active-status user-remove" name="remove-user" type="submit">Remove User</button>
                                    </form>
                                </div><!-- END OF ADMIN-DROPDOWN-CONTENT -->
                            </div><!-- END OF ADMIN-DROPDROW -->
                        </div><!-- END OF CARD-OPTIONS-CONTAINER -->
                    </div><!-- END OF CARD -->
                <?php endforeach ?>
            </div><!-- END OF ADMIN-PANEL-CONTAINER -->
        </div><!-- END OF ADMIN-CONTAINER -->
    <?php endif ?>
    <script src="js/helpers.js"></script>
</body>

</html>