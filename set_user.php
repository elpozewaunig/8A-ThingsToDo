<?php
session_start(); 

include 'modules/userlist_build.php';

$user_array = get_users();

if(isset($_POST['user'])) {
  if(in_array($_POST['user'], $user_array)) { // checks if user is valid
    $user = $_POST['user'];
  }
  else {
    $user = "all";
  }
  setcookie("user", $user);
}

if (isset($_SESSION['origin'])) {
  header("Location: ".$_SESSION['origin']);
}
else {
  header("Location: main.php");
}

exit();
 ?>