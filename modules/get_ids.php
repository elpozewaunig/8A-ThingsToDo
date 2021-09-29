<?php

function get_work_ids() { // returns an array with all IDs of assignments
  $path = 'data/work/work.txt';
  if(file_exists($path)) {
    $work = file($path);
  }
  else {
    $work = array();
  }
  
  $id_array = [];
  
  foreach($work as $l) {
    if($l !== PHP_EOL) {
      $line_array = explode('|', $l);
      $id_array[] = trim($line_array[1]);
    }
  }
  
  return $id_array;
}

?>