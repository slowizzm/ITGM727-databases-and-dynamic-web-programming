<?php
session_start();
//connect to db
include 'includes/conn.php';
//query users
$query = 'SELECT id, email, username, major, artistic_influence, bio, img, p5_url FROM students ORDER BY created_at';

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
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- CONTAINER -->
    <div class="container">
        <h1 class="label"> MED290 FA20 Gallery</h1>
        <div class="cards-container">

            <?php foreach ($students as $student) : ?>
                <?php
                $user_name = htmlspecialchars($student['username']);
                $user_email = htmlspecialchars($student['email']);
                $major = htmlspecialchars($student['major']);
                $artistic_influence = htmlspecialchars($student['artistic_influence']);
                $bio = htmlspecialchars($student['bio']);
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
                    <div class="card-info">
                        <div class="card-section">
                            <div class="card-influence">Artistic Influence: <span> <?php echo $artistic_influence ?></span></div>
                            <div class="card-content">
                                <div class="card-subtitle">ABOUT</div>
                                <p class="card-desc"><?php echo $bio ?>
                                </p>
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