<?php

function writeGuestData($dir, $name, $email, $date, $time, $message, $img)
{

    // store guest info
    $guest_info = "";

    if (isset($_POST)) {

        // write name to file - return line
        if (!empty($name)) {
            $guest_info .= stripslashes($name) . "\n";
        }

        // write email to file - return line
        if (!empty($email)) {
            $guest_info .= stripslashes($email) . "\n";
        }

        // write date to file - return line
        if (!empty($date)) {
            $guest_info .= stripslashes($date) . "\n";
        }

        // write time to file - return line
        if (!empty($time)) {
            $guest_info .= stripslashes($time) . "\n";
        }

        // write message to file - return line
        if (!empty($message)) {
            $guest_info .= stripslashes($message) . "\n";
        }

        // store guest image - return line
        if (!empty($img)) {
            $guest_info .= stripslashes($img) . "\n";
        }

        //set timestamp for unique entry
        $timeStamp = getTimestamp();

        // save new entry
        $file_name = "$dir/date-signed-$timeStamp.txt";

        // write all data to file
        if (file_put_contents($file_name, $guest_info) > 0) {
        } else {
            // echo "err: could not save file";
        }
    }
}
