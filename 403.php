<?php
include './modules/common/master_include.php';
check_login();
check_user();
?>

<!DOCTYPE html>
<html>
<head>
  <title>403 - Forbidden</title>
  <meta charset="utf-8">
  
  <link rel="icon" href="/images/icons/icon.svg">
  <link rel="apple-touch-icon" href="/images/icons/touch-icon.png">
  
  <?php
  echo "<link rel=\"stylesheet\" href=\"".versionify('/stylesheets/common.css')."\">";
  ?>

  <style>
    body {
      color: #ffffff;
    }
    
    h1 {
      margin: 20px;
      margin-top: 40px;
      
      text-align: center;
      font-size: 10vmin;
      margin-bottom: 0px;
    }
    
    h2 {
      margin: 20px;
      
      text-align: center;
      font-size: 5vmin;
    }
    
    img.picture {
      display: block;
      margin-left: auto;
      margin-right: auto;
      
      height: 50vmin;
    }
    </style>
</head>

<body>

<?php
generate_topbar();
?>  

<br>

<div class="content">    
  <h1>403 - Forbidden</h1>
  <h2>There's still a chonky boi stuck here.</h2>
  <img class="picture" src="/images/chonky-boi.jpg" alt="Fat racoon">
</div>

<?php 
include './modules/bottombar.php';
 ?>
</body>
</html>