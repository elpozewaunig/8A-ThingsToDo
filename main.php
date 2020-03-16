<!DOCTYPE html>
<html>

<head>
<title>6A- Things To Do</title>
<meta charset="utf-8">
<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">


<link rel="stylesheet" href="stylesheets/common.css">
<link rel="stylesheet" href="stylesheets/table.css">
  
</head>

<body>
  <?php 
  session_start();
  
  include 'table_build.php';
  
  if (isset($_SESSION['login_successful']) || $_SESSION['login_successful']) {
    
    
      $work = file('data/work/work.txt');
      
      table_build($work);
    }
    
    
  else {
    header("Location: index.php");
  }
   ?>
  
</body>
</html>