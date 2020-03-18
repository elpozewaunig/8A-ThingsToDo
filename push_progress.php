<?php 

if (isset($_POST['progress'])) {

  $progress = $_POST['progress'];
  $user = $_COOKIE['user'];

  $handle = fopen("data/progress/$user", "w");
  fwrite($handle, implode(',', $progress));
}

header("Location: main.php");
exit();

 ?>