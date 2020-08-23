<?php
session_start();


//includes
include 'includes/conn.php';
include 'includes/writeUserImg.php';
include 'includes/timestamp.php';

// folder
$folder_studentImgs = 'studentImgs';


$user = $_SESSION['id'];
$query = "SELECT *FROM students WHERE id='$user'"; 
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);
// print_r($row);

//init user data
$user_id = $row[0];
$email = $row[1];
$username = $row[2];
$password = $row[3];
$major = $row[4];
$artistic_influence = $row[5];
$bio = $row[6];
$img = $row[7];
$url = $row[8];
$semester = $row[9];
$course_id = $row[10];
$section = $row[11];



if (isset($_POST['submit_pw'])) {
    if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT *from students WHERE id='" . $_SESSION["id"] . "'");
        $row = mysqli_fetch_array($result);

        if ($_POST["currentPassword"] == $row["password"]) {
            mysqli_query($conn, "UPDATE students set password='" . $_POST["newPassword"] . "' WHERE id='" . $_SESSION["id"] . "'");
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
    $artistic_influence = mysqli_real_escape_string($conn, $_POST['artistic_influence']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $url = mysqli_real_escape_string($conn, $_POST['p5_url']);

    //update sql
    $sql = "UPDATE students 
    SET username='$username'
    ,email='$email'
    ,major='$major'
    ,artistic_influence='$artistic_influence'
    ,bio='$bio'
    ,p5_url='$url'
     WHERE id='$user_id'";
    //save to db
    if (mysqli_query($conn, $sql)) {
    } else {
        echo 'query err: ' . mysqli_error($conn);
    }
    $_SESSION['user'] = $username;
}

if (isset($_FILES['upload_studentImg'])) {

    // store date and time
    $date .= date('n/d/Y');
    $time = date('g:i a');


    // $path = "images";
    // $filename =  $path . "/" . $_POST['delete_file']; // build the full path here
    if (file_exists($img)) {
        unlink($img);
        echo 'File ' . $img . ' has been deleted';
    } else {
        echo 'Could not delete ' . $img . ', file does not exist';
    }


    // check if guest uploaded img
    if ($_FILES['upload_studentImg'] && $_FILES['upload_studentImg']['size'] > 0) {
        // store img
        $imgUpload = $_FILES['upload_studentImg'];
        print_r($imgUpload);

        // save img
        $img = writeUserImg($folder_studentImgs, $imgUpload);

        // echo $img;
    } else {
        // no img uploaded - set empty string
        $img = '';
        echo 'no img loaded';
    }

    // strip spaces
    $img = str_replace(' ', '', $img);

    //update sql
    $sql = "UPDATE students 
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


    $_SESSION['img'] = $img;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive Media Arts Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
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
                                <img src="<?php echo $img ?>" class="img"> <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span></img>
                                <div class="img-upload">
                                    <div class="form-group file-upload">
                                        <form action="profile.php" method="post" enctype="multipart/form-data">
                                            <div class="img-change-wrap">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                                <input type="file" accept=".png, .jpg, .jpeg" class="input-file" name="upload_studentImg" onchange="this.form.submit()" />
                                                <button class="btn-file-upload" type="" name="submit_studentImg">Change Photo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- END OF IMG-UPLOAD -->
                            </div><!-- END OF IMG-CONTAINER -->

                        </div><!-- END OF USER-IMG-CONTAINER -->
                        <div class="user-info-wrap">
                            <div class="user-info">
                                <h4 class="username"><?php echo $username ?></h4>
                                <ul class="course-info">
                                    <li class="course-item"><?php echo 'Semester: ' . $semester ?></li>
                                    <li class="course-item"><?php echo 'Course ID: ' . $course_id ?></li>
                                    <li class="course-item"><?php echo 'Section: ' . $section ?></li>
                                </ul>

                            </div>
                        </div><!-- END OF USER-INFO-WRAP -->
                    </div><!-- END OF USER-ROW -->

                    <div class="forms">

                        <!-- USER DATA -->
                        <form class="form-data" action="profile.php" method="post" enctype="multipart/form-data">
                            <div class="user-input-container">
                                <div class="user-input-row">
                                    <div class="user-input-col">
                                        <div class="col">
                                            <div class="form-group"> <label>Name</label> <input class="form-control" type="text" name="username" value="<?php echo $username ?>" required style="background-image: none !important;"></div>
                                            <div class="form-group"> <label>Major</label> <input class="form-control" type="text" name="major" placeholder="Major" value="<?php echo $major ?>" required></div>
                                            <div class="form-group"> <label>Artistic Influence</label> <input class="form-control" type="text" name="artistic_influence" placeholder="What artist has influenced" value="<?php echo $artistic_influence ?>" required></div>
                                            <div class="form-group"> <label>Bio</label><textarea id="text-area" class="form-control" rows="4" cols="50" maxlength="125" name="bio" placeholder="Short bio" required><?php echo $bio ?></textarea></div>
                                            <div><span id="chars">100</span> characters remaining</div>
                                        </div>
                                        <button class="btn-save" type="submit" name="submit_data">Save Changes</button>
                                    </div><!-- END OF USER-INPUT-ROW -->
                                </div><!-- END OF USER-INPUT-CONTAINER -->
                        </form> <!-- END OF FORM-DATA -->


                        <!-- VALIDATE PASSWORD -->


                        <form class="form-pw" name="frmChange" method="post" action="" onsubmit="return validatePassword()">
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
                                </div><!-- END OF USER-INPUT-COL -->
                                <button class="btn-save" type="submit" name="submit_pw">Save Password</button>
                            </div><!-- END OF USER-PW-CONTAINER -->
                        </form><!-- END OF FORM_PW -->

                    </div><!-- END OF FORMS -->
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

        let maxLength = 125;
        var el;

        function countCharacters(e) {
            var textEntered, countRemaining, counter;
            textEntered = document.getElementById('text-area').value;
            counter = (maxLength - (textEntered.length));
            countRemaining = document.getElementById('chars');
            countRemaining.textContent = counter;
        }
        el = document.getElementById('text-area');
        el.addEventListener('keyup', countCharacters, false);

        countCharacters();
    </script>

</body>

</html>