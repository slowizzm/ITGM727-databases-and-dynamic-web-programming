<?php
$server = 'localhost';
$user = 'slow_izzm';
$password = 'd33';
$db = 'student_gallery';

//create connection
$conn = mysqli_connect($server,$user,$password,$db);

//check connection
if (!$conn) {
    die('connection failed').mysqli_connect_error();
}

?>