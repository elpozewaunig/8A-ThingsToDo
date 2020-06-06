<?php

function versionify($path) {
  
  $checkable_path = trim($path, '/'); // necessary to trim slash, since PHP will always route from document root

  if(file_exists($checkable_path)) {
    return $path."?version=".filemtime($checkable_path);
  }
  else {
    return false;
  }

}

?>