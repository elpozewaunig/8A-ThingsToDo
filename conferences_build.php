<?php

function conferences_build($input, $user) {
  
  include 'get_subjects.php';
  
  echo "<table id=\"conferences\">";
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $subjects = get_subjects($user_subjects); // neccessary to resolve groups
  }
  else {
    $subjects = ["KV", "M", "D", "E", "GSPB", "GWK", "BIUK", "PH", "ME", "PHL", "BE", "L", "IT", "CAE", "SPA", "REK", "REE", "BSPK", "BSPM", "INFG-SR", "INFG-KAM", "INFW-ROH", "INFW-MI", "PUP", "WPF-ME", "WPF-GSPB", "WPF-BIUK", "WPF-SPK"];
  }
  
  echo "<thead><tr>";
  
  echo "<th id=\"th-subjects\"> Subject </th><th> Description </th><th> Link </th><th> Date </th>";
  echo "</tr></thead>";
  echo "<tbody>";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo build_cells($l, $subjects);
    }
  }
  
  echo "</tbody>";
  echo "</table>";
  
}


function build_cells($line, $subjects) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
    if (!date_over($cell_array[3])) {
      $output = "<tr>";
    
      for ($i = 0; $i < count($cell_array); $i++) { // cycles through every element of one line
      
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ". trim($cell_array[$i])."\">".$cell_array[$i]."</span> </td>"; 
        }
        elseif ($i == 2) { // resource generation
          $output = $output."<td>".prettify_resource($cell_array[$i])."</td>";  
        }
        else {
            $output = $output."<td>".$cell_array[$i]."</td>"; 
        }  
        
      }
    }
  }
    
  $output = $output."</tr>";
  
  return $output;
}

function date_over($date) {
  
  $date_time = date_create_from_format("d.m.Y, H:i", trim($date));
  
  if(strtotime("tomorrow") - date_timestamp_get($date_time) > 24*60*60) {
    return true;
  }
  else {
    return false;
  }
  
}

function prettify_resource($resource) {
  
  if (preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', $resource)) { // check if resource is URL
    
    if (begins_with(trim($resource), "https://moodle.it-gymnasium.at/mod/bigbluebuttonbn/")) {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\" class=\"link-button bigbluebutton\"><img src=\"images/bigbluebutton.png\" height=\"16px\"> Open in BigBlueButton </a>";
    }
    elseif (begins_with(trim($resource), "https://discordapp.com/channels/")) {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\" class=\"link-button discord\"><img src=\"images/discord.svg\" height=\"16px\"> Open in Discord </a>";
    }
    else {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\">".$resource."</a>";
    }
  }
  else {
    $prettified_resource = $resource;
  }
  
  return $prettified_resource;
}


function begins_with($haystack, $needle) {
  $length = strlen($needle);
  
  if (substr($haystack, 0, $length) == $needle) {
    return true;
  }
  else {
    return false;
  }
}

?>