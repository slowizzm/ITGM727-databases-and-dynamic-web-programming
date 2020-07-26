<?php

include 'conn.php';
$username=$_POST['username'];
$password=$_POST['password'];
$query = "SELECT *FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_array($result);

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
