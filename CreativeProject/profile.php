<?php
session_start();
$GLOBALS['nav_value'] = 'Gallery';


//includes
include 'includes/conn.php';
include 'includes/writeUserImg.php';
include 'includes/timestamp.php';

// folder
$folder_userImgs = 'userImgs';


$user = $_SESSION['id'];
$query = "SELECT *FROM student_info WHERE id='$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);

// print_r($row);

//init user data
$user_id = $row[0];
$email = $row[1];
$username = $row[2];
$password = $row[3];
$major = $row[5];
$semester = $row[6];
$course = $row[7];
$section = $row[8];
$img = $row[10];
$url = $row[11];


if (isset($_POST['submit_pw'])) {
    if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT *from student_info WHERE id='" . $_SESSION["id"] . "'");
        $row = mysqli_fetch_array($result);

        if ($_POST["currentPassword"] == $row["password"]) {
            mysqli_query($conn, "UPDATE student_info set password='" . $_POST["newPassword"] . "' WHERE id='" . $_SESSION["id"] . "'");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
}



//validation
if (isset($_POST['submit_data'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $course = mysqli_real_escape_string($conn, $_POST['course_id']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $url = mysqli_real_escape_string($conn, $_POST['p5_url']);

    //update sql
    $sql = "UPDATE student_info 
    SET username='$username'
    ,major='$major'
    ,semester='$semester'
    ,course_id='$course'
    ,section='$section'
    ,p5_url='$url'
    ,email='$email'
     WHERE id='$user_id'";
    //save to db
    if (mysqli_query($conn, $sql)) {
    } else {
        echo 'query err: ' . mysqli_error($conn);
    }
}

if (isset($_POST['submit_userImg'])) {

    // store date and time
    $date .= date('n/d/Y');
    $time = date('g:i a');


    // check if guest uploaded img
    if ($_FILES['userImg'] && $_FILES['userImg']['size'] > 0) {
        // store img
        $imgUpload = $_FILES['userImg'];
        // print_r($imgUpload);

        // save img
        $img = writeUserImg($folder_userImgs, $imgUpload);

        // echo $img;
    } else {
        // no img uploaded - set empty string
        $img = '';
        echo 'no img loaded';
    }

    // strip spaces
    $img = str_replace(' ', '', $img);


    echo $img;
    //update sql
    $sql = "UPDATE student_info 
    SET img='$img'
     WHERE id='$user_id'";
    //save to db
    if (mysqli_query(
        $conn,
        $sql
    )) {
    } else {
        echo 'query err: ' . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Arts Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>


    <div class="container">

        <div class="card-container">

            <div class="card">
                <div class="card-body">

                    <div class="user-row">
                        <div class="user-img-container">
                            <div class="img-container" style="width: 140px;">
                                <img src="<?php echo $img ?>" class="img" style="height: 140px; background-color: rgb(233, 236, 239);"> <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span></img>
                                <div class="img-upload">
                                    <div class="form-group file-upload">
                                        <form action="profile.php" method="post" enctype="multipart/form-data">
                                            <label class="file-upload-text" for="guestImg">Upload Photo</label>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                            <input type="file" accept=".png, .jpg, .jpeg" class="input-file" name="userImg">
                                            <div class="col save-wrap"> <button class="btn-save" type="submit" name="submit_userImg">Save Changes</button></div>
                                        </form>
                                    </div>
                                </div><!-- END OF IMG-UPLOAD -->
                            </div><!-- END OF IMG-CONTAINER -->

                        </div><!-- END OF USER-IMG-CONTAINER -->
                        <div class="user-info-wrap">
                            <div class="user-info">
                                <h4 class="username"><?php echo $username ?></h4>
                            </div>
                        </div><!-- END OF USER-INFO-WRAP -->
                    </div><!-- END OF USER-ROW -->


                    <!-- USER DATA -->

                    <form class="form" action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="user-input-container">
                            <div class="user-input-row">
                                <div class="user-input-col">
                                    <div class="col">
                                        <div class="form-group"> <label>Name</label> <input class="form-control" type="text" name="username" value="<?php echo $username ?>" required style="background-image: url(); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> <label>Major</label> <input class="form-control" type="text" name="major" placeholder="Major" value="<?php echo $major ?>" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> <label>Semester</label> <input class="form-control" type="text" name="semester" placeholder="Current Semester" value="<?php echo $semester ?>" required></div>
                                    </div>
                                </div><!-- END OF USER-INPUT-COL -->
                                <div class="user-input-col">
                                    <div class="col">
                                        <div class="form-group"> <label>Course</label> <input class="form-control" type="text" name="course_id" placeholder="Course Id" value="<?php echo $course ?>" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> <label>Section</label> <input class="form-control" type="text" name="section" placeholder="Course Section" value="<?php echo $section ?>" required></div>
                                    </div>
                                    <div class=" col">
                                        <div class="form-group"> <label>P5.js URL</label> <input class="form-control" type="text" name="p5_url" placeholder="P5.js Sketches url" value="<?php echo $url ?>" required></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> <label>Email</label> <input class="form-control" type="text" name="email" placeholder="email" value="<?php echo $email ?>" required></div>
                                    </div>
                                </div><!-- END OF COL -->
                            </div><!-- END OF USER-INPUT-ROW -->
                            <div class="row">
                                <div class="col save-wrap"> <button class="btn-save" type="submit" name="submit_data">Save Changes</button></div>
                            </div>
                    </form> <!-- END OF FORM -->
                </div><!-- END OF USER-INPUT-CONTAINER -->


                <!-- VALIDATE PASSWORD -->


                <form name="frmChange" method="post" action="" onsubmit="return validatePassword()">
                    <div class="user-pw-container">
                        <div class="user-input-col">
                            <div id="message" class="message"><?php if (isset($message)) {
                                                                    echo $message;
                                                                } ?></div>
                            <div class="password"><b>Change Password</b></div>
                            <div class="col">
                                <div class="form-group pw"> <label>Current Password</label> <input class="form-control" type="password" name="currentPassword" placeholder="*****" required></div>
                            </div>
                            <div class="col">
                                <div class="form-group pw"> <label>New Password</label> <input class="form-control" type="password" name="newPassword" placeholder="*****" required></div>
                            </div>
                            <div class="col">
                                <div class="form-group pw"> <label id="confirmPassword">Confirm Password</label> <input class="form-control" type="password" name="confirmPassword" placeholder="*****" required></div>
                            </div>
                        </div><!-- END OF COL -->
                    </div>
                    <div class="col save-wrap"> <button class="btn-save" type="submit" name="submit_pw">Save Changes</button></div>
                </form>


            </div><!-- END OF CARD-BODY -->
        </div><!-- END OF CARD -->

    </div><!-- END OF CARD-CONTAINER -->

    </div><!-- END OF CONTAINER -->


    <script>
        function validatePassword() {
            let currentPassword, newPassword, confirmPassword, output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            confirmPassword = document.frmChange.confirmPassword;

            if (newPassword.value != confirmPassword.value) {
                newPassword.value = "";
                confirmPassword.value = "";
                newPassword.focus();
                document.getElementById("message").innerHTML = "not same";
                output = false;
            }

            return output;
        }
    </script>

</body>

</html>