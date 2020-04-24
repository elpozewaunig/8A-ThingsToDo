<?php

function table_build($input, $user) {
  
  include 'get_subjects.php';
  
  echo "<form action=\"push_progress.php\" method=\"post\">";
  echo "<table id=\"work\">";
  
  $include_progress = false;
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $include_progress = true;
    $subjects = get_subjects($user_subjects); // neccessary to resolve groups
  }
  else {
    $subjects = ["M", "D", "E", "GSPB", "GWK", "BIUK", "PH", "ME", "PHL", "BE", "L", "IT", "CAE", "SPA", "REK", "REE", "BSPK", "BSPM", "INFG-SR", "INFG-KAM", "INFW-ROH", "INFW-MI", "PUP", "WPF-ME", "WPF-GSPB", "WPF-BIUK", "WPF-SPK"];
  }
  
  echo "<thead><tr>";
  
  if ($include_progress) {
    echo"<th> ✓ </th>";
    
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
  
  echo "<th id=\"th-subjects\"> Subject </th><th> Description </th><th> Where? </th><th> Deadline </th>";
  echo "</tr></thead>";
  echo "<tbody>";
  
  $subjects_meta = file('data/subjects/subjects.txt');
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo build_cells($l, $subjects, $include_progress, $progress_array, $subjects_meta);
    }
  }
  
  echo "</tbody>";
  echo "</table>";
  if ($include_progress) {
    echo "<input class=\"progress-submit\" type=\"submit\" value=\"💾\">";
  }
  echo "</form>";
}



function build_cells($line, $subjects, $include_progress, $progress, $subjects_meta) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
    
    if ($include_progress) {
      
      if(in_array(trim($cell_array[1]), $progress)) {
        $output = "<tr class=\"finished\">";
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".trim($cell_array[1])."\" checked=\"true\"><span class=\"sort-meta\">Done</span></td>"; // generates checked checkboxes
      }
      else {
        $output = "<tr>";
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".trim($cell_array[1])."\"><span class=\"sort-meta\">Not done</span></td>";
      }
    }
  
    else {
      $output = "<tr>";
    }
    
    for ($i = 0; $i < count($cell_array); $i++) { // cycles through every element of one line
      
      if ($i !== 1) { // skip id
        
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ". trim($cell_array[$i])."\">".$cell_array[$i]."</span> </td>"; 
        }
        elseif ($i == 3) { // resource generation
          $output = $output."<td>".prettify_resource($cell_array[$i])."</td>";  
        }
        elseif ($i == 4) { // date generation
          if (trim($cell_array[$i]) == '#') {
            $output = $output."<td>".first_lesson($subjects_meta, $cell_array[0])."</td>";
          }
          else {
            $output = $output."<td>".$cell_array[$i]."</td>"; 
          }
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

function first_lesson($subject_array, $subject) { // resolves # as next lesson, after school start
    $nextschoolday = mktime(0, 0, 0, 6, 3, 2020); // 03.06.2020
    
    foreach ($subject_array as $l) {
      $line_array = str_getcsv($l, '|');
      $line_array = array_map('trim', $line_array);
      
      if (trim($subject) == trim($line_array[0])) {
        $lessons = str_getcsv($line_array[1], ',');
        
        $next_lesson = $nextschoolday;
        
        for ($i=1; $i <= 7; $i++) {
          if (in_array(date("D", $next_lesson), array_map('trim', $lessons) )) {
            break;
          }
          else {
            $next_lesson = strtotime("+1 day", $next_lesson);
          }
        }
      }
    }
    
  $date = date('d.m.Y', $next_lesson); 
  return $date;
}

function prettify_resource($resource) {
  if (preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', $resource)) { // check if resource is URL
    $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\">".$resource."</a>";
  }
  else {
    $prettified_resource = $resource;
  }
  
  return $prettified_resource;
}

?>