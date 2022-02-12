<?php 

include "modules/common/get_config.php";

session_start();

if(isset($_POST['password'])) {
  
  $password=$_POST['password'];
  if(file_exists('password.txt')) {
    $key=file_get_contents('password.txt');
  }
  else {
    $key="";
  }

  if ($password == $key) {
    
    if (isset($_SESSION['origin'])) {
      header("Location: ".$_SESSION['origin']);
    }
    else {
      header("Location: ".main_page);
    }
    
    $_SESSION['login_successful'] = true;
  }
  else {
    header("Location: index.php");
    $_SESSION['login_successful'] = false;
    $_SESSION['return_to_login'] = true; // tells login screen this is no refresh
  }
  
}

else {
  header("Location: index.php");
  $_SESSION['login_successful'] = false;
  $_SESSION['return_to_login'] = false;
}

exit();

?>