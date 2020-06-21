<?php

function check_login() {

  session_start();

  $_SESSION['origin'] = $_SERVER['PHP_SELF'];

  if (isset($_SESSION['login_successful']) && $_SESSION['login_successful']) {
  }
  else {
    header("Location: /index.php");
    exit();
  }

}

function check_user() {
  
  $user_array = get_users(); // this function must be included from userlist_build.php
  
  if ( !(isset($_COOKIE['user']) && in_array($_COOKIE['user'], $user_array)) ) { // checks if user is invalid
    $user = "all";
    setcookie("user", $user);
  }

}

?>