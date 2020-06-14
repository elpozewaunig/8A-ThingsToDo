<?php

function generate_topbar() {

echo <<<TOPBAR

<div class="topbar">
  <topitem class="header"><img src="/images/school.svg" style="height: 24px; vertical-align: baseline;"> 6A </topitem>
  <topitem class="label"><span>Things To Do</span></topitem>
  
TOPBAR;  

if ($_SESSION['origin'] == "/main.php") {
  echo '<topitem class="page current"><a href="/main.php"> <img src="/images/edit.svg"> Work </a></topitem>';
}
else {
  echo '<topitem class="page"><a href="/main.php"> <img src="/images/edit.svg"> Work </a></topitem>';
}

if ($_SESSION['origin'] == "/conferences.php") {
  echo '<topitem class="page current"><a href="/conferences.php"> <img src="/images/video.svg"> Conferences </a></topitem>';
}
else {
  echo '<topitem class="page"><a href="/conferences.php"> <img src="/images/video.svg"> Conferences </a></topitem>';
}  
  
echo <<<TOPBAR
  
  <topitem class="user-dropdown">
    
    <form method="post" action="set_user.php">
      <div><img src="/images/user-circle.svg" style="height: 24px; vertical-align: middle;">
      <select name="user" title="Select user" onchange="this.form.submit()">
        <option value="all"> Students </option>
        
TOPBAR;

include 'userlist_build.php';        
echo build_userdropdown();

echo <<<TOPBAR

      </select></div>
      <noscript> <input type="submit" value="✓" title="Submit"> </noscript>
    </form>
  </topitem>
</div>

TOPBAR;

}

?>
