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


echo new_topbar_link("Work", "/images/fa/edit.svg", "/main.php");
echo new_topbar_link("Conferences", "/images/fa/video.svg", "/conferences.php");


echo <<<TOPBAR
  
  <topitem class="user-dropdown">
    
    <form method="post" action="set_user.php">
      <input type="hidden" name="origin" value="
TOPBAR;

echo $_SERVER['PHP_SELF'];

echo <<<TOPBAR
      ">
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

function new_topbar_link($title, $img, $href) {
  if ($_SESSION['origin'] == $href) {
    $current_class = " current";
  }
  else {
    $current_class = "";
  }
  echo '<topitem class="page'.$current_class.'"><a href="'.$href.'"> <img src="'.$img.'"> <span> '.$title.' </span> </a></topitem>';
}

?>
