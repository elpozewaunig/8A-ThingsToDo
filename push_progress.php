<?php

include 'modules/common/userlist_build.php';
include 'modules/get_ids.php';

$user_array = get_users();
$id_array = get_work_ids(); 

if ( isset($_POST['progress']) && empty(array_diff($_POST['progress'], $id_array)) ) { // checks if only valid work IDs are being saved
  if ( isset($_POST['username']) && in_array($_POST['username'], $user_array) ) { // checks if user is valid
    
    $progress = $_POST['progress'];
    $user = $_POST['username'];
    
    $handle = fopen("data/progress/$user", "w");
    fwrite($handle, implode(',', $progress));
    
    setcookie("user", $user); // always return to user that the work has been saved for to avoid confusion
  }
}

header("Location: main.php");
exit();

 ?>