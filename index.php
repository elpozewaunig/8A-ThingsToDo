<?php 

include 'modules/common/get_config.php';

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title> <?= title ?> - <?= subtitle ?> </title>

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
include 'modules/common/versionify.php';

echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/login.css')."\">";
?>

</head>

<body>

  <div class="login">
    <div class="headerbar">
      <div class="logo_container"><img src="<?= logo ?>" class="logo"></div>
      <h1> <?= title ?> </h1>
      <h2> <?= subtitle ?> </h2>
    </div>
  
<form action="login.php" method="post">
  
  <?php
  
  if(isset($_SESSION['login_successful'])) {
    if ($_SESSION['login_successful'] == false) {
      echo "<input class=\"wrong-input\" type=\"password\" name=\"password\" placeholder=\"Enter password here\"><br>";
      echo "<div class=\"alert\"> Password is incorrect. Try again </div><br>";
    }
  }
  else {
    echo "<input type=\"password\" name=\"password\" placeholder=\"Enter password here\"><br>";
  }
      
  ?>
      
      <input type="submit" value="Log in">
    </form>
    
  </div>

</body>
</html>