<?php

function check_login() {

  session_start();

  $_SESSION['origin'] = $_SERVER['PHP_SELF'];

  if (valid_login()) {
  }
  else {
    $_SESSION['login_successful'] = false;
    header("Location: /index.php");
    exit();
  }

}

function check_user() {
  
  if ( !(isset($_COOKIE['user'])) || !valid_user($_COOKIE['user']) )  { // checks if user is invalid
    $user = "all";
    setcookie("user", $user);
  }

}

function valid_user($username) {
  
  $user_array = get_users(); // this function must be included from userlist_build.php
  
  if(in_array($username, $user_array)) {
    return true;
  }
  else {
    return false;
  }
  
}

function valid_login() {
  
  if(isset($_SESSION['login_successful']) && $_SESSION['login_successful'] == true && isset($_SESSION['password_mtime']) && $_SESSION['password_mtime'] == filemtime("password.txt")) {
    return true;
  }
  else {
    return false;
  }
  
}

?>