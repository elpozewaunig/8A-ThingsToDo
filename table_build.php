<?php

function table_build($input, $user) {
  
  include 'get_subjects.php';
  
  echo "<form action=\"push_progress.php\" method=\"post\">";
  echo "<table>";
  
  $include_progress = false;
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $include_progress = true;
    $subjects = get_subjects($user_subjects); // neccessary to resolve groups
  }
  else {
    $subjects = ["M", "D", "E", "GSPB", "GWK", "BIUK", "PH", "ME", "PHL", "BE", "L", "IT", "CAE", "SPA", "REK", "REE", "BSPK", "BSPM", "INFG-SR", "INFG-KAM", "INFW-ROH", "INFW-MI", "PUP", "WPF-ME", "WPF-GSPB", "WPF-BIUK", "WPF-SPK"];
  }
  
  echo "<tr class=\"head\">";
  
  if ($include_progress) {
    echo"<td> ✓ </td>";
    
    if (file_exists("data/progress/$user")) {
      $progress_array = explode(",", file_get_contents("data/progress/$user"));
      $progress_array = array_map('trim', $progress_array); // returns array without any whitespace
    }
    else {
      $progress_array = [];
    }
  }
  else {
    $progress_array = [];
  }
  
  echo "<td> Subject </td><td> Description </td><td> Where? </td><td> Deadline </td></tr>";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo build_cells($l, $subjects, $include_progress, $progress_array);
    }
  }
  
  echo "</table>";
  if ($include_progress) {
    echo "<input class=\"progress-submit\" type=\"submit\" value=\"💾\">";
  }
  echo "</form>";
}



function build_cells($line, $subjects, $include_progress, $progress) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
    
    if ($include_progress) {
      
      if(in_array(trim($cell_array[1]), $progress)) {
        $output = "<tr class=\"finished\">";
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".trim($cell_array[1])."\" checked></td>"; // generates checked checkboxes
      }
      else {
        $output = "<tr>";
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".trim($cell_array[1])."\"></td>";
      }
    }
  
    else {
      $output = "<tr>";
    }
    
    for ($i = 0; $i < count($cell_array); $i++) {
      
      if ($i !== 1) { // skip id
        
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ". trim($cell_array[$i])."\">".$cell_array[$i]."</span> </td>"; 
        }
        elseif ($i == 3) { // resource generation
          $output = $output."<td>".prettify_resource($cell_array[$i])."</td>";  
        }
        
        else {
          $output = $output."<td>".$cell_array[$i]."</td>"; 
        }
        
      }
    }
    
    $output = $output."</tr>";
}
  
  return $output;
}



function prettify_resource($resource) {
  if (preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', $resource)) { // check if resource is URL
    $prettified_resource = "<a href=\"".$resource."\">".$resource."</a>";
  }
  else {
    $prettified_resource = $resource;
  }
  
  return $prettified_resource;
}

?>