<?php
session_start(); 

include 'modules/common/userlist_build.php';
include 'modules/common/check_login.php';

$user_array = get_users();

if(isset($_POST['user'])) {
  if(valid_user($_POST['user'])) { // checks if user is valid
    $user = $_POST['user'];
  }
  else {
    $user = "all";
  }
  setcookie("user", $user);
}

if (isset($_POST['origin'])) {
  header("Location: ".$_POST['origin']);
}
else {
  header("Location: main.php");
}

exit();
 ?>