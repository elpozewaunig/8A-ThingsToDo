<?php

include 'modules/userlist_build.php';
include 'modules/get_ids.php';

$user_array = get_users();
$id_array = get_work_ids(); 

if ( isset($_POST['progress']) && empty(array_diff($_POST['progress'], $id_array)) ) { // checks if only valid work IDs are being saved
  if ( isset($_COOKIE['user']) && in_array($_COOKIE['user'], $user_array) ) { // checks if user is valid

    $progress = $_POST['progress'];
    $user = $_COOKIE['user'];
    
    $handle = fopen("data/progress/$user", "w");
    fwrite($handle, implode(',', $progress));
      
  }
}

header("Location: main.php");
exit();

 ?>