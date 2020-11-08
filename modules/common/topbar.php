<?php

function generate_topbar() {

echo <<<TOPBAR
<div class="topbar">
  <topitem class="header"><img src="
TOPBAR;

echo logo;

echo <<<TOPBAR
" style="height: 24px; vertical-align: baseline;"> 
TOPBAR;

echo title;

echo <<<TOPBAR
 </topitem>
  <topitem class="label"><span>
TOPBAR;
  
  echo subtitle;
  
  echo <<<TOPBAR
</span></topitem>
TOPBAR;  

if ($_SESSION['origin'] == "/main.php") {
  $current_class = " current";
}
else {
  $current_class = "";
}
echo '<topitem class="page'.$current_class.'"><a href="/main.php"> <img src="/images/fa/edit.svg"> <span> Work </span> </a></topitem>';

if ($_SESSION['origin'] == "/conferences.php") {
  $current_class = " current";
}
else {
  $current_class = "";
}
echo '<topitem class="page'.$current_class.'"><a href="/conferences.php"> <img src="/images/fa/video.svg"> <span> Conferences </span> </a></topitem>';
  
echo <<<TOPBAR
  
  <topitem class="user-dropdown">
    
    <form method="post" action="set_user.php">
      <div><img src="/images/fa/user-circle.svg" style="height: 24px; vertical-align: middle;">
      <select name="user" title="Select user" onchange="this.form.submit()">
        <option value="all"> Students </option>
        
TOPBAR;
     
echo build_userdropdown(); // this function must be included from userlist_build.php

echo <<<TOPBAR

      </select></div>
      <noscript> <input type="submit" value="✓" title="Submit"> </noscript>
    </form>
  </topitem>
</div>

TOPBAR;

}

?>
