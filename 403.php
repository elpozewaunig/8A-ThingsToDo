<?php
include 'check_login.php';
check_login();
?>

<!DOCTYPE html>
<html>
<head>
  <title>403 - Forbidden</title>
  <meta charset="utf-8">
  
  <link rel="icon" href="/icon.svg">
  <link rel="apple-touch-icon" href="/touch-icon.png">
  
  <?php
  include 'versionify.php';
  
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
include './topbar.php';
generate_topbar();
?>  

<br>

<div class="content">    
  <h1>403 - Forbidden</h1>
  <h2>There's still a chonky boi stuck here.</h2>
  <img class="picture" src="/images/chonky-boi.jpg">
</div>

<?php 
include 'bottombar.php';
 ?>
</body>
</html>