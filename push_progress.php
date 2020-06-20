<?php

include 'modules/userlist_build.php';

$user_array = get_users(); 

if (isset($_POST['progress'])) {
  if (isset($_COOKIE['user']) && in_array($_COOKIE['user'], $user_array)) { // checks if user is valid
    $progress = $_POST['progress'];
    $user = $_COOKIE['user'];

    $handle = fopen("data/progress/$user", "w");
    fwrite($handle, implode(',', $progress));
  }
}

header("Location: main.php");
exit();

 ?>