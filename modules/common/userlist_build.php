<?php 

function get_users() { // creates array with usernames
  $user_names = array();
  $user_dir = "data/users";

  $user_names = scandir($user_dir);
  
  foreach ($user_names as $element) {
    if (!is_dir($user_dir."/".$element)) {
      $cleaned_user_names[] = $element;
    }
  }
  return $cleaned_user_names;
}

function build_userdropdown() {
  $users = get_users();
  $output = "";
  
  for ($i = 0; $i < count($users); $i++) {
    if (isset($_COOKIE["user"]) && $users[$i] == $_COOKIE["user"]) {
      $output = $output."<option selected value=\"$users[$i]\">".$users[$i]."</option>";
    }
    else {
      $output = $output."<option value=\"$users[$i]\">".$users[$i]."</option>"; 
    }
    
  }
    return $output;
}
 ?>