<?php

include 'includes/conn.php';
include 'includes/query_users.php';

print_r($row);

if($row>1){
    if($row[3] == 0) {
        header('location: admin.php');
        // echo 'isAdmin';
    } else {
        header('location: gallery.php');
        // echo 'isUser';
    }

} else {
    // echo "<script> alert('username and password do not match');</script>";
    header('location: index.php');
}
?>
