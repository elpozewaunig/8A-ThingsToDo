<?php

function table_build($input, $user) {
  
  include 'get_subjects.php';
  
  echo "<form action=\"push_progress.php\" method=\"post\">";
  echo "<table>";
  
  $include_progress = false;
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $include_progress = true;
    $subjects = get_subjects($user_subjects);
  }
  else {
    $subjects = ["M", "D", "E", "GSPB", "GWK", "BIUK", "PH", "ME", "PHL", "BE", "L", "IT", "CAE", "SPA", "REK", "REE", "BSPK", "BSPM", "INFG-SR", "INFG-KAM", "INFW-ROH", "INFW-MI", "PUP", "WPF-ME", "WPF-GSPB", "WPF-BIUK", "WPF-SPK"];
  }
  
  echo "<tr class=\"head\">";
  
  if ($include_progress) {
  echo"<td> ✓ </td>"; 
  }
  
  echo "<td> Subject </td><td> Description </td><td> Where? </td><td> Deadline </td></tr>";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo build_cells($l, $subjects, $include_progress);
    }
  }
  
  echo "</table>";
  echo "<input class=\"progress-submit\" type=\"submit\" value=\"💾\">";
  echo "</form>";
}

function build_cells($line, $subjects, $include_progress) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
    $output = "<tr>";
    
    if ($include_progress) {
      $output = "<td><input type=\"checkbox\" name=\"progress[]\" value=\"$cell_array[1]\"></td>"; // generates checkboxes
    }
    
    for ($i = 0; $i < count($cell_array); $i++) {
      if ($i !== 1) {
        
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ". trim($cell_array[$i])."\">".$cell_array[$i]."</span> </td>"; 
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

?>