<?php

//init empty variables
$email = $username = $semester = $course_id = $section = $p5_url = '';
//error list
$errs = array('email' => '', 'username' => '', 'semester' => '', 'course_id' => '', 'section' => '', 'p5_url' => '');

//validation
if (isset($_POST['submit'])) {

    //validate email
    if (empty($_POST['email'])) {
        $errs['email'] = 'req email';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errs['email'] = 'must use valid email address';
        }
    }

    //validate username
    if (empty(trim($_POST['username']))) {
        $errs['username'] = 'req username';
    } else {
        $username = $_POST['username'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $username)) {
            $errs['username'] = 'must use letters and spaces only';
        }
    }

    //validate semester
    if (empty($_POST['semester'])) {
        $errs['semester'] = 'req semester';
    } else {
        $semester = $_POST['semester'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $semester)) {
            $errs['semester'] = 'must use letters and no spaces';
        }
    }

    //validate course id
    if (empty($_POST['course_id'])) {
        $errs['course_id'] = 'req course_id';
    } else {
        $course_id = $_POST['course_id'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $course_id)) {
            $errs['course_id'] = 'must use letters and no spaces';
        }
    }

    //validate course id
    if (empty($_POST['section'])) {
        $errs['section'] = 'req section';
    } else {
        $section = $_POST['section'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $section)) {
            $errs['section'] = 'must use numbers only';
        }
    }

    //validate p5_url
    if (empty($_POST['p5_url'])) {
        $errs['p5_url'] = 'req p5_url';
    } else {
        $p5_url = $_POST['p5_url'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $p5_url)) {
            $errs['p5_url'] = 'url to your p5.js sketches';
        }
    }
} // end of validation

//check errs and redirect user
if (array_filter($errs)) {
} else {
    // header('Location: results.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'temp/header.php'; ?>
<section class="container grey-text">
    <h4 class="center">Add Student</h4>
    <form action="" class="white" action="add.php" method="POST">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errs['email']; ?></div>
        <label>Username</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($username) ?>">
        <div class=" red-text"><?php echo $errs['username']; ?></div>
        <label>Semester</label>
        <input type="text" name="attributes" value="<?php echo htmlspecialchars($semester) ?>">
        <div class=" red-text"><?php echo $errs['semester']; ?></div>
        <label>Course ID</label>
        <input type="text" name="attributes" value="<?php echo htmlspecialchars($course_id) ?>">
        <div class=" red-text"><?php echo $errs['course_id']; ?></div>
        <label>Section</label>
        <input type="text" name="attributes" value="<?php echo htmlspecialchars($section) ?>">
        <div class=" red-text"><?php echo $errs['section']; ?></div>
        <label>P5.js Web Editor URL (Sketches)</label>
        <input type="text" name="attributes" value="<?php echo htmlspecialchars($p5_url) ?>">
        <div class=" red-text"><?php echo $errs['p5_url']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
</body>

</html>