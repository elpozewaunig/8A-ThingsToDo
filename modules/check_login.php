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
?>