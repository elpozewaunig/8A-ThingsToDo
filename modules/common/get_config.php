<?php

$config = file("config.txt");

foreach($config as $l) {
  if($l !== PHP_EOL) {
    $separator_pos = strpos($l, ":");
    
    $key = substr($l, 0, $separator_pos);
    $value = trim(substr($l, $separator_pos+1));
    
    define($key, $value); // Defines constant with key name
  }
}

?>