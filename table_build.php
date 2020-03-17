<?php

function table_build($input, $subjects) {
  echo "<table>";
  echo "<tr class=\"head\"><td> Subject </td><td> Description </td><td> Where? </td><td> Deadline </td></tr>";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo build_cells($l, $subjects);
    }
  }
  
  echo "</table>";
}

function build_cells($line, $subjects) {
  $cell_array = str_getcsv($line,"|");
  $output = "";
  
  if (in_array(trim($cell_array[0]), $subjects)) { // only show item if subject is enabled
    $output = "<tr>";
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