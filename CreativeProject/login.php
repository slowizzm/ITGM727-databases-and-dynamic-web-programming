<?php

include 'includes/conn.php';
include 'includes/query_users.php';

session_destroy();

    // echo "<script> alert('username and password do not match');</script>";
    header('location: index.php');
?>
