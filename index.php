<?php 
session_start();

if (isset($_SESSION['return_to_login']) && $_SESSION['return_to_login']) { // checks if the page was redirected by login.php
  unset($_SESSION['return_to_login']);
  $refresh = false;
}
else {
  $refresh = true;
}

if (isset($_SESSION['login_successful'])) {
  if ($_SESSION['login_successful']) {
    if (isset($_SESSION['origin'])) {
      header("Location: ".$_SESSION['origin']);
    }
    else {
      header("Location: main.php");
    }
    exit();
  }
  elseif ($_SESSION['login_successful'] == false) {
    if ($refresh) {
      unset($_SESSION['login_successful']); // delete information that the password was false
    }
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

<?php
include 'versionify.php';

echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/login.css')."\">";
?>

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
  
  <?php
  
  if(isset($_SESSION['login_successful'])) {
    if ($_SESSION['login_successful'] == false) {
      echo "<input class=\"wrong-input\" type=\"password\" name=\"password\"><br>";
      echo "<div class=\"alert\"> Password is incorrect. Try again </div><br>";
    }
  }
  else {
    echo "<input type=\"password\" name=\"password\"><br>";
  }
      
  ?>
      
      <input type="submit" value="Log in">
    </form>
    
  </div>

</body>
</html>