<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/signbook.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Document</title>
</head>

<body>
    <?php $nav_btn = 'VIEW THE GUESTBOOK';
    // set var used in header nav
    $nav_link = 'index.php';
    include 'includes/header.php' ?>

    <!-- CONTAINER -->
    <div class="container">
        <div class="container-center">
            <div class="cols">
                <h3 class="text-sign-book">Write in the Guest Book</h3>

                <!--FORM -->
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label><span style="color: #C2004B">&nbsp *</span>
                        <input type="text" class="form-input" name="name" required placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="">Email address</label><span style="color: #C2004B">&nbsp *</span>
                        <input type="email" class="form-input" name="email" required placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label><span style="color: #C2004B">&nbsp *</span>
                        <textarea class="form-input" name="message" rows="3" required></textarea>
                    </div>

                    <div class="form-group file-upload">
                        <label class="file-upload-text" for="guestImg">Upload Photo</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                        <input type="file" accept=".png, .jpg, .jpeg" class="input-file" name="guestImg">
                    </div>

                    <button type="submit" name="submit" class="btn-submit">Submit</button>

                </form><!-- END FORM -->
            </div><!-- END COLS -->
        </div><!-- END CONTAINER-CENTER -->
    </div><!-- END CONTAINER -->
</body>

</html>