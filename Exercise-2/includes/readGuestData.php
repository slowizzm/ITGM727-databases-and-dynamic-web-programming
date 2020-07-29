<?php

function readGuestData($dir)
{

  // store entries
  $entries = array();

  if (is_dir($dir)) {
    $entryFiles = scandir($dir);
    foreach ($entryFiles as $fileName) {

      // exclude hiddens
      if (($fileName != ".") && ($fileName != "..") && ($fileName != ".DS_Store")) {

        // get data
        $entry = file($dir . "/" . $fileName);

        // store data in arr
        $entries[] = $entry;
      }
    }
  }

  return $entries;
}
