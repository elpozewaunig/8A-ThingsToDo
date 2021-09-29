<?php

function table_build($input, $user) {
  
  include 'get_subjects.php';
  include 'constants.php'; // contains array of all subjects
  
  echo "<form id=\"work_save\" action=\"push_progress.php\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"username\"  value=\"$user\">";
  echo "<table class=\"data-table\" id=\"work\">";
  
  $include_progress = false;
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $include_progress = true;
    $subjects = get_subjects($user_subjects); // resolves groups to individual subjects
  }
  else {
    $subjects = SUBJECTS; // subjects as defined in constants.php
  }
  
  echo "<thead class=\"column-titles\"><tr>";
  
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
  
  $subjects_meta_path = 'data/subjects/subjects.txt';
  if(file_exists($subjects_meta_path)) {
    $subjects_meta = file($subjects_meta_path);
  }
  else {
    $subjects_meta = [];
  }
  
  $table = "";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      $table = $table.build_cells($l, $subjects, $include_progress, $progress_array, $subjects_meta);
    }
  }
  
  if($table !== "") {
    echo $table;
  }
  else {
    if($include_progress) {
      $message_colspan = 5;
    }
    else {
      $message_colspan = 4;
    }
    echo "<tr><td colspan=\"".$message_colspan."\"> No work has been assigned yet. Yay! </td></tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  if ($include_progress) {
    echo "<div class=\"save-bar\">";
    
    echo "<div class=\"save-confirmation\">";
    echo "<span id=\"success\"><img src=\"images/fa/check.svg\"> Saved! </span>";
    echo "<span id=\"error\"><img src=\"images/fa/times.svg\"> Something went wrong </span>";
    echo "</div>";
    
    echo "<input class=\"progress-submit\" type=\"submit\" value=\"💾\" title=\"Save\">";
    echo "</div>";
  }
  echo "</form>";
}



function build_cells($line, $subjects, $include_progress, $progress, $subjects_meta) {
  $cell_array = str_getcsv($line,"|");
  $cell_array = array_map("trim", $cell_array);
  $output = "";
  
  if (in_array($cell_array[0], $subjects)) { // only show item if subject is enabled
    
    if ($include_progress) {
      
      if(in_array($cell_array[1], $progress)) {
        $output = "<tr class=\"finished\">";
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".$cell_array[1]."\" checked=\"true\"><span class=\"sort-meta\">Done</span></td>"; // generates checked checkboxes
      }
      else {
        $assignment_due = $cell_array[4];
        
        if($assignment_due == '#') {
          $assignment_due = first_lesson($subjects_meta, $cell_array[0]);
        }
        
        $duedate = date_timestamp_get(date_create_from_format("d.m.Y", $assignment_due));
        $today = time();
        $tomorrow = strtotime("+1 day");
        if ($duedate == $tomorrow || $duedate == $today) {
          $output = "<tr class=\"due\">";
        }
        else {
          $output = "<tr>";
        }
        $output = $output."<td><input type=\"checkbox\" name=\"progress[]\" value=\"".$cell_array[1]."\"><span class=\"sort-meta\">Not done</span></td>";
      }
    }
  
    else {
      $output = "<tr>";
    }
    
    for ($i = 0; $i < count($cell_array); $i++) { // cycles through every element of one line
      
      if ($i !== 1) { // skip id
        
        if ($i == 0) { // subject generation
          $output = $output."<td> <span class=\"subject ".$cell_array[$i]."\">".$cell_array[$i]."</span> </td>"; 
        }
        elseif ($i == 3) { // resource generation
          $output = $output."<td>".prettify_resource($cell_array[$i])."</td>";  
        }
        elseif ($i == 4) { // date generation
          if ($cell_array[$i] == '#') {
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
    $nextschoolday = strtotime(school_start); // defined in config.txt
    
    if($subject_array !== []) {
      foreach ($subject_array as $l) {
        if($l !== PHP_EOL) {
          $line_array = str_getcsv($l, '|');
          $line_array = array_map('trim', $line_array);
          
          if ($subject == $line_array[0]) {
            $lessons = str_getcsv($line_array[1], ',');
            $lessons = array_map('trim', $lessons);
            
            $next_lesson = $nextschoolday;
            
            for ($i=1; $i <= 7; $i++) {
              if (in_array(date("D", $next_lesson), $lessons )) {
                break;
              }
              else {
                $next_lesson = strtotime("+1 day", $next_lesson);
              }
            }
          }
        }
      }
    }
    else {
      $next_lesson = $nextschoolday;
    }
    
  $date = date('d.m.Y', $next_lesson); 
  return $date;
}

function prettify_resource($resource) {
  if (filter_var($resource, FILTER_VALIDATE_URL)) { // check if resource is URL
    $prettified_resource = "<a href=\"".$resource."\" target=\"_blank\">".htmlspecialchars($resource)."</a>";
  }
  else {
    $prettified_resource = $resource;
  }
  
  return $prettified_resource;
}

?>