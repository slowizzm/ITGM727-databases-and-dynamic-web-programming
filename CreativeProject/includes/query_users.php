<?php

$username=$_POST['username'];
$password=$_POST['password'];
$query = "SELECT *FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_array($result);

?>