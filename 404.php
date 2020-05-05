<?php
session_start();
if (isset($_SESSION['login_successful']) || $_SESSION['login_successful']) {
}
else{
  header("Location: index.php");
  exit();
}

$_SESSION['origin'] = "404.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>404 - Page not found</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/stylesheets/common.css">
  
  <style>
    body {
      color: #ffffff;
    }
    
    h1 {
      text-align: center;
      font-size: 10vh;
      margin-bottom: 0px;
    }
    
    h2 {
      text-align: center;
      font-size: 5vh;
    }
    
    img.picture {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    </style>
</head>

<body>

<?php
include './topbar.php';
generate_topbar();
?>  

<br>
    
  <h1>404 - File not found.</h1>
  <h2>But at least Helofish found you.</h2>
  <img class="picture" align="center" height="35%" src="/images/helo-fish.jpg">
</body>
</html>