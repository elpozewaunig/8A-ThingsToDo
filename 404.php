<?php
session_start();

$_SESSION['origin'] = "404.php";

if (isset($_SESSION['login_successful']) && $_SESSION['login_successful']) {
}
else{
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>404 - Page not found</title>
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
      text-align: center;
      font-size: 5vmin;
    }
    
    img.picture {
      margin: 20px;      
      
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
    
  <h1>404 - File not found</h1>
  <h2>But at least Helofish found you.</h2>
  <img class="picture" src="/images/helo-fish.jpg">
</body>
</html>