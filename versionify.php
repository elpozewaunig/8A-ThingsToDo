<?php

function versionify($path) {

  if(file_exists($path)) {
    return $path."?version=".filemtime($path);
  }
  else {
    return false;
  }

}

?>