<?php

function getTimestamp() {

  $currentTime = time();
  $time = explode(" ", $currentTime);
  $newTimestamp = (float)$time[1] + (float)$time[0];

  return $newTimestamp;
}
