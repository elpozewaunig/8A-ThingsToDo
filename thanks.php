<?php
include 'modules/common/master_include.php';
check_login();
check_user();
?>

<!DOCTYPE html>
<html>

<head>
<title> <?= title ?> - Thank you </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/mobile.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/subjects.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/page.css')."\">";

echo "<link rel=\"stylesheet\" media=\"print\" href=\"".versionify('stylesheets/print.css')."\">";
?>
  
<style>

span.subject {
  font-size: 12px;
  padding: 3px;
}
  
}

</style>
  
</head>

<body>
  
  <?php
  generate_topbar();
  ?>
  
  <br>

<div class="content">
  
<h1> <img src="images/fa/heart.svg" height="26px"> Thank you </h1> 
  
<div class="content-block">
  <b>This website would not be possible, if it wasn't for some amazing people. You guys rock!</b>
  
  <ul>
    <li>
      <div class="name"> Florian </div>
      <div class="description"> who provided the student dataset, curated <span class="subject L">L</span> and <span class="subject REE">REE</span>, beta-tested my first version and made feature requests to make this website what it is now </div>
    </li>
    <li>
      <div class="name"> Felix </div>
      <div class="description"> Trusty beta-tester and feature requester, reporter of missing assignments, curator of <span class="subject WPF-SPA">WPF-SPA</span> </div>
    </li>
    <li>
      <div class="name"> Teresa </div>
      <div class="description"> Yoga guru and curator of <span class="subject L">L</span> and <span class="subject BSPM">BSPM</span> </div>
    </li>
    <li>
      <div class="name"> Max </div>
      <div class="description"> Beta-tester of new features </div>
    </li>
    <li>
      <div class="name"> Mathias </div>
      <div class="description"> Initial beta-tester, reporter of missing assingments </div>
    </li>
    <li>
      <div class="name"> Alex </div><div class="name"> Lauren </div><div class="name"> Maxi </div><div class="name"> Renick </div>
      <div class="description"> who notified me of a few missing assignments </div>
    </li>
  </ul>
  
  <b>And also thanks for everyone who has supported and used the website. You have encouraged me a lot!</b>
</div>
 
</div> 

<?php 
include 'modules/bottombar.php';
 ?>

</body>
</html>