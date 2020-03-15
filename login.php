<?php 

$password=$_POST['password'];
$key=file_get_contents('password.txt');

if ($password == $key) {
    echo "Success";
    header("Location: http://www.example.com/another-page.php");
    exit();
  }
  else {
    echo "Wrong password";
  }

?>