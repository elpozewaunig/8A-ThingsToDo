<?php

function get_work_ids() { // returns an array with all IDs of assignments
  $work = file('data/work/work.txt');
  
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