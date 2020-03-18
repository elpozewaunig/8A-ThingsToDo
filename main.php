<!DOCTYPE html>
<html>

<head>
<title>6A - Things To Do</title>
<meta charset="utf-8">
<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">


<link rel="stylesheet" href="stylesheets/common.css">
<link rel="stylesheet" href="stylesheets/table.css">
<link rel="stylesheet" href="stylesheets/subjects.css">
  
</head>

<body>
  <div class="topbar">
    <topitem class="header"><img src="images/school.svg" style="height: 24px; vertical-align: baseline;"> 6A </topitem>
    <topitem class="label"><span>Things To Do</span></topitem>
    
    <topitem class="user-dropdown">
      
      <form method="post" action="set_user.php">
        <span><img src="images/user-circle.svg" style="height: 24px; vertical-align: middle;">
        <select name="user">
          <option value="all"> Students </option>
          
          <?php 
            include 'userlist_build.php';
            
            echo build_userdropdown();
           ?>
           
        </select></span>
        <input type="submit" value="✓"></input>
      </form>
    </topitem>
  </div>
  <br>
  
  <?php 
  session_start();
  
  include 'table_build.php';
  include 'get_subjects.php';
  
  if (isset($_SESSION['login_successful']) || $_SESSION['login_successful']) {
    
      $work = file('data/work/work.txt');
      
      $user = $_COOKIE["user"];
      
      if ($user !== "all") {
        $user_subjects = explode(', ', file_get_contents("data/users/$user"));
        $subjects = get_subjects($user_subjects);
      }
      else {
        $subjects = ["M", "D", "E", "GSPB", "GWK", "BIUK", "PH", "ME", "PHL", "BE", "L", "IT", "CAE", "SPA", "REK", "REE", "BSPK", "BSPM", "INFG-SR", "INFG-KAM", "INFW-ROH", "INFW-MI", "PUP", "WPF-ME", "WPF-GSPB", "WPF-BIUK", "WPF-SPK"];
      }
      
      table_build($work, $subjects);
    }
    
    
  else {
    header("Location: index.php");
  }
   ?>
  
</body>
</html>