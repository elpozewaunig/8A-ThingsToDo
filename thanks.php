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

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/subjects.css')."\">";

echo "<link rel=\"stylesheet\" media=\"print\" href=\"".versionify('stylesheets/print.css')."\">";
?>
  
<style>

h1 {
  display: block;
  margin-top: 50px;
  background-color: #ff9100;
  color: #ffffff;
  padding: 10px;
  border-radius: 5px;
}

h1 img {
  padding-left: 10px;
  padding-right: 10px;
}

div.content-block {
  color: #4a4a4a;
  padding-left: 10px;
}

ul {
  color: #ff5400;
}

li {
  padding: 10px;
}

div.name {
  color: #ffffff;
  background-color: #ff5400;
  padding: 5px;
  border-radius: 5px;
  font-weight: bold;
  display: inline-block;
}

div.description {
  color: #4a4a4a;
}

span.subject {
  font-size: 12px;
  padding: 3px;
}

/* Dark theme */

@media (prefers-color-scheme: dark) {
  
  div.content-block {
    color: #ffffff;
  }
  
  div.description {
    color: #ffffff;
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
      <div class="description"> who provided the student dataset, beta-tested my first version, curated <span class="subject L">L</span> and made feature requests to make this website what it is now </div>
    </li>
    <li>
      <div class="name"> David P </div>
      <div class="description"> who provided the first assignment dataset </div>
    </li>
    <li>
      <div class="name"> Teresa </div>
      <div class="description"> Curator of <span class="subject L">L</span> and <span class="subject BSPM">BSPM</span> who also kept me motivated all along </div>
    </li>
    <li>
      <div class="name"> Felix </div>
      <div class="description"> Curator of <span class="subject INFG-KAM">INFG-KAM</span> and <span class="subject INFW-MI">INFW-MI</span> and trusty beta-tester </div>
    </li>
    <li>
      <div class="name"> Renick </div>
      <div class="description"> Curator of <span class="subject INFG-KAM">INFG-KAM</span> </div>
    </li>
    <li>
      <div class="name"> Mathias </div>
      <div class="description"> Initial beta-tester </div>
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