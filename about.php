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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/mobile.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/page.css')."\">";

echo "<link rel=\"stylesheet\" media=\"print\" href=\"".versionify('stylesheets/print.css')."\">";
?>
  
<style>

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
  background-color: var(--label);
  vertical-align: middle;
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
  
<h1> <img src="images/fa/info.svg" height="26px"> About </h1> 
  
<div class="content-block">
  <p>This website was developed by Elias Pozewaunig to help students of class 8A manage their assignments. Several amazing people helped me accomplish this project - <a href="thanks.php">check them out</a>! <br>
  Just in case you are interested in the code - it is available under the <a href="https://github.com/elpozewaunig/8A-ThingsToDo/blob/master/LICENSE" target="_blank">MIT license</a> on <a href="https://github.com/elpozewaunig/8A-ThingsToDo" target="_blank">GitHub</a>.</p>
  
  <h2>Contact</h2>
    <div class="contact"> Elias Pozewaunig </div>
    <div class="contact-line"> <img src="images/fa/envelope.svg" height="12px"> <a href="mailto:elias.pozewaunig@it-gymnasium.at" target="_blank">elias.pozewaunig@it-gymnasium.at</a> </div>
    <div class="contact-line"> <img src="images/fa/github.svg" height="12px"> <a href="https://github.com/elpozewaunig" target="_blank">elpozewaunig</a> </div>
  
  <h2>Open Source Licenses</h2>
  <ul>
    <li>
      <div class="name"> TableFilter </div>
      <div class="description"> <a href="https://github.com/koalyptus/TableFilter" target="_blank">TableFilter</a> is the JavaScript library that is used for making tables sortable and filterable. It is licensed under the <a href="https://github.com/koalyptus/TableFilter/blob/master/LICENSE" target="_blank">MIT license</a>. </div>
    </li>
    <li>
      <div class="name"> FullCalendar </div>
      <div class="description"> <a href="https://fullcalendar.io" target="_blank">FullCalendar</a> is the JavaScript library that is responsible for rendering a beautiful calender on the frontend. It is licensed under the <a href="https://github.com/fullcalendar/fullcalendar/blob/master/LICENSE.txt" target="_blank">MIT License</a>. </div>
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