<?php

function conferences_build($input, $user) {
  
  include 'get_subjects.php';
  include 'constants.php'; // contains array of all subjects
  
  echo "<table class=\"data-table\" id=\"conferences\">";
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $subjects = get_subjects($user_subjects); // resolves groups to individual subjects
  }
  else {
    $subjects = SUBJECTS; // subjects as defined in constants.php
  }
  
  echo "<thead class=\"column-titles\"><tr>";
  
  echo "<th id=\"th-subjects\"> Subject </th><th> Description </th><th> Link </th><th> Date </th>";
  echo "</tr></thead>";
  echo "<tbody>";
  
  $table = "";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      $table = $table.build_cells($l, $subjects);
    }
  }
  if($table != "") {
    echo $table;
  }
  else {
    echo "<tr><td colspan=\"4\"> No upcoming conferences. Time to have some fun! </td></tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  
}


function build_cells($line, $subjects) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
      $output = "<tr>";
    
      for ($i = 0; $i < count($cell_array); $i++) { // cycles through every element of one line
      
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ". trim($cell_array[$i])."\">".trim($cell_array[$i])."</span> </td>"; 
        }
        elseif ($i == 2) { // resource generation
          $output = $output."<td>".prettify_resource( trim($cell_array[$i]) )."</td>";  
        }
        elseif ($i == 3) { // weekday generation
          $output = $output."<td class=\"date\">".prettify_date($cell_array[$i])."</td>";  
        }
        elseif ($i == 4) {
          // Ignore
        }
        else {
            $output = $output."<td>".trim($cell_array[$i])."</td>"; 
        }  
        
      }
      
      $output = $output."</tr>";
      
  }
  
  return $output;
}

function prettify_resource($resource) {
  
  if (filter_var($resource, FILTER_VALIDATE_URL)) { // check if resource is URL
    
    if (begins_with(trim($resource), "https://moodle.it-gymnasium.at/mod/bigbluebuttonbn/")) {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\" class=\"link-button bigbluebutton\"><img src=\"images/bigbluebutton.png\" height=\"16px\"> Open in BigBlueButton </a>";
    }
    elseif (begins_with(trim($resource), "https://discordapp.com/channels/")) {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\" class=\"link-button discord\"><img src=\"images/discord.svg\" height=\"16px\"> Open in Discord </a>";
    }
    else {
      $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\">".htmlspecialchars($resource)."</a>";
    }
  }
  elseif (trim($resource) == "") {
    $prettified_resource = "<span class=\"unavailable\"> No link available yet";
  }
  else {
    $prettified_resource = $resource;
  }
  
  return $prettified_resource;
}

function prettify_date($date) {
  $timestamp = date_timestamp_get( date_create_from_format("d.m.Y, H:i", trim($date)) );
  $prettified_date = date("D, d.m.Y, H:i", $timestamp);
  
  return $prettified_date;
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