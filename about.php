<?php
include 'modules/common/master_include.php';
check_login();
check_user();
?>

<!DOCTYPE html>
<html>

<head>
<title> <?= title ?> - About </title>
<meta charset="utf-8">

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";

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

h2 {
  background-color: #ff9100;
  color: #ffffff;
  padding: 5px;
  border-radius: 5px;
}

div.content-block {
  color: #4a4a4a;
  padding-left: 10px;
}

div.contact {
  font-weight: bold;
  margin-bottom: 2px;
}

div.contact-line {
  padding: 2px;
}

div.contact-line img {
  padding: 5px;
  border-radius: 50%;
  background-color: #ff5400;
  vertical-align: middle;
}

a {
  color: #1e7c82;
}

a:hover {
  color: #135154;
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
  
<h1> <img src="images/info.svg" height="26px"> About </h1> 
  
<div class="content-block">
  <p>This website was developed by Elias Pozewaunig to help students of class 7A manage their assignments. Several amazing people helped me accomplish this project - <a href="thanks.php">check them out</a>! <br>
  Just in case you are interested in the code - it is available under the <a href="https://github.com/elpozewaunig/7A-ThingsToDo/blob/master/LICENSE" target="_blank">MIT license</a> on <a href="https://github.com/elpozewaunig/7A-ThingsToDo" target="_blank">GitHub</a>.</p>
  
  <h2>Contact</h2>
    <div class="contact"> Elias Pozewaunig </div>
    <div class="contact-line"> <img src="images/envelope.svg" height="12px"> <a href="mailto:elias.pozewaunig@it-gymnasium.at" target="_blank">elias.pozewaunig@it-gymnasium.at</a> </div>
    <div class="contact-line"> <img src="images/github.svg" height="12px"> <a href="https://github.com/elpozewaunig" target="_blank">elpozewaunig</a> </div>
  
  <h2>Open Source Licenses</h2>
  <ul>
    <li>
      <div class="name"> TableFilter </div>
      <div class="description"> <a href="https://github.com/koalyptus/TableFilter" target="_blank">TableFilter</a> is the JavaScript library that is used for making tables sortable and filterable. It is licensed under the <a href="https://github.com/koalyptus/TableFilter/blob/master/LICENSE" target="_blank">MIT license</a>.  </div>
    </li>
    <li>
      <div class="name"> FontAwesome </div>
      <div class="description"> <a href="https://fontawesome.com" target="_blank">FontAwesome</a> is the source of most of the amazing icons on this website. They are licensed under <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons BY 4.0 International</a>. </div>
    </li>
  </ul>

</div>
 
</div> 

<?php 
include 'modules/bottombar.php';
 ?>

</body>
</html>