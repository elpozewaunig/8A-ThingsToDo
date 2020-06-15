<?php
session_start(); 

if(isset($_POST['user'])) {
  $user = $_POST['user'];
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