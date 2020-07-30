<?php

// includes
include 'includes/readGuestData.php';
include 'includes/timestamp.php';
include 'includes/writeGuestData.php';
include 'includes/writeGuestImg.php';

// folders
$folder_guestImgs = 'guestImgs';
$folder_guestEntries = 'guestEntries';


// validation
if (!empty($_POST)) {

  // data from POST
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // store date and time
  $date .= date('n/d/Y');
  $time = date('g:i a');


  // check if guest uploaded img
  if ($_FILES['guestImg'] && $_FILES['guestImg']['size'] > 0) {

    // store img
    $guestImgUpload = $_FILES['guestImg'];

    // save img
    $guestImg = writeGuestImg($folder_guestImgs, $guestImgUpload);
  } else {
    // no img uploaded - set empty string
    $guestImg = '';
  }

  // strip spaces
  $guestImg = str_replace(' ', '', $guestImg);
  // write data
  writeGuestData($folder_guestEntries, $name, $email, $date, $time, $message, $guestImg);
}

//get entries data
$entries = readGuestData('guestEntries');

?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/header.css">
  <title>ITGM727 - Exercise 2: Guestbook</title>
</head>

<body>
  <!-- NAV-->
  <?php $nav_btn = 'WRITE IN THE GUESTBOOK';
  // set var used in header nav
  $nav_link = 'signbook.php';
  include 'includes/header.php'; ?>

  <div class="container">


    <div class="welcome-container">
      <div class="welcome-message-container">
        <p class="welcome-message"><strong>Welcome to my Guestbook!</strong>
          <?php
          // update string based on if first guest or not
          if (empty($entries)) {
            echo "Thanks for stopping by, be the first to sign the book.";
          } else {
            echo "Thanks for stopping by, please sign the guest book.";
          }
          ?>
        </p>
      </div><!-- END WELCOME-MESSAGE-CONTAINER-->
    </div><!-- END WELCOME-CONTAINER-->

    <!-- setup and create each entry -->
    <?php foreach ($entries as $entry) : ?>

      <?php
      if (isset($entry[5])) {

        // store img
        $guestImg = $entry[5];
        //set empty initials
        $initials = '';
      } else {

        // if no img then set initials
        $guestImg = '';

        // get guest initials
        preg_match_all("/[A-Z]/", ucwords(strtolower($entry[0])), $matches);
        // convert string
        $initials = implode("", $matches[0]);
      }

      //capitalize first letter of each word in name
      $entry[0] = ucwords($entry[0]);

      //store var to be used in guestImg style below
      $img = "'background-image:url(" . $guestImg . ")'";
      ?>

      <!-- ENTRY -->
      <div class='entry-container'>
        <div class='entry-col'>
          <div class='entry'>
            <div class='data-container'>
              <div class='data-row'>
                <div class='img-container'>
                  <div class='guestImg' style=<?php echo $img ?>><?php echo $initials ?>
                  </div>
                </div><!-- END IMG-CONTAINER-->
                <div class='container-message'>
                  <div class='name-date'>
                    <div class='name'>
                      <a><?php echo $entry[0] ?></a>
                    </div>
                    <div class="date-time">
                      <div class='date'><?php echo $entry[2] ?></div>
                      <div class='time'><?php echo $entry[3] ?></div>
                    </div>
                  </div><!-- END NAME/DATE-->
                  <div class='message'>
                    <?php echo $entry[4] ?>
                  </div>
                </div><!-- END CONTAINER-MESSAGE -->
              </div><!-- END DATA-ROW -->
            </div><!-- END DATA-CONTAINER -->
          </div><!-- END ENTRY -->
        </div><!-- END ENTRY-COL -->
      </div><!-- END ENTRY-CONTAINER -->
    <?php endforeach ?>

  </div> <!-- END CONTAINER -->
</body>

</html>