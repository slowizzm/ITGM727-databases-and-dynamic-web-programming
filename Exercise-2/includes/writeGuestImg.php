<?php

function writeGuestImg($dir, $img)
{
    // temp name
    $img_tmp = $img['tmp_name'];

    //add timestamp
    $img_name = getTimeStamp() . $img['name'];

    //strip whitespace from string
    $img_name = str_replace(' ', '', $img_name);

    // set img path
    $img = $dir . '/' . $img_name;

    // move to img path
    if (move_uploaded_file($img_tmp, $img) == FALSE) {
    } else {
        chmod($img, 0644);
    }

    return $img;
}
