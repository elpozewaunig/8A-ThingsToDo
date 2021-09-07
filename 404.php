<?php
include './modules/common/master_include.php';
check_login();
check_user();
?>

<!DOCTYPE html>
<html>
<head>
  <title>404 - Page not found</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="icon" href="<?= icon ?>">
  <link rel="apple-touch-icon" href="<?= touch_icon ?>">
  
  <?php
  echo "<link rel=\"stylesheet\" href=\"".versionify('/stylesheets/common.css')."\">";
  echo "<link rel=\"stylesheet\" href=\"".versionify('/stylesheets/mobile.css')."\">";
  echo "<link rel=\"stylesheet\" href=\"".versionify('/stylesheets/error.css')."\">";
  ?>
</head>

<body>

<?php
generate_topbar();
?>  

<br>

<div class="content">
  <h1>404 - File not found</h1>
  <h2>But at least Helofish found you.</h2>
  <img class="picture" src="/images/helo-fish.jpg" alt="Helofish">
</div>
  
  <?php 
  include './modules/bottombar.php';
   ?>
</body>
</html>