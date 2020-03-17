<?php 

$user = $_POST['user'];
setcookie("user", $user);

header("Location: main.php");
exit();
 ?>