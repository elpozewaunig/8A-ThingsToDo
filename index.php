<?php 
session_start();

if (isset($_SESSION['login_successful'])) {
  if ($_SESSION['login_successful']) {
    header("Location: main.php");
    exit();
  }
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  
<title>6A - Things To Do</title>
<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">

<link rel="stylesheet" href="stylesheets/common.css">
<link rel="stylesheet" type="text/css" href="stylesheets/login.css">

</head>

<body>

  <div class="login">
    <div class="headerbar">
      <img src="images/triangle.svg" style="height: 15vw; position: absolute; left: 0; top: 0;">
    <h1><img src="images/school.svg" style="height: 8vw; vertical-align: baseline;"> 6A</h1>
    <h2>Things To Do</h2>
  </div>
  <h3>Login here first</h3>
  
<form action="login.php" method="post">
      <input type="password" name="password"><br>
      <input type="submit" value="Log in">
    </form>
    
  </div>

</body>
</html>